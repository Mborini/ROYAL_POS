<?php

namespace Core\Controller;
use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Item;
use Core\Model\User;

class Items extends Controller
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
     * GET THE ALL ITEM
     * 
     * @return void
     */
    public function index()
    {   //*PERMISSIONS 
        $this->permissions(['item:read']);
        //* GET THE USER DISPLAY NAME AND THE PHOTO TO DISPLAY THEM IN HEADER
        $user = new User;
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //* DISPLAY ALL ITEM PAGE
        $this->view = 'items.index';
        //* CALL ITEM MODEL
        $item = new Item; 
        //* SAVE ALL DATA ITEM AND COUNT OF ITEMS
        $this->data['items'] = $item->get_all();
        $this->data['items_count'] = count($item->get_all());
    }    
    
    /**
     * single
     * GET THE INFORMATION FOR USER
     * @return void
     */
    public function single()
    {   //*PERMISSIONS 
         $this->permissions(['item:read']);    
        //* CREATE USER MODEL 
        $user = new User;
        //* CREATE ITEM MODEL
        $item = new Item();
        //*SAVE THE DISPLAY NAME AND PHOTO IN ARRAY TO PRESENT IT IN HEADER
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //* DISPLAY THE SINGEL PAGE OF ITEM
        $this->view = 'items.single';
        //* GET THE INFORMATION ITEM BY ID 
        $item_id= $item->get_by_id($_GET['id']);
        $date_create = new \DateTime($item_id->created_at);
        $item_id->created_at = $date_create->format('d/m/Y');
        $date_update= new \DateTime($item_id->updated_at);
        $item_id->updated_at = $date_update->format('d/m/Y');
        $this->data['item'] =$item_id;
    }
        
    /**
     * create
     * DISPLAY THE CREATE ITEM FORM
     * @return void
     */
    public function create()

    {   
        //*PERMISSIONS 
        $this->permissions(['item:read','item:create']); 
        //* CREATE USER MODEL
        $user = new User;
        //* GET THE USER DISPLAY NAME AND THE PHOTO TO SHOW THEM IN HEADER
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //* DISPLAY THE CRATE ITEM FORM
        $this->view = 'items.create';
    }


