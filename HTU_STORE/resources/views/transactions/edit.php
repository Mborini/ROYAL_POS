<br>

<div class="container mt-0">
    <a href="/transactions" class="btn btn-primary ms-3 mt-4 "><i class="fas fa-long-arrow-alt-left"></i></a>
    <h1 class="d-flex justify-content-center mb-5 text-warning">Edit Transaction</h1>
    <form action="/transaction/update" class="w-50 container mt-5" method="POST">

        <div class="form-group">

            <?php 
                        //*=========================== MASSAGE ==============================================
            if (!empty($_SESSION) && isset($_SESSION['tran_error']) && !empty($_SESSION['tran_error'])) : ?>
            <div class="alert alert-danger text-center" id="myDiv" role="alert">
                <?= $_SESSION['tran_error'] ?>
            </div>
            <?php
            $_SESSION['tran_error'] = null;
        endif; ?>
            <?php if (!empty($_SESSION) && isset($_SESSION['tran_error1']) && !empty($_SESSION['tran_error1'])) : ?>
            <div class="alert alert-danger text-center " id="myDiv" role="alert">
                <?= $_SESSION['tran_error1'] ?>
            </div>
            <?php
            $_SESSION['tran_error1'] = null;
        endif; 
         //*========================================================================================
        ?>

            <label for="exampleInputEmail1" class="form-label  fw-bolder text-warning w-100">Item Name</label>
            <input type="text" class="form-control " id="exampleInputEmail1" hidden name="id"
                aria-describedby="emailHelp" value="<?= $data->tran->id?>" placeholder="Enter email">
            <input type="text" class="form-control shadow" id="exampleInputEmail1 " name="item_name"
                aria-describedby="emailHelp" value="<?= $data->tran->item_name?>" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class=" fw-bolder text-warning w-100">price</label>
            <input type="number" class="form-control shadow " value="<?= $data->tran->item_price?>" min="1"
                pattern="[1-100000]*" id="I_price" step="any" name="item_price" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1 " class=" fw-bolder text-warning w-100">Item Quantity</label>
            <input type="number" value="<?= $data->tran->item_quantity?>" class="form-control shadow" id="I_quantity"
                pattern="[1-100000]*" min="1" name="item_quantity" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class=" fw-bolder text-warning w-100">Total</label>
            <input type="number" class="form-control shadow" readonly value="<?= $data->tran->total?>" id="I_total"
                name="total" aria-describedby="emailHelp" step="any" placeholder="Enter email">
        </div>
        <br>
        <button type="button" class="btn btn-warning w-100 shadow fw-bolder" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            SAVE
        </button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Attention</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are You Sure To Change Your Informations?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success">Yes And Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>