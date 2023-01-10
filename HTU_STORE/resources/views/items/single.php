<br><br><br><br>
<br>
<?php 
        //* ============== MASSAGE ===================================
    if (!empty($_SESSION) && isset($_SESSION['item_update_correct']) && !empty($_SESSION['item_update_correct'])) : ?>
<div class="alert alert-success container w-25 text-center" id="myDiv" role="alert">
    <?= $_SESSION['item_update_correct'] ?>
</div>
<?php
    $_SESSION['item_update_correct'] = null; 
    endif; 
    //*=======================================================
    
    ?><div class="container ml-5"><a href="/itmes" class="btn btn-primary  mb-2">
        <i class="fas fa-long-arrow-alt-left"></i></a></div>
<div class=" py-2 container w-75 mt-0">
    <div class="card mb-3 box">

        <div class="row g-0 w-100">
            <div class="col">
                <img src="<?=$data->item->photo ?>" class="img-fluid rounded-start m-auto" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title"><?= $data->item->item_name ?></h1>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-qrcode"></i> <?=$data->item->barcode ?>
                            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fa-regular fa-calendar-days text-success "></i>
                            </button>
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1> <i
                                                class="fa-solid fa-circle-info"></i>
                                            DATES
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">


                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>Created At :
                                                    </strong><?=$data->item->created_at ?></li>
                                                <li class="list-group-item"><strong>Updated At : </strong>
                                                    <?=$data->item->updated_at ?></li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer text-center container">
                                            <button type="button" class="btn btn-secondary "
                                                data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class="btn" href="/items/delete?id=<?= $data->item->id ?>">
                                <i class="fa-solid fa-trash-arrow-up text-danger "></i>

                            </a>
                            <a href="/items/edit?id=<?= $data->item->id ?>" class="btn"><i
                                    class="fa-solid fa-pen text-warning"></i></a>



                        </li>

                        <li class="list-group-item"><strong>Cost Price :</strong><?=$data->item->selling_price ?></li>
                        <li class="list-group-item"><strong>Buying Price :</strong><?=$data->item->buying_price ?></li>
                        <li class="list-group-item"><strong>Quantity in stock :</strong><?=$data->item->quantity ?>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>