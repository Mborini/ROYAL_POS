<?php

namespace Core\Model;
use Core\Base\Model;
class Item extends Model
{    
    /**
     * check_item
     *CHECK IF THE ITEM IS IN THE TABLE IN DB 
     * @param  mixed $item
     * @return void
     */
    public function check_item(string $item)
    { 
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE item_name=?");

        $stmt->bind_param('s', $item);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result) {

            if ($result->num_rows > 0) {

                return $result->fetch_object();

            } else {

                return false;

            }

        } else {

            return false;

        }

        $stmt->close();
    }
    





//*CHECK IF THE barcode IN THE DB
public function check_barcode($barcode)
{  
    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE barcode=?");

    $stmt->bind_param('i', $barcode);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result) {

        if ($result->num_rows > 0) {

            return $result->fetch_object();

        } else {

            return false;

        }

    } else {

        return true;

    }

    $stmt->close();
    
}

//*CHECK IF THE item NAME IN THE DB
public function check_itemname($item_name)
{  
    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE item_name=?");

        $stmt->bind_param('s', $item_name);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result) {

            if ($result->num_rows > 0) {

                return $result->fetch_object();

            } else {

                return false;

            }

        } else {

            return true;

        }

        $stmt->close();
    
}

    /**
     * Top_5
     * GET TOP FIVE EXPENCEIVE ELEMENT
     * BASED ON ORDER BY BUYING_PRICE 
     * AND RETERN IT DESC 
     * FOR FIVE TIME 
     * @return array
     */
    public function Top_5(): array {
        $data=array();
        for ($x = 0; $x <= 4; $x++) {
            $result=$this->connection->query("SELECT * FROM $this->table ORDER BY buying_price DESC LIMIT 5");
        }
        if ($result->num_rows > 0) {
            while ($row=$result->fetch_object()) {
                $data[]=$row;
            }
        }
        return $data;
    }
}