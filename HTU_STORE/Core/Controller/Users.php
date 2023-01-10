<?php

namespace Core\Controller;
use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Users extends Controller
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
                $this->auth();
        }
        
        /**
         * index
         *GET ALL USER AN THE COUNT OF THEM
         * @return void
         */
        public function index()
        {       //*PERMISSIONS
                $this->permissions(['user:read']);
                
                $this->view = 'users.index';
                //*NEW USER MODEL
                $user = new User;
                //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
                $user_info=$user->get_by_id($_SESSION['user']['user_id']);
                $this->data['display_name']=$user_info->display_name;
                $this->data['photo']=$user_info->photo;
                $this->data['message']=$user_info->message;
                //*ALL USER 
                $this->data['users'] = $user->get_all();
                //* NUMBER OF USERS
                $this->data['users_count'] = count($user->get_all());

        }

        public function report()
        {       //*PERMISSIONS
                $this->permissions(['user:read']);
                
                $this->view = 'users.report';
                //*NEW USER MODEL
                $user = new User;
                  //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
                $user_info=$user->get_by_id($_SESSION['user']['user_id']);
                $this->data['display_name']=$user_info->display_name;
                $this->data['photo']=$user_info->photo;
                $this->data['message']=$user_info->message;
                //*ALL USER 
                $this->data['users'] = $user->get_all();
                //* NUMBER OF USERS
                $this->data['users_count'] = count($user->get_all());
        }
                
        /**
         * single
         *GRT USER BY ID
         * @return void
         */
        public function single()
        {       //*PERMISSIONS
                $this->permissions(['user:read']); 
                //*NEW USER MODEL 
                $user = new User;
                //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
                $user_info=$user->get_by_id($_SESSION['user']['user_id']);
                $this->data['display_name']=$user_info->display_name;
                $this->data['photo']=$user_info->photo;
                $this->data['message']=$user_info->message;
                //*USER VIEW SINGEL
                $this->view = 'users.single';
                //*GET USER BY ID
                $user_id=$user->get_by_id($_GET['id']);
                $date_create = new \DateTime($user_id->created_at);
                $user_id->created_at = $date_create->format('d/m/Y');
                $date_update= new \DateTime($user_id->updated_at);
                $user_id->updated_at = $date_update->format('d/m/Y');
                $this->data['user'] = $user_id;






        }
        /**
         * create       
         *Display the HTML form for post creation
         * @return void
         */
        public function create()
        {       //*PERMISSIONS
                $this->permissions(['user:read','user:create']); 
                //*new user model 
                $user = new User; 
               ;
                //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
                $user_info=$user->get_by_id($_SESSION['user']['user_id']);
                $this->data['display_name']=$user_info->display_name;
                $this->data['photo']=$user_info->photo;
                $this->data['message']=$user_info->message;
                //*USER VIEW SINGEL
                $this->view = 'users.create';
        }
        
        /**
         * store
         *CREATE NEW USER 
         * @return void
         */
        public function store()
        {
        //*PERMISSIONS
        $this->permissions(['user:read','user:create']);
        //*TO MAKE ALL DATA SECURIED FROM XSS ATTACHES 
        $this->htmlspecial($_POST);
        //*CHECK POST
        if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])  || empty($_POST["role"])|| empty($_POST["salary"])) {
                $_SESSION["user_create_error"]="You should Inetr All User's Information";
                Helper::redirect("/users/create?id=");
        } else {
        //*check if the user is exist or not
        $user = new User();
        $validation_username=$user->check_exist_user_name($_POST["username"]);
        if ($validation_username) {
                $_SESSION["check_exist_user_name"]="Please Inter Different User Name ";
                //*RETURN TO user CREATE PAGE
                Helper::redirect('/users/create');
        } else {
                //*CHEC IF THE user display name IS EXIST OR NOT
                $validation_displayname=$user->check_exist_display_name($_POST["display_name"]);
                if ($validation_displayname) {
                $_SESSION["check_exist_display_name"]="Please Inter Different Display Name";
                //*RETURN TO user CREATE PAGE
                Helper::redirect('/users/create');
                } else {
                $_SESSION['complete_creating']="New User Was Added In The System";

                //* process role
                        $permissions = null;
                        switch ($_POST['role']) {
                                case 'admin':
                        $permissions = User::ADMIN;
                        break;
                        case 'seller':
                        $permissions = User::SELLER;
                        break;
                        case 'procurement':
                        $permissions = User::PROCUREMENT;
                        break;
                        case 'accountant':
                        $permissions = User::ACCOUNTANT;
                        break;
                }
                //*convet the array to string in db
                $_POST['permissions'] = \serialize($permissions);
                //*UPLOAD FILE PHOTO
                if (!empty($_FILES)) {
                        $ext = explode('/', $_FILES['photo']['type']);
                        $ext = $ext[array_key_last($ext)];
                        $name = $_POST['username'];
                        $file_name = "user-$name.$ext";
                        $photo = "./photos/$file_name";
                        move_uploaded_file($_FILES['photo']['tmp_name'], "./photos/$file_name");
                        $_POST['photo'] = $photo;       
                }
                //*NEW USER MODEL
                $user = new User();
                //* PASSWORD SEQURITY
                $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
                //*CREAT NEW USER
                $user->create($_POST);
                //*REDIRECT
                Helper::redirect('/users');
                }
        }
}
}
                
        /**
         * edit
         * Display the HTML form for post update
         * @return void
         */
        public function edit()
        {       
                //*PERMISSIONS
                $this->permissions(['user:read','user:update']); 
                //*NEW USER MODEL 
                $user = new User;
                //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
                $user_info=$user->get_by_id($_SESSION['user']['user_id']);
                $this->data['display_name']=$user_info->display_name;
                $this->data['photo']=$user_info->photo; 
                $this->data['message']=$user_info->message;
                //*DISPLAY USER EDIT PAGE
                $this->view = 'users.edit';
                //*GET USER INFORMATIONS
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }


        
        /**
         * messenger
         *message for the user
         * @return void
         */
        public function messenger(){
               
                
                $this->permissions(['user:read','user:update']); 
                if(empty($_POST["Message"]) )
                {
                $_SESSION["messenger_not_send"]="Empty message";
                Helper::redirect("/user?id=".$_POST['id']);
                }
                else{
                        $_SESSION['messenger_send']="your message was send";
                        $user = new User();
                        $this->htmlspecial($_POST);
                        $user->update($_POST);
                        Helper::redirect("/user?id=".$_POST['id']);
}
}
        /**
         * update
         * UPDATE USER INFORMATIONS
         * @return void
         */
        public function update()
                
                {
                        
                //*PERMISSIONS  
                $this->permissions(['user:read','user:update']); 
                //*TO MAKE ALL DATA SECURIED FROM XSS ATTACHES 
                $this->htmlspecial($_POST);
                //*NEW USER MODEL
                $user = new User();
                //*CHECK POST VALUE
                if(empty($_POST["username"]) || empty($_POST["email"])  || empty($_POST["role"]) || empty($_POST["salary"]))
                {
                $_SESSION["user_edit_error"]="You should All User's Information";
                Helper::redirect("/users/edit?id=".$_POST["id"]);
                }
                else{  $_SESSION['complete_update']="User's informations was updated";
                //* process role
                $permissions = null;
                switch ($_POST['role'])
                {
                        case 'admin':
                                $permissions = User::ADMIN;
                                break;
                        case 'seller':
                                $permissions = User::SELLER;
                                break;
                        case 'procurement':
                                $permissions = User::PROCUREMENT;
                                break;
                        case 'accountant':
                                $permissions = User::ACCOUNTANT;
                                break;
                } 
                //*convet the array to string in db
                $_POST['permissions'] = \serialize($permissions); 
                //*UPLOAD FILE PHOTO
                if (!empty($_FILES)) {
                        $ext = explode('/', $_FILES['photo']['type']);
                        $ext = $ext[array_key_last($ext)];
                        $name = $_POST['username'];
                        $file_name = "user-$name.$ext";
                        $photo = "./photos/$file_name";
                        move_uploaded_file($_FILES['photo']['tmp_name'], "./photos/$file_name");
                        $_POST['photo'] = $photo;
                }
                //*UPDATE THE POST VALUE IN DB 
                $user->update($_POST);
                //*REDIRECT 
                Helper::redirect('/user?id='. $_POST['id']);
                }
                }
                
                /**
                 * delete_mss
                 * delete the message
                 * @return void
                 */
                public function delete_mss()
                {
                       
                        
                         $user = new User();
                        
                         $sql="UPDATE users set message =null  where id=".$_SESSION['user']['user_id'];
                             $user->connection->query($sql);
                            
                         Helper::redirect('./');
                 }

                
        /**
         * delete 
         *DELETE THE USER 
         * @return void
         */
        public function delete()
        { 
                //*MASSAGE
                $_SESSION["user_delete"]="The user was deleted";
                //*PERMISSIONS
                $this->permissions(['user:read', 'user:delete']); 
                //*NEW USER MODEL
                $user = new User();
                //*DELET THE USER BY ID 
                $user->delete($_GET['id']);
                //*REDIRECT 
                Helper::redirect('/users');
        }
}