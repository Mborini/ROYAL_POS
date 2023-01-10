<?php

namespace Core\Controller;
use Core\Base\Controller;
use Core\Model\Item;
use Core\Model\Transaction;

class Selling extends Controller
{

    protected $request_body;
    protected $http_code = 200;

    protected $response_schema = array(
        "success" => true,
        "message_code" => "",
        "body" => array()
    );


    function __construct()
    {
        $this->auth();
        $this->request_body = (array) json_decode(file_get_contents("php://input"));
    }

    public function render()
    {
        header("content-type: application/json");
        http_response_code($this->http_code);
        echo json_encode($this->response_schema);
    }

    /**
     * index
     * Gets all the product
     *  API TO GET ALL THE ITEMS 
     * @return array
     */
    public function index()
    {   //*PERMISSIONS
        $this->permissions(['selling:read']);
        $items = array();
        try {
            $stock = new Item;
            $result = $stock->get_all();
            if (!$result) {
                $this->http_code = 404;
                throw new \Exception("Sql_response_error");
            } else {
                $this->response_schema['body'] = $result;
                $this->response_schema['message_code'] = "items_collected_successfully";
            }
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
        }
    }

    /**
     * get
     * Gets all the product
     * API TO GET ALL THE TRANSACTION THAT HAS BEEN MADE TODAY BY THE CURRENT LOGGED IN USER
     * @return array
     */
    public function get()
    {
        //*PERMISSIONS
        $this->permissions(['selling:read']);
        try {
            $Transaction = new Transaction;
            $item = $Transaction->index();
            if (empty($item)) {
                $this->http_code = 404;
                throw new \Exception("Sql_response_error");
            }
            $this->response_schema['body'] = $item;
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    
    /**
     * create
     * API TO CREATE NEW TRANSACTIONS
     * @return void
     */
    public function create()
    {   //*PERMISSIONS
        $this->permissions(['selling:read','selling:create']);
        try {
            $Transaction = new Transaction;
            if (!isset($this->request_body['item_name'])) {
                $this->http_code = 422;
                throw new \Exception("item_name_not_found");
            }
            if (!isset($this->request_body['item_quantity'])) {
                $this->http_code = 422;
                throw new \Exception("item_quantity_param_not_found");
            }
            if (!isset($this->request_body['total'])) {
                $this->http_code = 422;
                throw new \Exception("total_param_not_found");
            }
            $Transaction->create($this->request_body);
            $Transaction_id = $Transaction->get_by_id($Transaction->connection->insert_id);
            $Transaction_id = $Transaction_id->id;
            $user_id = $_SESSION['user']['user_id'];

            $stmt = $Transaction->connection->prepare("INSERT INTO transaction_user (transaction_id,user_id) VALUES (?,?)");

            $stmt->bind_param('ii', $Transaction_id, $user_id);

            if (!$stmt->execute()) {

                $this->http_code = 500;

                throw new \Exception("item_was_not_created");

            }
            $stmt->close();
            $this->response_schema['message_code'] = "item_created";
            $this->response_schema['body'][] = $Transaction->get_by_id($Transaction->connection->insert_id);
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            
        }
    }

    /**
     *  update
     * TO UPDATE THE ITEM QUANTITY
     * @return void
     */
    public function update()
    {   
        $item = new Item;
        try {
            if (!isset($this->request_body['id'])) {
                $this->http_code = 422;
                throw new \Exception("id_param_not_found");
            }
            if (!isset($this->request_body['quantity'])) {
                $this->http_code = 422;
                throw new \Exception("quantity_param_not_found");
            }
            $items = $item->get_by_id($this->request_body['id']);

            if (empty($items)) {
                $this->http_code = 404;
                throw new \Exception("item_not_found");
            }
            $quantity =  $this->request_body['quantity'];
            if (!$item->connection->query("UPDATE items SET quantity=$quantity WHERE id={$this->request_body['id']}")) {
                $this->http_code = 500;
                throw new \Exception("item_was_not_updated");
            }


            $stmt = $item->connection->prepare("UPDATE items SET quantity=? WHERE id=?");
            $stmt->bind_param('ii', $quantity, $this->request_body['id']);
            if (!$stmt->execute()) {
                $this->http_code = 500;
                throw new \Exception("item_was_not_created");
            }
            $this->response_schema['message_code'] = "item_updated";
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
        }
    }
 






    
    /**
     * update_transaction
     * update transaction quantity
     * @return void
     */
    public function update_transaction()
    {   
        $transaction = new Transaction;
        try {
            if (!isset($this->request_body['id'])) {
                $this->http_code = 422;
                throw new \Exception("id_param_not_found");
            }
            if (!isset($this->request_body['quantity'])) {
                $this->http_code = 422;
                throw new \Exception("quantity_param_not_found");
            }

            
            $items = $transaction->get_by_id($this->request_body['id']);
            $price=$items->item_price;
            $pquantity=$items->item_quantity;

            if (empty($items)) {
                $this->http_code = 404;
                throw new \Exception("item_not_found");
            }
            $quantity =  $this->request_body['quantity'];
            $total=$this->request_body['quantity'] * $price;
            if (!$transaction->connection->query("UPDATE transactions SET item_quantity=$quantity,total=$total WHERE id={$this->request_body['id']}")) {
                $this->http_code = 500;
                throw new \Exception("item_was_not_updated");
            }

            $item = new Item;
            $selected_item=$item->get_by_id($this->request_body['item_id']);
            $squantity=$selected_item->quantity;

            if($quantity >= $pquantity){
                $def_quantity=$quantity-$pquantity;
                if($def_quantity<$squantity){
                    $squantity=$squantity-$def_quantity;
                }else{
                    die;
                }
            }else{
                $def_quantity=$pquantity-$quantity;
                $squantity=$squantity+$def_quantity;
            }

            

            if (!$item->connection->query("UPDATE items SET quantity=$squantity WHERE id={$this->request_body['item_id']}")) {
                $this->http_code = 500;
                throw new \Exception("item_was_not_updated");
            }



        
            $this->response_schema['message_code'] = "item_updated";
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
        }
    }
 

    /**
     * delete
     *  DELETE THE SALLES
     * @return void
     */
    public function delete()
    {   //*PERMISSIONS
        try {
            $Transaction = new Transaction;

            if (!isset($this->request_body['id'])) {
                $this->http_code = 422;
                throw new \Exception("id_param_not_found");
            }//todo===========

            $stmt = $Transaction->connection->prepare("DELETE FROM transaction_user WHERE transaction_id=?");
            $stmt->bind_param('i', $this->request_body['id']);
            if (!$stmt->execute()) {
                $this->http_code = 500;
                throw new \Exception("item_was_not_deleted");
            }//todo============
            $stmt->close();

            $stmt = $Transaction->connection->prepare("DELETE FROM transactions WHERE id=?");
            $stmt->bind_param('i', $this->request_body['id']);
            if (!$stmt->execute()) {
                $this->http_code = 500;
                throw new \Exception("item_was_not_deleted");
            }
            $stmt->close();

            //todo========
            $this->response_schema['message_code'] = "item_deleted";
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
        }
    }
}