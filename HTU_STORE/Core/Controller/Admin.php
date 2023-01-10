<?php

namespace Core\Controller;
use Core\Base\Controller;
use Core\Model\User;
use Core\Model\Item;
use Core\Model\Transaction;

class Admin extends Controller
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
         *
         * @return void
         */
        public function index()
                //*PERRMITONS
        {       $this->permissions(['admin:dashboard']);
                //*NEW USER MODEL
                $user = new User;
                //*NEW ITEM MODEL
                $item = new Item;
                //*NEW TRANSACTION MODEL
                $transactions= new Transaction;
                //*SET VIEW VALUE TO REDIRECT TO IT
                $this->view = 'dashboard';
                //*GET ALL USER AND THE COUNT OF THEM
                $this->data['users'] = $user->get_all();
                $this->data['users_count'] = count($user->get_all());
                //*SAVE THE DISPLAY NAME AND PHOTO IN ARRAY TO PRESENT IT IN HEADER
                $user_info=$user->get_by_id($_SESSION['user']['user_id']);
                $this->data['display_name']=$user_info->display_name;
                $this->data['photo']=$user_info->photo;
                $this->data['message']=$user_info->message;
                //*GET THE NUMBER OF THE TRANSACTIONS
                $this->data['transactions_count'] = count( $transactions->get_all());
                //*GET THE SUMATION OF ALL SALLES 
                $total=$transactions->sum_sales();
                $this->data['sum_sales'] = $total[0];
                 //*GET ALL ITEMS AND THE COUNT OF THEM
                $this->data['items'] = $item->get_all();
                $this->data['items_count'] = count($item->get_all());
                //*GET THE TOP FIVE FROM ITEM TABLE
                $this->data['top_5'] = ($item->Top_5());
        }
}