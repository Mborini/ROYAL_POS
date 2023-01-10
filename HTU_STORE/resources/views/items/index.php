<br><br>


<div class="container  d-flex justify-content-between ">
    <a type="button" href="./items/create" id="f" class="btn btn-primary  position-relative">
        <i class="fas fa-plus Flash"></i><br>
        <span class="position-absolute top-0  start-100 translate-middle badge rounded-pill bg-warning" id="q">
            ITEMS
            <?php
                if( $data->items_count >10 ):?>
            <?=  '10' ."+"; ?>
            <?php else :?>
            <?=  $data->items_count  ?>
            <?php endif ?>
        </span>
    </a>

    <h3 class=" text-primary  ">All Items </h3>
    <div></div>


</div>




<?php 
     //* ========================== MASSAGE ==================================
    if (!empty($_SESSION) && isset($_SESSION['item_correct_create']) && !empty($_SESSION['item_correct_create'])) : ?>
<div class="alert alert-success container text-center w-50 " id="myDiv" role="alert">
    <?= $_SESSION['item_correct_create'] ?>
</div>
<?php
            $_SESSION['item_correct_create'] = null; 
        endif; ?>
<?php if (!empty($_SESSION) && isset($_SESSION['item_deleting']) && !empty($_SESSION['item_deleting'])) : ?>
<div class="alert alert-success container text-center w-50 " id="myDiv" role="alert">
    <?= $_SESSION['item_deleting'] ?>
</div>
<?php
            $_SESSION['item_deleting'] = null; 
        endif;
        //*=======================================================================
        ?>




<div class="container  d-flex justify-content-center">

    <div class="row ">
        <?php foreach ($data->items as $item) : ?>
        <div class=" col-md-6 col-lg-3 col-xl-2 col-6 mt-4 mb-2">
            <div class="card box">
                <div class="card-body">
                    <img class="card-img-top" width="90%" height="150px" src=" <?= $item->photo ?>"
                        alt="Card image cap">
                    <h5 class="card-title"><?= $item->item_name?></h5>
                    <p class="text-muted"><strong><i class="fas fa-qrcode"></i></i></strong> <?= $item->barcode?></p>

                    <a href="./item?id=<?= $item->id ?>" class="card-link btn btn-primary">Check</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>