<div class=" py-2 container mt-5">
    <a href="/users" class="btn btn-primary ml-1 mb-2">
        <i class="fas fa-long-arrow-alt-left"></i></a>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-3 col-md- col-sm-6 mt-4 pb-4">
                            <div class="avatar white text-center">
                                <img src="<?= $data->user->photo?>"
                                    class="img-fluid rounded-circle ml-5 img_user_single  shadow z-depth-1" />
                                </a>
                            </div>
                            <div class="text-center  ml-5 mt-2">
                                <h6 class="font-weight-bold ml-5 pt-2 mb-0 "><?= $data->user->display_name ?></h6>
                                <p class="text-muted ml-5 mb-0">
                                    <small><?= $data->user->role ?></small>
                                </p>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="col-lg-8 ">

                            <?php 
                            
                            //*============= MASSAGE ========================
                            if (!empty($_SESSION) && isset($_SESSION['complete_update']) && !empty($_SESSION['complete_update'])) : ?>
                            <div class="alert alert-success container w-50 text-center shadow" id="myDiv" role="alert">
                                <?= $_SESSION['complete_update'] ?>
                            </div>
                            <?php
                            $_SESSION['complete_update'] = null;
                            endif; 
                            
                             //*============================================
                            ?>
                            <?php   if (!empty($_SESSION) && isset($_SESSION['messenger_send']) && !empty($_SESSION['messenger_send'])) : ?>
                            <div class="alert alert-success container w-50 text-center shadow" id="myDiv" role="alert">
                                <?= $_SESSION['messenger_send'] ?>
                            </div>
                            <?php
                            $_SESSION['messenger_send'] = null;
                            endif; 
                            
                             //*============================================
                            ?>
                            <?php   if (!empty($_SESSION) && isset($_SESSION['messenger_not_send']) && !empty($_SESSION['messenger_not_send'])) : ?>
                            <div class="alert alert-danger container w-50 text-center shadow" id="myDiv" role="alert">
                                <?= $_SESSION['messenger_not_send'] ?>
                            </div>
                            <?php
            $_SESSION['messenger_not_send'] = null;
            endif; 
            
             //*============================================
            ?>

                            <div class="text-start container text-center mt-5 mr-0 w-75">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>User Name :
                                        </strong><?= $data->user->username ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email : </strong><?= $data->user->email ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Salary : </strong><?= $data->user->salary ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Created on :</strong><?= $data->user->created_at?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Updated on: </strong><?= $data->user->updated_at?>
                                    </li>
                                </ul>
                                <br>
                                <div class="d-flex justify-content-center gap-2 ">
                                    <a href="/users/edit?id=<?= $data->user->id ?>" class="btn btn-warning mr-5"><i
                                            class="fas fa-edit shadow"></i></a>
                                    <button type="button" class="btn btn-danger shadow" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        <i class="far fa-trash-alt"></i>

                                        <button type="button" class="btn btn-success shadow" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdro">
                                            <i class="fa-solid fa-comments"></i>
                                        </button>
                                </div>
                            </div>
                            </button>






                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                                            <i class="fas fa-exclamation-triangle text-warning mr-2 "></i>
                                            Attention
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete this user?
                                            <br><br>
                                            <span class="text-danger"> The user can not access to the system.</span>
                                        </div>
                                        <div class="modal-footer text-center container">
                                            <button type="button" class="btn btn-secondary "
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="/users/delete?id=<?= $data->user->id ?>"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="modal fade" id="staticBackdro" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                                            <i class="fas fa-exclamation-triangle text-warning mr-2 "></i>
                                            Send a massage
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="POST" action="/user/messenger">

                                                <input type="number" hidden class="form-control" id="recipient-name"
                                                    name="id" value="<?= $data->user->id ?>">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Message:</label>
                                                    <textarea class="form-control" id="message-text"
                                                        name="Message"></textarea>
                                                </div>

                                        </div>
                                        <div class="modal-footer text-center container">
                                            <button type="button" class="btn btn-secondary "
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success ">send</button>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>