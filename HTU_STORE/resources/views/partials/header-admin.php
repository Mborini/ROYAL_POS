<?php

use Core\Helpers\Helper; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROYAL POS</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/resources/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="admin-view">

    <br>

    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-warning fw-bolder ml-5" href="/dashboard">ROYAL (POS)</a>
            <a class="navbar-brand d-flex justify-content-end"><i
                    class="fas fa-hand-sparkles text-warning pr-2 mb-0"></i> <span class="mt-0">
                    <?=$data->display_name?></span> </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-3" id="offcanvasDarkNavbar">
                <div class="offcanvas-header d-flex justify-content-between mb-0">
                    <a class="nav-link active  " aria-current="page" href="/profile">
                        <img class="img-profile wh  mr-2 rounded-circle " src="<?=$data->photo?>"> <span
                            class="pro_name">Profile</span>
                    </a>
                    <h3 id="massege"><i class="fa-solid fa-comment-dots"></i></h3>
                    <input type="text" hidden id="massege_content" value="<?=$data->message?>">

                    <a class="nav-link active  " aria-current="page" href="/logout"><i
                            class="fas fa-sign-out-alt text-danger pr-2"></i>
                        Logout</a>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>

                </div>
                <div class="offcanvas-body mt-0">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">

                        </li>
                        <?php if (Helper::check_permission(['user:read'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/dashboard"><i
                                    class="fas fa-tachometer-alt   pr-2"></i>
                                Dashboarad</a>
                        </li>

                        <hr>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/users"><i
                                    class="fas fa-users text-warning  pr-2"></i>
                                Users</a>
                        </li>
                        <hr>
                        <?php endif;?>

                        <?php if (Helper::check_permission(['item:read'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/itmes"> <i
                                    class="fas fa-box-open text-primary  pr-2"></i>
                                Items</a>
                        </li>
                        <hr>
                        <?php endif;?>
                        <?php if (Helper::check_permission(['selling:read'])) : ?>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/selling"><i
                                    class="fas fa-shopping-cart text-danger  pr-2"></i> Selling</a>
                        </li>
                        <hr>
                        <?php endif;?>


                        <?php if (Helper::check_permission(['transaction:read'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/transactions"><i
                                    class="fas fa-layer-group text-muted  pr-2 "></i>
                                Transactions</a>
                        </li>


                        <?php endif;?>




                    </ul>

                </div>
            </div>
        </div>
    </nav>