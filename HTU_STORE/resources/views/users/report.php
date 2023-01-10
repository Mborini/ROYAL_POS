<br><br>
<div class="container d-flex text-center justify-content-center  mt-2 mb-3">
    <h1 class="text-primary">Report Of All Users</h1>
</div>
<div class="d-flex justify-content-center   mb-3">
    <button class="btn btn-primary" id="myprint"><i class="fa-solid fa-print Flash"></i></button>
</div>


<div class="d-flex  container justify-content-center md-3 col-xs-12 ">
    <table class="table table-striped frf text-center  ">


        <thead class="table-primary">
            <tr class="">
                <th scope="col">user id</th>
                <th scope="col">user name</th>
                <th scope="col">display Name</th>
                <th scope="col">email</th>
                <th scope="col">role</th>
                <th scope="col">salary</th>
                <th scope="col">last login</th>
                <th scope="col">lastlogout</th>
                <th scope="col">created at</th>
                <th scope="col">update at</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center bolder">
                <?php foreach ($data->users as $user) : ?>
                <td><?= $user->id ?></td>
                <th><?= $user->username ?></th>
                <td><?= $user->display_name ?></td>
                <td><?= $user->email?> </td>
                <td><?= $user->role ?></td>
                <td><?= $user->salary ?></td>
                <td><?= $user->last_login ?></td>
                <td><?= $user->last_logout ?></td>
                <td><?= $user->created_at ?></td>
                <td><?= $user->updated_at ?></td>
            </tr>
            <?php endforeach; ;?>

        </tbody>
    </table>
</div>