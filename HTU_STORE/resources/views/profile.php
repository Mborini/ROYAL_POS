<br><br>
<div class="container">
    <div class="container text-center">
        <div>
        </div>
        <img class="img-profile t rounded-circle img_user_profile" src="<?=$data->user->photo?>">
    </div>
    <form enctype="multipart/form-data" class="container col-lg-6 col-md-6 col-sm-10 col-xs-12 mb-5"
        action="/update/profile" method="POST">
        <div class="mb-3 mt-1 ">

            <?php
            //*MASSAGE ERROR 
            if (!empty($_SESSION) && isset($_SESSION['error_update_profile']) && !empty($_SESSION['error_update_profile'])) : ?>
            <div class="alert alert-danger container w-100 mt-0 mb-0 fw-bolder text-center" id="myDiv" role="alert">
                <?= $_SESSION['error_update_profile'] ?>
            </div>
            <?php
            $_SESSION['error_update_profile'] = null; 
            endif; 
            ?>

            <?php 
            //*MASSAGE CORRECT
            
            if (!empty($_SESSION) && isset($_SESSION['correct_update_profile']) && !empty($_SESSION['correct_update_profile'])) : ?>
            <div class="alert alert-success container w-100 text-center  " id="myDiv" role="alert">
                <?= $_SESSION['correct_update_profile'] ?>
            </div>
            <?php
            $_SESSION['correct_update_profile'] = null; 
            endif; ?>
            <label for="exampleInputEmail1" class="form-label fw-bolder text-primary">User Name</label>
            <input type="text" id="defaultSubscriptionFormPassword " required name="username"
                value="<?=$data->user->username?>" class="form-control mb-4" placeholder=" User Name">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label  fw-bolder text-primary">Display name</label>
            <input type="text" id="defaultSubscriptionFormEmail" name="display_name"
                value="<?=$data->user->display_name?>" required class="form-control mb-4 shadow"
                placeholder="display name">
        </div>
        <div class="mb-3">
            <input type="text" hidden id="defaultSubscriptionFormPassword" name="id" value="<?=$data->user->id?>"
                class=" shadow form-control mb-4" placeholder="Name">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label  fw-bolder text-primary">Email address</label>
            <input type="email" id="defaultSubscriptionFormEmail" required name="email" value="<?=$data->user->email?> "
                class=" shadow form-control mb-4" placeholder="E-mail">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label  fw-bolder text-primary">Photo Profile</label>
                <input type="file" id="defaultSubscriptionFormEmail" name="photo" required
                    class="form-control mb-4 shadow" placeholder="photo">
            </div>
            <button type="submit" class="btn btn-warning fw-bolder  w-100 shadow" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                CHANGE
            </button>
    </form>
</div>