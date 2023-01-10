<?php namespace Core\Base;

class Model {
    public $connection;
    protected $table;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        //* connection db
        $this->connection(); 
        $this->relate_table();
    }
    
    /**
     * __destruct
     *
     * @return void
     */
    public function __destruct( ) 
    {   //*close connection 
        $this->connection->close();
    }

   







    
    /**
     * get_all
     *get all data from database
     * @return array
     */
    public function get_all(): array {
        $data=array();
        $result=$this->connection->query("SELECT * FROM $this->table");
        if ($result->num_rows > 0) {
            while ($row=$result->fetch_object()) {
                $data[]=$row;
            }
        }

        return $data;
    }


    
    /**
     * sum_sales
     * GET SUM SALES 
     * @return void
     */
    public function sum_sales()
    {
        $data=array();
        $result=$this->connection->query("SELECT SUM(total) FROM $this->table");
        if ($result->num_rows > 0) {
            while ($row=$result->fetch_object())
            foreach ($row as $key => $value) {
                $data[]= $value;
            } 
            
            
        }

        return $data;
    }
    
    //*GET BY ID 
    public function get_by_id($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id=?"); // prepare the sql statement
        $stmt->bind_param('i', $id); // bind the params per data type (https://www.php.net/manual/en/mysqli-stmt.bind-param.php)
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        $stmt->close();
        // $result = $this->connection->query("SELECT * FROM $this->table WHERE id=$id");
        return $result->fetch_object();
    }
    //*DELETE BY ID 
    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id=?"); // prepare the sql statement
        $stmt->bind_param('i', $id); // bind the params per data type
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        $stmt->close();
        // $result = $this->connection->query("DELETE FROM $this->table WHERE id=$id");
        return $result;
    }
    //*CREATER 
    public function create($data)
    {
        // Get dynamic keys title, contenta
        // $keys: string
        // Get dynamic values coresponds to the key '$data->title','$data->content'
        // $values: string

        $keys = '';
        $values = '';
        $data_types = '';
        $value_arr = array();

        foreach ($data as $key => $value) {

            if ($key != \array_key_last($data)) {
                $keys .= $key . ', ';
                $values .= "?, ";
            } else {
                $keys .= $key;
                $values .= "?";
            }

            switch ($key) {
                case 'id':
                case 'user_id':
                case 'transaction_id':
                case 'barcode':
                case 'selling_price':
                case 'buying_price':
                case 'quantity':
                case 'item_price':
                case 'total':
                case 'item_quantity':
                    $data_types .= "i";
                    break;

                default:
                    $data_types .= "s";
                    break;
            }

            $value_arr[] = $value;
        }

        $sql = "INSERT INTO $this->table ($keys) VALUES ($values)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($data_types, ...$value_arr); // ...$value_arr == 'test sql in.', 'testing content', '1'
        $stmt->execute();
        $stmt->close();
    }




    
    public function update_profile($data) {
        $set_values='';
        $id=$_SESSION["user"]["user_id"] ;

        foreach ($data as $key=> $value) {
            if ($key=='id') {
                $id=$value;
                continue;
            }

            if ($key !=\array_key_last($data)) {
                $set_values .="$key='$value', ";
            }

            else {
                $set_values .="$key='$value'";
            }
        }

        $sql="UPDATE $this->table 
SET $set_values WHERE id=$id ";

$this->connection->query($sql);
    }

 


    public function update($data)

    {

        //this variable will contain the value of id 
        $id_bind="";
        // declear variable to put all key value to gother

        $set_values = '';

        //declear variable to put inside type of data

        $data_types = '';

        //declear variable to put inside id that we want to update it

        $id = 0;

        //declear variable to put inside values to bind the value for sql injection

        $values_array=array();

        // make loop the parameter in function update

        foreach ($data as $key => $value) {

            // this if statement for last key or not

            if ($key == 'id') {

                $id ="?";

                $id_bind=$value;

                continue;

            }

            if ($key != \array_key_last($data)) {

               

                $set_values .= "$key= ?, ";

            } else {

               

                $set_values .= "$key= ?";

            }

            switch ($key) {
                case 'id':
                case 'user_id':
                case 'transaction_id':
                case 'barcode':
                case 'selling_price':
                case 'buying_price':
                case 'quantity':
                case 'item_price':
                case 'total':
                case 'item_quantity':
                    $data_types .= "i";
                    break;

                default:
                    $data_types .= "s";
                    break;
            }

            //we put all value in array

            $values_array[]="$value";

           

        }

        //i put the last value was id because should arrange it in this way

        $values_array[]=$id_bind;

        //concat the type of id in the string of type of value

        $data_types .="i";

       

        $sql = "UPDATE $this->table

            SET $set_values

            WHERE id=$id

        ";

        //prepar sql statement

        $stmt = $this->connection->prepare($sql);

        // bind the params per data type

        $stmt->bind_param($data_types, ...$values_array);

        // execute the statement on the DB

        $stmt->execute();

        $stmt->close();

       

       

    }
    /**
     * connection
     *CONECTION WITH DB 
     * @return void
     */    
    /**
     * connection
     *
     * @return void
     */
    protected function connection() {
        $servername="localhost";
        $username="root";
        $password="";
        $database="htu_pos";
        //* Create connection
        $this->connection=new \mysqli($servername, $username, $password, $database);
        //* Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: ". $this->connection->connect_error);
        }
    }
    //* DINAMIC TABLE SELECTED BASED ON THE CLASS NAME 
    protected function relate_table() {
        $table_name=\get_class($this);
        $table_name_arr=\explode('\\', $table_name);
        $class_name=$table_name_arr[\array_key_last($table_name_arr)];
        $final_clas_name=\strtolower($class_name) . "s";
        $this->table=$final_clas_name;
    }
}