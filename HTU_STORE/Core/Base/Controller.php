<?php

namespace Core\Base;

use Core\Helpers\Helper;
use Core\Model\User;

abstract class Controller
{       
    
    abstract public function render();
    protected $view = null;
    protected $data = array();
    
    /**
     * view
     * REDIERCT TO VIEW CLASS
     * @return void
     */
    protected function view()
    {   
        new View($this->view, $this->data);
    }

    protected function htmlspecial(array &$variable) {
        foreach ($variable as &$value) {
                $value = \htmlspecialchars($value);
            } }

    


    protected function auth()
    {
        if (!isset($_SESSION['user'])) {
            Helper::redirect('/');
        }
    }

    /**
     * permissions
     * Check if the user has the assigned permissions.
     * @param  mixed $permissions_set
     * @return void
     */
    protected function permissions(array $permissions_set)
    {
        $this->auth();
        $user = new User;
        $assigned_permissions = $user->get_permissions();
        //* check if the user has all the permissions_set
        foreach ($permissions_set as $permission) {
            if (!in_array($permission, $assigned_permissions)) {
                if ($_SESSION['user']['role'] == 'Seller') {
                    Helper::redirect('/selling');
                } elseif ($_SESSION['user']['role'] == 'Accountant') {
                    Helper::redirect('/transactions');
                } elseif ($_SESSION['user']['role'] == 'Procurement') {
                    Helper::redirect('/items');

                }
            }
        }
        
    }

    
}