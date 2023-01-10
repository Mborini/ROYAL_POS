<br><br>
<div class="container d-flex text-center justify-content-center  mt-2 mb-3">
    <h1 class="text-primary"> All Transactions</h1>
</div>
<div class="d-flex justify-content-center   mb-3">
    <button class="btn btn-primary" id="myprint"><i class="fa-solid fa-print Flash"></i></button>
</div>


<div class="container ml-2 ">

    <?php 
        //*========================== MASSAGE ==============================================
        if (!empty($_SESSION) && isset($_SESSION['transaction_delete']) && !empty($_SESSION['transaction_delete'])) : ?>
    <div class="alert alert-success container w-75 text-center " id="myDiv" role="alert">
        <?= $_SESSION['transaction_delete'] ?>
    </div>
    <?php 
            $_SESSION['transaction_delete'] = null; 
        endif; 
        //*=================================================================================
        ?>
    <div class="d-flex  container justify-content-center md-3 col-xs-12 ">
        <table class="table table-striped frf text-center border ">


            <thead class="table-primary">
                <tr class="">
                    <th scope="col">Trens #</th>
                    <th scope="col">Created by</th>

                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col" class="hid">Created At</th>
                    <th scope="col" class="hid">Updated At</th>
                    <th scope="col" class="w_p"> </th>
                    <th scope="col" class="w_p"> </th>


                </tr>
            </thead>
            <tbody>
                <tr class="text-center bolder"><?php foreach ($data->transaction as $transactions) : ?>
                    <td><?= $transactions->transaction_id ?></td>
                    <th scope="row"><?= $transactions->username ?></th>

                    <td><?= $transactions->item_name ?></td>
                    <td><?= $transactions->item_quantity?> </td>
                    <td><?= $transactions->total ?></td>
                    <td class="hid"><?= $transactions->created_at ?></td>
                    <td class="hid"><?= $transactions->update_at ?></td>
                    <td class="w_p">
                        <a href="/transaction/edit?id=<?= $transactions->id?>"
                            class=" w-100 justify-content-center text-warning "><i class="fas fa-edit"></i></a>
                    </td>
                    <td class="w_p">
                        <a href="/transaction/delete?id=<?= $transactions->id ?>" type="button" class=" w-100"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fas fa-trash-alt text-danger"></i></a>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Attention</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are You Sure To Telete This Transaction?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <a href="/transaction/delete?id=<?= $transactions->id?>"
                                            class="btn btn-danger d-flex justify-content-center ">Yes Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr><?php endforeach; ;?>
            </tbody>
    </div>
    </table>
</div>