/* 
    $validation_item_name=$item->check_itemname($_POST["item_name"]);
    if ($validation_item_name) {
        $_SESSION["item_name"]="item is exist";
        //*RETURN TO ITEM CREATE PAGE
        Helper::redirect('/items/create');
        
    }
 */
    /**
     * store item information
     * 
     * @return void
     */
    public function store()
    {
    //*PERMISSIONS
    $this->permissions(['item:read','item:create']);
        //*CHECK THE POST
    if (empty($_POST["item_name"]) || empty($_POST["selling_price"]) || empty($_POST["barcode"]) || empty($_POST["buying_price"]) || empty($_POST["quantity"])|| $_POST["quantity"]<=0) {  
         //*SAVE A MASSEAGE ERROR
        $_SESSION["item_error_create"]="You Must Inter All Item's Informations";
        //*RETURN TO ITEM CREATE PAGE
        Helper::redirect('/items/create');
    } else {
    //*check if the barcode is exist or not
    $item = new Item();
    $validation_barcode=$item->check_barcode($_POST["barcode"]);
    if ($validation_barcode) {
        $_SESSION["barcode"]="Item Barcode is Exist  ";
        //*RETURN TO ITEM CREATE PAGE
        Helper::redirect('/items/create');
    } else {
        //*CHEC IF THE ITEM NAME IS EXIST OR NOT
        $validation_item_name=$item->check_itemname($_POST["item_name"]);
        if ($validation_item_name) {
            $_SESSION["item_name"]="Item is Exist";
            //*RETURN TO ITEM CREATE PAGE
            Helper::redirect('/items/create');
        } else {
            //*SAVE NEW SESSION AND HAVE A MASSEAGE
            $_SESSION["item_correct_create"]="New Item Added In The System Successfully";
            //*CHECK THE FILE
            if (!empty($_FILES)) {
                //* SEPERATE THE FILE PHOTO AND TYPE BY /
                $ext = explode('/', $_FILES['photo']['type']);
                //*SET EXT IN LAST FILE PATH
                $ext = $ext[array_key_last($ext)];
                //*GET THE ITEM NAME FROM THE POST AND SAVE IN FILE_NAME
                $name = $_POST['item_name'];
                $file_name = "item-$name.$ext";
                //*SAVE THE NEW PATH IN VARIABLE
                $photo = "./photos/$file_name";
                //*UPLOAD THE FILE TO THE VSCODE FILE
                move_uploaded_file($_FILES['photo']['tmp_name'], "./photos/$file_name");
                //*CREATE NEW POST AND SANE PHOTO VALUE IN IT
                $_POST['photo'] = $photo;
            }
            //*TO MAKE ALL DATA SECURIED FROM XSS ATTACHES 
            $this->htmlspecial($_POST);
            //*CREATE NEW ITEM
            $item->create($_POST);
            //*REDIRECT TO ALL ITEM PAGE
            Helper::redirect('/itmes');
        }
    }
}
}
    /**
     * Display the HTML form for item update
     *
     * @return void
     */
    public function edit() 
    {   //*PERMISSIONS 
        $this->permissions(['item:read','item:update']); 
        //* NEW USER MODEL 
        $user = new User;
        //* GET THE USER DISPLAY NAME AND THE PHOTO TO SHOW THEM IN HEADER
        $user_info=$user->get_by_id($_SESSION['user']['user_id']);
        $this->data['display_name']=$user_info->display_name;
        $this->data['photo']=$user_info->photo;
        $this->data['message']=$user_info->message;
        //* DISPLAY THE SINGEL PAGE OF ITEM TO EDIT
        $this->view = 'items.edit';
        //* CALL ITEM MODEL
        $item = new Item();
        //*GET THE USER ID INFORMATION
        $selected_item = $item->get_by_id($_GET['id']);
        //*SAVE THE ITEM INFORMATION
        $this->data['item'] = $selected_item;
    }
    /**
     * Updates 
     * UPDATE THE USER INFORMATION 
     * @return void
     */
    public function update()

    {
        //*PERMISSIONS 
        $this->permissions(['item:read','item:update']); 
        //*CHECK THE POST
        if(empty($_POST["item_name"]) || empty($_POST["selling_price"]) || empty($_POST["barcode"]) || empty($_POST["buying_price"]) || empty($_POST["quantity"]))
        {
        $_SESSION["item_update_error"]="You must inter all item informations";
        Helper::redirect("/items/edit?id=".$_POST["id"]);
        }
        else{
                //*SAVE A MASSEAGE ERROR
                if( $_POST["selling_price"]<=0 || $_POST["buying_price"]<=0 || $_POST["quantity"]<=0){
                $_SESSION["update_error2"]="There is value less than or equal zero";
                //*RETURN TO ITEM EDIT PAGE
                Helper::redirect('/items/edit?id='.$_POST["id"]);}
                        else{   
                                //*SET NEW SESSION AND HAVE MASSAGE
                                $_SESSION["item_update_correct"]="The Item Was Updated Successfully";  
                                //*NEW ITEM MODEL 
                                $item = new Item();
                                //*CHECK THE FILE
                                if (!empty($_FILES)) {
                                //* SEPERATE THE FILE PHOTO AND TYPE BY /
                                $ext = explode('/', $_FILES['photo']['type']);
                                //*SET EXT IN LAST FILE PATH 
                                $ext = $ext[array_key_last($ext)];
                                //*GET THE ITEM NAME FROM THE POST AND SAVE IN FILE_NAME
                                $name = $_POST['item_name'];
                                $file_name = "item-$name.$ext";
                                //*SAVE THE NEW PATH IN VARIABLE
                                $photo = "./photos/$file_name";
                                //*UPLOAD THE FILE TO THE VSCODE FILE 
                                move_uploaded_file($_FILES['photo']['tmp_name'], "./photos/$file_name");
                                //*CREATE NEW POST AND SANE PHOTO VALUE IN IT 
                                $_POST['photo'] = $photo;
                    }
        //*TO MAKE ALL DATA SECURIED FROM XSS ATTACHES 
        $this->htmlspecial($_POST);
        //*UPDETE THE POST INFORMATION
        $item->update($_POST);
        //*DISPLAY THE SINGLE ITEM PAGE 
        Helper::redirect('/item?id=' . $_POST['id']);
    }}}

    /**
     * DELETE THE ITEM BY ID
     *
     * @return void
     */
    public function delete()
    { 
        //*PERMISSITION TO ACCSESS TO THIS METHOD
        $this->permissions(['item:read', 'item:delete']); 
        //*SAVE NEW SESSTION HAVE A MASSAGE 
        $_SESSION["item_deleting"]="The Item Was Removed Successfully";
        //*NEW ITEM MODEL
        $item = new Item();
        //*DELETE THE ITEM BY ID 
        $item->delete($_GET['id']);
        //*REDIRECT TO THE ITEMS PAGE
        Helper::redirect('/itmes');
    }
}