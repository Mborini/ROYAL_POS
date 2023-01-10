<br><br>


<div class="text-center text-primary">
    <h1>Add New Item </h1>

</div>

<div>
    <div class="container ml-5 mb-4"> <a href="/itmes" class="btn btn-primary shadow"><i
                class="fas fa-long-arrow-alt-left"></i></a>
    </div>
    <?php 
    //*====================== MASSAGE ================
    if (!empty($_SESSION) && isset($_SESSION['item_error_create']) && !empty($_SESSION['item_error_create'])) : ?>
    <div class="alert alert-danger container text-center " id="myDiv" role="alert">
        <?= $_SESSION['item_error_create'] ?>
    </div>
    <?php
            $_SESSION['item_error_create'] = null; 
        endif; 
        //*=============================================
        ?>
    <?php 
    //*====================== MASSAGE ==================
    if (!empty($_SESSION) && isset($_SESSION['barcode']) && !empty($_SESSION['barcode'])) : ?>
    <div class="alert alert-danger container text-center " id="myDiv" role="alert">
        <?= $_SESSION['barcode'] ?>
    </div>
    <?php
            $_SESSION['barcode'] = null; 
        endif; 
        //*=============================================
        ?>
    <?php 
    //*====================== MASSAGE ==================
    if (!empty($_SESSION) && isset($_SESSION['item_name']) && !empty($_SESSION['item_name'])) : ?>
    <div class="alert alert-danger container text-center " id="myDiv" role="alert">
        <?= $_SESSION['item_name'] ?>
    </div>
    <?php
            $_SESSION['item_name'] = null; 
        endif; 
        //*==============================================
        ?>

    <form action="/items/store" method="POST" enctype="multipart/form-data"
        class="container col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <div class="mb-3 ">
            <label for="item-title" class="form-label pl-2 fw-bolder text-primary"> Barcode</label>
            <input type="number" class="form-control shadow  w-100" required name="barcode">
        </div>
        <div class="mb-3">
            <label for="item-title" class="form-label pl-2 fw-bolder text-primary ">Item Name</label>
            <input type="text" class="form-control shadow" required name="item_name">
        </div>
        <div class="mb-3">
            <label for="item-title" class="form-label pl-2 fw-bolder text-primary">Cost price</label>
            <input type="number" class="form-control shadow" required step="any" name="selling_price">
        </div>
        <div class="mb-3">
            <label for="item-title" class="form-label pl-2 fw-bolder text-primary">Buying price</label>
            <input type="number" class="form-control shadow" required step="any" name="buying_price">
        </div>
        <div class="mb-3">
            <label for="item-title" class="form-label pl-2 fw-bolder text-primary"> Quantity</label>
            <input type="number" class="form-control shadow" required name="quantity">
        </div>

        <div class="mb-3 ">
            <label for="item-title" class="form-label pl-2 fw-bolder text-primary"> photo</label>
            <input type="file" class="form-control shadow w-100" required name="photo">
        </div>


        <button type="submit" class="btn btn-primary mt-4 w-100 fw-bolder shadow">CREATE</button>
    </form>
</div>
<br><br>