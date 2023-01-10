<?php

namespace Core\Controller;
use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;
use Core\Base\Model;

/**
 * Authentication
 */
class Authentication extends Controller
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

        function __construct()
        { 
                if (isset($_SESSION['user']) ) 
                {
                        Helper::redirect('./dashboard');
                }
        }

        /**
         * Displays login form
         *
         * @return void
         */
        public function login()
        {
                $this->view = 'login';
        }
        public function error()
        {
                $this->view = '404';
        }

        /**
         * Login Validation
         *
         * @return void
         */
        public function validate()
        {       //*TO MAKE ALL DATA SECURIED FROM XSS ATTACHES 
                $this->htmlspecial($_POST);
                 //* CALL THE USER MODEL
                $user = new User();
                //* CHECK IF THE USER IS IN DATABASE
                $logged_in_user = $user->check_username($_POST['username']);
                //* IF THE USER NOT EXESST IN DATABASE
                if (!$logged_in_user) {
                        $this->invalid_redirect();
                }
                //* CHECK THE PASSWORD ,THE PASSWORD IN HASH METHOD 
                if (!password_verify($_POST['password'], $logged_in_user->password)) {
                        $this->invalid_redirect();
                }  
                //* SET USER COOKIE 
                if (isset($_POST['remember_me'])) {
                //* THE COOKIE NAME GET FROM THE NAME USER ROLE
                        \setcookie('cookie', $logged_in_user->role, time() + (86400 * 30)); // 86400 = 1 day (60*60*24)
                }
                //* SET NEW SESSION TO SAVE THE USER INFORMATION
                $_SESSION['user'] = array(
                        'username' => $logged_in_user->username,
                        'user_id' => $logged_in_user->id,
                        'photo' => $logged_in_user->photo,                  
                        'user_email' => $logged_in_user->email,
                        'user_password' => $logged_in_user->password,
                        'messenger' => $logged_in_user->message,
                        'is_admin_view' => true,
                        'role'=>$logged_in_user->role
                ); 
                //*SET LOGIN TIME 
                $user->last_login();
                //*SET online 
                $user->active();
                 //*SET the message 
                //* SHECK THE USER PERMISSION AND REDIRECT TO HIS PAGE
                if (Helper::check_permission(['admin:dashboard'])) //* ADMIN
                {
                        Helper::redirect('/dashboard');
                } 
                        elseif  (Helper::check_permission(['selling:dashboard'])) //* SELLER
                        {
                        Helper::redirect('/selling');
                        }
                        elseif  (Helper::check_permission(['transaction:dashboard'])) //* ACCOUNTANT
                        {
                        Helper::redirect('/transactions');
                        }
                        elseif  (Helper::check_permission(['item:dashboard'])) //* PROCUREMENT
                        {
                        Helper::redirect('/itmes');
                        }                
        }
        
        /**
         * logout
         *
         * @return void
         */
        public function logout()
        {        
                 $user = new User();
                 //*SET LOGOUT TIME
                 $user->last_logout();
                 $user->inactive();
                 //* DESTROY THE SESSION
                \session_destroy();
                \session_unset();
               
                 //* DESTROY THE COOKIE BY SETTING A PAST DATE
                \setcookie('cookie', '', time() - 3600);
                Helper::redirect('/');
        }       
        
        


        /**
         * invalid_redirect
         * REDIRECT TO THE HOME PAGE 
         * @return void
         */
        private function invalid_redirect()
        {       //* SET NEW SESSION AND SAVE ERROR MASSAGE IN IT
                $_SESSION['error'] = "Invalid Username or Password";
                //* REDIRECT TO LOGIN PAGE   
                Helper::redirect('/');
                exit();
        }
}
