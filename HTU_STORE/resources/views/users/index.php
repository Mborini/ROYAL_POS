<div class="container my-5">


    <div class="container  d-flex justify-content-between ">
        <a type="button" href="./users/create" id="f" class="btn btn-primary  position-relative">
            <i class="fas fa-plus Flash"></i><br>
            <span class="position-absolute top-0  start-100 translate-middle badge rounded-pill bg-warning" id="q">
                TOTAL USERS
                <?php
                if( $data->users_count >5 ):?>
                <?=  "5" ."+"; ?>
                <?php else :?>
                <?=  $data->users_count  ?>
                <?php endif ?>
            </span>
        </a>

        <h3 class=" text-primary  ">All User </h3>
        <div></div>


    </div>



</div>
<section class="team-section">
    <ul class="list-unstyled d-flex align-items-center mb-0">
        <?php 
            //*============= massages ==============
            if (!empty($_SESSION) && isset($_SESSION['complete_creating']) && !empty($_SESSION['complete_creating'])) : ?>
        <div class="alert alert-success container w-50 mt-0 mb-0 fw-bolder text-center" id="myDiv" role="alert">
            <?= $_SESSION['complete_creating'] ?>
        </div>
        <?php
                    $_SESSION['complete_creating'] = null; 
                    endif; ?>
        <?php    
                    if (!empty($_SESSION) && isset($_SESSION['user_delete']) && !empty($_SESSION['user_delete'])) : ?>
        <div class="alert alert-danger container w-50 text-center " id="myDiv" role="alert">
            <?= $_SESSION['user_delete'] ?>
        </div>
        <?php
                    $_SESSION['user_delete'] = null; 
                    endif;
                      //*====================================
                    
                    ?>

    </ul>
    <div class="card-body ">
        <div class="row  pt-4">
            <?php foreach ($data->users as $user) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6  pb-4">
                <div class="   text-center">
                    <a href="./user?id=<?= $user->id ?> ">
                        <img src="<?= $user->photo ?>" class="img-fluid   img_user shadow z-depth-1" />
                    </a>
                </div>
                <div class="text-center mt-2">
                    <h6 class="font-weight-bold pt-2 mb-0 "><?= $user->display_name ?></h6>

                    <p class="text-muted mb-0"><small> <?= $user->role ?></small></p>
                    <?php if ($user->active ): ?>

                    <h5 class="text-success mb-0 text-success"><i class="fa-regular fa-circle-dot online "></i> Online
                    </h5>
                    <?php endif?>
                    <?php if (!$user->active ): ?>
                    <h5 class="text-danger mb-0 "><i class="fa-regular fa-circle-dot "></i> Ofline</h5>
                    <?php endif?>
                </div>
            </div>
            <?php endforeach; ;?>
        </div>
    </div>
</section>
</div>