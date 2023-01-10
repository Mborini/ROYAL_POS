<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Profile extends Controller
{    
    /**
     * render
     *REDIRECT TO VIEW METHOD
     * @return void
     */
    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }
    
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        
    }

    /**
     * List all news
     *SHOW THE USER PROFILE 
     * @return void
     */
    public function show_info()

    { 
        //*NEW USER MODEL 
        $user = new User;
        //*SAVE THE DISPLAY NAME AND PHOTO IN ARRAY TO PRESENT IT IN HEADER
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //* DISPLAY THE PROFILE PAGE 
        $this->view = 'profile';
        //*GET USER INFO BY USER ID 
        $this->data['user'] = $user->get_by_id($_SESSION["user"]["user_id"]);
       
    }



    
    /**
     * update
     * UPDATE THE USER PROFILE
     * @return void
     */
    public function update()
    {   
        //*TO MAKE ALL DATA SECURIED FROM XSS ATTACHES 
        $this->htmlspecial($_POST);
        //* CHECK THE POST 
        if(empty($_POST["username"]) || empty($_POST["email"]) ) 
        {
        $_SESSION["error_update_profile"]="You should Inetr All Your Information";
        Helper::redirect("/profile?id=".$_POST["user_id"]);
        }
        else{  $_SESSION["correct_update_profile"]="Your porfile information was updated";
        //* CHECK THE IMAG FILE 
        if (!empty($_FILES)) {
        $ext = explode('/', $_FILES['photo']['type']);
        $ext = $ext[array_key_last($ext)];
        $name = $_POST['username'];
        $file_name = "user-$name.$ext";
        $photo = "./photos/$file_name";
        move_uploaded_file($_FILES['photo']['tmp_name'], "./photos/$file_name");
        $_POST['photo'] = $photo;
        }
        //* CREATE USER MODEL
        $user = new User();
        //* UPDATE THE POST 
        $user->update_profile($_POST);
        //* REDIRECT 
        Helper::redirect('/profile?id=' . $_POST['user_id']);
    }

}}