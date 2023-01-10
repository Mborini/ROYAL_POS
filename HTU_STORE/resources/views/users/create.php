<div class=" py-5 z-depth-1">
    <section>
        <div class="row d-flex justify-content-center  ">


            <form enctype="multipart/form-data" class="container col-lg-6 col-md-6 col-sm-10 col-xs-12 mb-5"
                action="/users/store" method="POST">
                <a href="/users" class="btn btn-primary"> <i class="fas fa-long-arrow-alt-left"></i>

                </a>
                <div class="text-center">
                    <h1 class="mb-4 text-info">Create User</h1>
                </div>

                <?php 
                    //*======= MASSAGE ==============
                    
                    if (!empty($_SESSION) && isset($_SESSION['user_create_error']) && !empty($_SESSION['user_create_error'])) : ?>
                <div class="alert alert-danger text-center " id="myDiv" role="alert">
                    <?= $_SESSION['user_create_error'] ?>
                </div>
                <?php
                          $_SESSION['user_create_error'] = null; 
                      endif;
                       //*============================
                      ?>

                <?php 
                    //*======= MASSAGE ==============
                    
                    if (!empty($_SESSION) && isset($_SESSION['check_exist_display_name']) && !empty($_SESSION['check_exist_display_name'])) : ?>
                <div class="alert alert-danger text-center " id="myDiv" role="alert">
                    <?= $_SESSION['check_exist_display_name'] ?>
                </div>
                <?php
                          $_SESSION['check_exist_display_name'] = null; 
                      endif;
                       //*============================
                      ?>

                <?php 
                    //*======= MASSAGE ==============
                    
                    if (!empty($_SESSION) && isset($_SESSION['check_exist_user_name']) && !empty($_SESSION['check_exist_user_name'])) : ?>
                <div class="alert alert-danger text-center " id="myDiv" role="alert">
                    <?= $_SESSION['check_exist_user_name'] ?>
                </div>
                <?php
                          $_SESSION['check_exist_user_name'] = null; 
                      endif;
                       //*============================
                      ?>

                <div class="form-row mb-4">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label  fw-bolder text-info">User Name</label>
                        <input type="text" id="defaultRegisterFormFirstName" class="form-control shadow" required
                            name="username">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label  fw-bolder text-info">Display Name</label>
                        <input type="text" id="defaultRegisterFormFirstName" class="form-control shadow" required
                            name="display_name">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label  fw-bolder text-info">Salary</label>
                        <input type="number" id="defaultRegisterFormFirstName" class="form-control shadow" required
                            name="salary">
                    </div>

                    <div class="form-row mb-0">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label  fw-bolder text-info">Email
                                address</label>
                            <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4 shadow" required
                                name="email">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label  fw-bolder text-info">Password</label>
                            <input type="password" id="defaultRegisterFormPassword" required name="password"
                                class="form-control shadow" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label mt-3 fw-bolder text-info">Role</label>
                        <select class="form-select border-success shadow" aria-label="Role" required name="role">
                            <option selected disabled>Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="seller">Seller</option>
                            <option value="procurement">Procurement</option>
                            <option value="accountant">Accountant</option>
                        </select>
                    </div>
                    <div class="mb-2 mt-0">
                        <label for="exampleInputEmail1" class="form-label mt-3 fw-bolder text-info">Photo</label>
                        <input type="file" class="form-control border-success shadow" name="photo" id=" item_photo">
                    </div>
                    <button type="submit" class="btn btn-info my-4 btn-block shadow fw-bolder">CREATE</button>
            </form>

        </div>
    </section>
</div>