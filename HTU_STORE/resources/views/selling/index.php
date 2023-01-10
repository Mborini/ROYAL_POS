<div class="container my-5">
    <input type="hidden" id="username" value="<?= $_SESSION['user']['user_id'] ?>">
    <div id="product_pox">

        <div class="d-flex justify-content-between mb-3">
            <div></div>
            <h1 class=" fw-bolder">Selling Dashboard</h1>


            <div>
                <button class="btn btn-primary Flash fw-bolder " type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">ALL SALLES</button>


            </div>
            <div class="offcanvas  offcanvas-end w-100" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header text-center gap-5 ">
                    <h5 class="offcanvas-title container  " id="offcanvasRightLabel">
                        <?= date('l jS \of F Y h:i:s A') ?>

                    </h5>
                    <button class="btn btn-primary" id="myprint">
                        <i class="fa-solid fa-print Flash"></i>
                    </button>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>


                <div class="offcanvas-body">
                    <div id="daily_table" class="">
                        <table class="table  m-auto mt-5 border ">
                            <thead class="table-danger ">
                                <tr class="fw-bolder text-center ">
                                    <td scope="col">Item Name</td>
                                    <td scope="col">price</td>
                                    <td scope="col">Quantity</td>
                                    <td scope="col">Total</td>
                                    <td scope="col">created at</td>
                                    <td scope="col">state</td>
                                </tr>
                            </thead>
                            <tbody id="transaction_list" class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid d-flex ml-0 mb-3 gap-3 w-100">
            <input id="search" type="search" class="form-control mr-2 w-75  " placeholder=" Search Barcode Or Name....."
                aria-label="search" aria-describedby="search" name="search">


            <button id="complete_shop" class="btn save btn-success info">SAVE </button>
            <div class="info mt-2 ml-2">
                <strong class="text-success  ms-1" class="color">Total Sales:</strong>
                <span class="text-success" id="total-sales"> 0 </span>
            </div>

        </div>

        <div id="dataTableContainer">

            <table class="table table-hover fw-bolder container w-100 fixedHeader  text-center">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">photo</th>
                        <th scope="col"> Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col"> Price</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="items_list">
                </tbody>
            </table>
        </div>
    </div>
</div>
