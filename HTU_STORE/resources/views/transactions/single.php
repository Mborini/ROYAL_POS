<br><br><br>
<div class="container  mt-0">

    <?php 
    //*========================MASSAGE =======================================
    if (!empty($_SESSION) && isset($_SESSION['tran_correct']) && !empty($_SESSION['tran_correct'])) : ?>
    <div class="alert alert-success w-50 container text-center " id="myDiv" role="alert">
        <?= $_SESSION['tran_correct'] ?>
    </div>
    <?php
            $_SESSION['tran_correct'] = null;
        endif; 
        
         //*===================================================================
        ?>

    <a href="../transactions" class="btn btn-success">See All</a>
    <div class="card container w-50">
        <div class="card-body container">
            <h1 class="card-title fw-bolder text-center"><?= $data->tran->item_name?></h1>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <span class=" fw-bolder text-success">Item Price :</span>
                <?= $data->tran->item_price?>
            </li>
            <li class="list-group-item">
                <span class=" fw-bolder text-success">Quantity :</span>
                <?= $data->tran->item_quantity?>
            </li>
            <li class="list-group-item">
                <span class=" fw-bolder text-success ">Total :</span> <?= $data->tran->total?>
            </li>
            <li class="list-group-item">
                <span class=" fw-bolder text-success ">Created at:</span>
                <?= $data->tran->created_at?>
            </li>
            <li class="list-group-item">
                <span class=" fw-bolder text-success ">Updated at :</span>
                <?= $data->tran->update_at?>
            </li>
        </ul>
    </div>

</div>