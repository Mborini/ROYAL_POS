<?php

namespace Core\Controller;
use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Transaction;
use Core\Model\User;

class Transactions extends Controller
{
    
    /**
     * render
     * REDIRECT TO VIEW METHOD
     * @return void
     */
    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->auth();
    
    }
    
    /**
     * Gets all items
     * DISPLAY ALL TRANSACTIONS 
     * @return array
     */
    public function index()

    {   //*PERMISSIONS
        $this->permissions(['transaction:read']); 
        //*NEW TARANACTION MODEL
        $transactions= new Transaction;
        //*NEW USER MODAEL
        $user = new User;
        //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //* DISPLAY TRANSACTION PAGE
        $this->view = 'transactions.index';
        //* SELECT DATA FROM TRANSACTION_USER TABLE (REALATION TABLE)
        $result=$transactions->connection->query("SELECT users.username
        ,transactions.id,transactions.item_name, transactions.item_quantity,
        transactions.total,transactions.update_at,transactions.created_at,transaction_user.*
        FROM transaction_user
        JOIN transactions ON transaction_user.transaction_id = transactions.id
        JOIN users ON transaction_user.user_id = users.id ORDER BY transaction_user.transaction_id DESC ");
        $transactions_info = array();
        //*LOOP ON DATA 
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
        $transactions_info[] = $row;}
        }
        //*SET THE DATA IN ARRAY
        $this->data['transaction'] = $transactions_info;
    }   


        
    /**
     * selling_view
     *DISPLAY SELLENG PAGE 
     * @return void
     */
    public function selling_view()
    { 
        //*PERMISSIONS
        $this->permissions(['selling:read']); 
        //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
        $user = new User;
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //*DISPLAY SELLENG PAGE 
        $this->view = 'selling.index';
    }   


        
    /**
     * single
     * DISPLAY THE TRANSACTION SINGEL PAGE
     * @return void
     */
    public function single()

    {   //*PERMISSIONS
        $this->permissions(['transaction:read', 'transaction:update']); 
        //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER 
        $user = new User;
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //* DISPLAY THE TRANSACTION SINGLE PAGE
        $this->view = 'transactions.single';
        //* NEW TRANSACTION MODEL 
        $transactions = new Transaction();
        //* SAVE THE TRANSACTION BY ID IN ARRAY
        $this->data['tran'] = $transactions->get_by_id($_GET['id']);
        //* SET MASSAGE 
        $this->data['Saved_info'] ="Successfly Updated";
    
    }



    /**
     * edit
     *  DISPLAY THE EDIT TRANSACTION PAGE 
     * @return void
     */
    public function edit()

    {   //*PERMISSIONS
        $this->permissions(['transaction:read', 'transaction:update']);  
        //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
        $user = new User;
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //* NEW TRASACTION MODEL 
        $transactions = new Transaction();
        //* SAVE THE TRANSACTION BY ID IN ARRAY
        $this->data['tran'] = $transactions->get_by_id($_GET['id']);
        //* SET MASSAGE 
        $this->view = 'transactions.edit';
    }
    
        /**
         * Updates the item
         * UPDATE THE TARANSACTION INFORMATION 
         * @return void
         */
        public function update()
            { 
             //*PERMISSIONS
            $this->permissions(['transaction:read', 'transaction:update']); 
            //*TO MAKE ALL DATA SECURIED FROM XSS ATTACHES 
            $this->htmlspecial($_POST); 
            //*CHECK THE POST
                if(empty($_POST["item_name"])  || empty($_POST["total"])|| empty($_POST["item_price"]) || empty($_POST["item_quantity"]) ){
                    $_SESSION["tran_error1"]="You must inter all informations";
                    Helper::redirect('/transaction/edit?id='.$_POST["id"]);}
            else
            {//*CHECK THE POST VALUE
                if($_POST["item_price"]<=0 || $_POST["total"]<=0 || $_POST["item_quantity"]<=0){
                    $_SESSION["tran_error2"]="There is value less than or equal zero";
                    Helper::redirect('/transaction/edit?id='.$_POST["id"]);}

        else
    {   
            $_SESSION["tran_correct"]=" Successfully Updated";
            //*NEW TRANSACTION MODEL
            $transaction = new Transaction();
            //* UPDATE THE POST
            $transaction->update($_POST);
                
            Helper::redirect('/transaction/single?id=' . $_POST['id']);
    }}
}
    /**
     * Delete the item
     * DELETE THE TRANSACTION 
     * @return void
     */
    public function delete()

    { 
        //*PERMISSIONS
        $this->permissions(['transaction:read', 'transaction:delete']); 
        //*MASSAGE 
        $_SESSION["transaction_delete"]="Transaction number (".$_GET['id'] .") was removed";
        $this->permissions(['transaction:read', 'transaction:delete']);  
        //* NEW TRANSACTION MODEL 
        $transaction = new Transaction;
        $transaction_id = $_GET['id'];
        //* DELETE FROM THE TRANSACTION TABLE (RELATION ) (SQL INJUTION )
        $stmt = $transaction->connection->prepare("DELETE FROM transaction_user WHERE transaction_id=?");
        $stmt->bind_param('i', $transaction_id);
        $stmt->execute();
        $stmt->close();
        //*DELETE THE TRANSACTION BY ID
        $transaction->delete($_GET['id']);
        //*REDIRECT TO TRANSACTIONS PAGE
        Helper::redirect('/transactions');
    }
}