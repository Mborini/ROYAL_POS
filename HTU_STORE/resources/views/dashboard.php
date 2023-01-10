<div class="container mt-5"><br>
    <h3 class="font-weight-bold text-center dark-grey-text fw-bolder  pb-2 name_market">TECH MARCKET</h3>
    <hr class="border border-danger border-2 opacity-50">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card border-left-primary box c h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold text-primary text-center icone_color_dash text-uppercase mb-1">
                                <h2 class="icone_color_dash">Totla Items</h2>
                            </div>
                            <div class="h5 mb-0  ml-3 font-weight-bold text-center fw-bloder text-gray-800  ">
                                <h2><?= $data->items_count ?> <span class="text-primary text-opacity-50"><i
                                            class="fa-solid fa-warehouse icone_color_dash"></i></span></h2>
                            </div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card border-left-success c box h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-center  text-uppercase mb-1">
                                <h2>Totla Users</h2>
                            </div>
                            <div
                                class="h5 mb-0 d-flex justify-content-around ml-3 font-weight-bold text-center fw-bloder text-gray-800">
                                <h2><?=$data->users_count ?><span class="text-primary text-opacity-50"> <i
                                            class="fas fa-users"></i></span></h2>
                                <a href="users/report" class="btn btn-primary Flash"><i
                                        class="fa-solid fa-file-invoice"></i></a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning box h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-center  text-uppercase mb-1">
                                <h3>Transactions</h3>
                            </div>
                            <div class="h5 mb-0  ml-3 font-weight-bold text-center fw-bloder text-gray-800">
                                <h2><?= $data->transactions_count?><span class="text-primary text-opacity-50">
                                        <i class="fa-solid fa-file-invoice-dollar text-danger"></i></span></h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning box h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-center  text-uppercase mb-1">
                                <h2>Total Salles</h2>
                            </div>
                            <div class="h5 mb-0  ml-3 font-weight-bold text-center fw-bloder text-gray-800">
                                <h2><?=$data->sum_sales?><span class="text-primary text-opacity-50"> <i
                                            class="fas fa-money-bill-wave text-success"></i></span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-warning box h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-center  mb-1">
                                <h1>Top 5 Expensive </h1>
                            </div>
                        </div>
                        <div class="col-auto w-100">
                            <table class="table text-center ">
                                <thead>
                                    <tr class="table-warning ">
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php       
                                     //*GET TOP FIVE ExPENSIVE ITEM TO BUY
                                        $counter=1; 
                                        foreach ($data->top_5 as $TOP) : ?>
                                    <tr>
                                        <th scope="row"><?=$counter?> </th>
                                        <td class="fw-bolder"><?= $TOP->item_name?> </td>
                                        <td class="fw-bolder"><?= $TOP->buying_price?> <span
                                                class="fw-bolder text-success">JD</span> </td>
                                    </tr>
                                    <?php $counter++;
                                        endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>