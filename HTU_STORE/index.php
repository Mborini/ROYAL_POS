<?php
session_start();
use Core\Router;
use Core\Model\User;

//* INCLUDE THE FILE WE NEED
spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'Core') === false)
        return;
    //* CONVERT THE BACKSLASH TO FORWORDSLASH TO BE SUTABLE WITH THE PATH DIR
    $class_name = str_replace("\\", '/', $class_name);
    //*GET THE PATH 
    $file_path = __DIR__ . "/" . $class_name . ".php";
    //*INCLUDE THE THE CLASS
    require_once $file_path;
});

    //*LOGIN USER ATUOMATICLY
    if (isset($_COOKIE['cookie']) && !isset($_SESSION['user'])) { //* check if there is user_id cookie.
    //*GET THE USER MODEL
    $user = new User();
    //*GET THE LOGEDIN USER BY ROLE
    $logged_in_user = $user->get_by_role($_COOKIE['cookie']); 
     //*SAVE THE LOGEDIN USER INFORMATION IN THE "USER" SESSION
    $_SESSION['user'] = array(
        'username' => $logged_in_user->username,
        'user_id' => $logged_in_user->id,
        'photo' => $logged_in_user->photo,
        'user_email' => $logged_in_user->email,
        'user_password' => $logged_in_user->password,
        'is_admin_view' => true,
        'role'=>$logged_in_user->role
);
}

//?====================================(ALL ROUTERS)===========================================

 //todo=======( AUTHENTICATIONS )===================
 
Router::get('/', 'authentication.login');                //* SHOW THE LOGIN PAGE
Router::post('/authenticate', "authentication.validate");//* CHECK AND AUTHENTICATE THE USER
Router::get('/logout', "authentication.logout");         //* LOGOUT THE USER

//todo=========( DASHBOARD )========================

Router::get('/dashboard', "admin.index");                //* SHOW THE DASHBOARD TEMPLET

//todo==========( USER )============================

Router::get('/users', "users.index");                    //* GET ALL USERS 
Router::get('/user', "users.single");                    //* GET USER BY ID 
Router::get('/users/create', "users.create");            //* SHOW THE USER'S CREATE FORM
Router::post('/users/store', "users.store");             //* CREATE USER
Router::get('/users/edit', "users.edit");                //* SHOW THE USER'S EDIT FORM
Router::post('/users/update', "users.update");           //* UPDATE USER
Router::get('/users/delete', "users.delete");            //* DELETE USER
Router::get('/users/report', "users.report");            //* REPORT PAGE
Router::post('/user/messenger', "users.messenger");           //* Send MESSAGE
Router::get('/md', "users.delete_mss");           //* Delete MESSAGE

//todo=========( ITEMS )============================

Router::get('/itmes', "items.index");                    //* GET ALL ITEMS 
Router::get('/item', "items.single");                    //* GET ITEM BY ID
Router::get('/items/create', "items.create");            //* SHOW THE ITEM'S CREATE FORM
Router::post('/items/store', "items.store");             //* CREATE ITEM
Router::get('/items/edit', "items.edit");                //* SHOW THE ITEM'S EDIT FORM
Router::post('/items/update', "items.update");           //* UPDATE ITEM
Router::get('/items/delete', "items.delete");            //* DELETE ITEM

//todo=======( PROFILE )============================

Router::get('/profile', "profile.show_info");            //* SHOW THE USER PROFILE
Router::post('/update/profile', "profile.update");       //* UPDATE THE USER PROFILE

//todo=======( SELLING )============================

Router::get('/transaction/sellers', "selling.get");         //* AJAX TO GET ALL THE TRANSACTION THAT HAS BEEN MADE TODAY BY THE CURRENT LOGGED IN USER
Router::get('/All_items', "selling.index");                 //* AJAX TO GET ALL THE ITEMS 
Router::post('/transaction/create', 'selling.create');      //* AJAX TO CREATE NEW TRANSACTIONS
Router::put('/item_Qty/update', 'selling.update');          //* AJAX TO UPDATE THE ITEM QUANTITY 
Router::put('/transaction_Qty/update', 'selling.update_transaction'); //* AJAX TO UPDATE THE ITEM QUANTITY AND TRANSACTION QUANTITY
Router::delete('/item_sales/delete', 'selling.delete');       //* AJAX TO DELETE THE SALLES



//todo=======( TRANSACTIONS )============================


Router::get('/transactions', "transactions.index");         //* GET ALL TRANSACTION
Router::get('/transaction/single', "transactions.single");  //* GET TRANSACTION BY ID 
Router::get('/transaction/edit', "transactions.edit");      //* SHOW THE TRANSACTION'S EDIT FORM
Router::post('/transaction/update', "transactions.update"); //* UPDATE TRANSACTION
Router::get('/transaction/delete', "transactions.delete");  //* DELETE TRANSACTION
Router::get('/selling', "transactions.selling_view");       //* SHOW THE SALLIING DASHBOARD

//todo=====( REDIRECT )=============================

Router::redirect();                                         //*  REDIRECT METHOD BASED ON GET / POST / PUT / DELETE
