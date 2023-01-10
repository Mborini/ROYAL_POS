<?php

namespace Core\Model;
use Core\Base\Model;


class User extends Model
{
//*GIVE TO ADMIN ALL PERMETIONS
    const ADMIN = array(
        "user:read", "user:create", "user:update", "user:delete",
        "item:read", "item:create", "item:update", "item:delete",
        "transaction:read", "transaction:create", "transaction:update", "transaction:delete",
        "selling:read", "selling:create", "selling:update","selling:delete",
       "admin:dashboard"
    );
//*GIVE TO SELLER  PERMETIONS

    const SELLER = array(
        "selling:read", "selling:create", "selling:update","selling:delete","selling:dashboard"
        
    );
    //*GIVE TO ACCOUNTANT PERMETIONS

    const ACCOUNTANT = array(
        "transaction:read", "transaction:update", "transaction:delete","transaction:dashboard"
        
    );
    //*GIVE TO PROCUREMENT PERMETIONS

    const PROCUREMENT = array(
        "item:read", "item:create", "item:update", "item:delete","item:dashboard"
        
    );


    
    /**
     * check_username
     *CHECK IF THE USER NAME IS IN THE DB (TO LOGIN PAGE)
     * @param  mixed $username
     * @return 
     */
    public function check_username(string $username)

    {

        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE username=?");

        $stmt->bind_param('s', $username);

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
    /**
     * check_exist_user_name
     *CHECK IF THE USER NAME IN THE DB  
     * @param  mixed $username
     * @return void
     */
    public function check_exist_user_name(string $username)
    { 
        $result = $this->connection->query("SELECT * FROM $this->table WHERE username='$username'");
        if ($result) { // if there is an error in the connection or if there is syntax error in the SQL.
            if ($result->num_rows > 0) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            return true;
        }
        
    }

/** 
 * check_exist_display_name
 *CHECK IF THE display name's User IN THE  table user in DB
 * @param  mixed $display_name
 * @return void
 */
public function check_exist_display_name($display_name)
{  
    $result = $this->connection->query("SELECT * FROM $this->table WHERE display_name='$display_name'");
    if ($result) { // if there is an error in the connection or if there is syntax error in the SQL.
        if ($result->num_rows > 0) {
            return $result->fetch_object();
        } else {
            return false;
        }
    } else {
        return true;
    }
    
}

/**
 * last_login
 *SET THE TIME WHIN THE USER LOGIN 
 * @return void
 */
public function last_login(){
        
    $sql="UPDATE users set last_login =now() where id=".$_SESSION['user']['user_id'];
            $this->connection->query($sql);
    
}

    

/**
 * last_logout
 *SET THE TIME WHIN THE USER LOGOUT
 * @return void
 */
public function last_logout(){
    
    $sql="UPDATE users set last_logout =now() where id=".$_SESSION['user']['user_id'];
            $this->connection->query($sql);
    
}
public function active(){
        
    $sql="UPDATE users set active = 1 where id=".$_SESSION['user']['user_id'];
            $this->connection->query($sql);
    
}
public function inactive(){
    $sql="UPDATE users set active = 0 where id=".$_SESSION['user']['user_id'];
    $this->connection->query($sql);

}
    /**
     * get_permissions
     *CHECK IF THE USER HAVE ANY PERMISSION
     * @return array
     */
    public function get_permissions(): array
    {
        $permissions = array();
        $user = $this->get_by_id($_SESSION['user']['user_id']);
        if ($user) {
            $permissions = \unserialize($user->permissions);
        }
        return $permissions;
    }
}