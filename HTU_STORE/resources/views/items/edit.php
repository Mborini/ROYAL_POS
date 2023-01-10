<br>

<form action="/items/update" enctype="multipart/form-data" method="POST"
    class="container col-lg-6 col-md-6 col-sm-10 col-xs-12 mb-5">
    <a href="/item?id=<?= $data->item->id?>" class="btn btn-primary ml-5 mt-4 shadow"><i
            class="fas fa-long-arrow-alt-left"></i></a>
    <div class="p-5">
        <div class="container d-flex justify-content-center">
            <h1 class="fw-bolder text-warning">Edit Item </h1>
        </div>

        <?php 
        //*==========================MASSAGE=========================================
        if (!empty($_SESSION) && isset($_SESSION['item_update_error']) && !empty($_SESSION['item_update_error'])) : ?>
        <div class="alert alert-danger text-center" id="myDiv" role="alert">
            <?= $_SESSION['item_update_error'] ?>
        </div>
        <?php
            $_SESSION['item_update_error'] = null; 
        endif; ?>
        <?php if (!empty($_SESSION) && isset($_SESSION['update_error2']) && !empty($_SESSION['update_error2'])) : ?>
        <div class="alert alert-success text-center" id="myDiv" role="alert">
            <?= $_SESSION['update_error2'] ?>
        </div>
        <?php
            $_SESSION['update_error2'] = null; 
        endif; 
         //*==========================================================================
        ?>

        <input type="hidden" name="id" value="<?= $data->item->id ?>">
        <div class="mb-3">
            <label for="item-title" class="form-label fw-bolder text-warning"> Barcode</label>
            <input type="number" class="form-control shadow" name="barcode" required
                value="<?= $data->item->barcode ?>">
        </div>
        <div class="mb-3">
            <label for="item-title" class="form-label fw-bolder text-warning">Item Name</label>
            <input type="text" class="form-control shadow" name="item_name" required
                value="<?= $data->item->item_name ?>">
        </div>
        <div class="mb-3">
            <label for="item-title" class="form-label fw-bolder text-warning">Cost Price</label>
            <input type="number" class="form-control shadow" name="selling_price" step="any" min="1"
                pattern="[1-100000]*" required value="<?= $data->item->selling_price ?>">
        </div>
        <div class="mb-3">
            <label for="item-title" class="form-label fw-bolder text-warning">Buying price</label>
            <input type="number" class="form-control shadow" name="buying_price" step="any" pattern="[1-100000]*"
                min="1" pattern="[1-100000]*" required value="<?= $data->item->buying_price ?>">
        </div>
        <div class="mb-3">
            <label for="item-title" class="form-label fw-bolder text-warning"> Quantity</label>
            <input type="number" class="form-control shadow" name="quantity" required pattern="[1-100000]*" min="1"
                value="<?= $data->item->quantity ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label   fw-bolder text-warning">Photo</label>
            <input type="file" class="form-control border-success shadow" id=" item_photo" required name="photo">
        </div>





        <button type="submit"
            class=" d-flex justify-content-center shadow container btn btn-warning mt-4 fw-bolder">UPDATE</button>
    </div>
</form>