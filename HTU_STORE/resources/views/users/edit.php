<br>

<div class="container mt-3  "><a href="/user?id=<?= $data->user->id ?>" class="btn btn-primary ms-3 mt-4 "><i
            class="fas fa-long-arrow-alt-left"></i></a>
    <form action="/users/update" enctype="multipart/form-data" method="POST"
        class="container col-lg-6 col-md-6 col-sm-10 col-xs-12 mb-5 ">

        <div class="cotainer text-center  mb-2">
            <h1 class="text-warning">Edit User Information</h1>
        </div>

        <?php
        //* ============================MASSAGE ===============================
        if (!empty($_SESSION) && isset($_SESSION['user_edit_error']) && !empty($_SESSION['user_edit_error'])) : ?>
        <div class="alert alert-danger text-center  " id="myDiv" role="alert">
            <?= $_SESSION['user_edit_error'] ?>
        </div>
        <?php
            $_SESSION['user_edit_error'] = null; 
        endif; 
        //*====================================================================
        ?>

        <input type="hidden" name="id" value="<?= $data->user->id ?>">
        <div class="mb-3">
            <label for="user-username" class="form-label  fw-bolder text-warning ">Display name</label>
            <input type="text" class="form-control shadow  " id="username-email" name="display_name" required
                value="<?= $data->user->username ?>">
        </div>
        <div class="mb-3">
            <label for="user-username" class="form-label  fw-bolder text-warning ">Username</label>
            <input type="text" class="form-control shadow  " id="username-email" name="username" required
                value="<?= $data->user->username ?>">
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label fw-bolder text-warning">Email</label>
            <input type="email" class="form-control shadow " id="user-email" name="email" required
                value="<?= $data->user->email ?>">
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label fw-bolder text-warning">Salary</label>
            <input type="number" class="form-control shadow " id="user-email" name="salary" required
                value="<?= $data->user->salary ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label  fw-bolder text-warning">Photo</label>
            <input type="file" class="form-control  shadow border-success" id=" item_photo" required name="photo">
        </div>
        <div class="mb-3">
            <label for="user-role" class="form-label fw-bolder text-warning">Role</label>
            <select class="form-select shadow " aria-label="Role" name="role" required>
                <option selected disabled>Select Role</option>
                <option value="admin">admin</option>
                <option value="seller">seller</option>
                <option value="procurement">procurement</option>
                <option value="accountant">accountant</option>
            </select>
        </div>
        <div class="d-flex text-center justify-content-center">
            <button type="submit" class="btn btn-warning ms-3 shadow fw-bolder mt-4" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                UPDATE
            </button>