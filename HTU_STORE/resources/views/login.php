<div class="login_background">
    <div class="login-wrapper">
        <form action="/authenticate" method="POST" class="form">
            <h2>Login</h2>
            <img style="  border: 2px;" id="qr" src="../../photos/download.png"
                style=" border-style: solid; border-radius: 50%; vertical-align: middle; height:50%; width:50%"
                alt="Avatar">
            <div class="input-group">
                <div class="mt-0">
                    <?php
                 //*MASSAGE ERROR
                if (!empty($_SESSION) && isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                    <div>
                        <span class="color_red "><i class="fas fa-exclamation ml-1"></i>
                            <?= $_SESSION['error'] ?></span>
                    </div>
                    <?php
                  $_SESSION['error'] = null;
                endif; ?>
                </div><br>
                <input type="text" name="username" id="loginUser" required>
                <label for="loginUser">User Name</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="loginPassword" required>
                <label for="loginPassword">Password</label>
            </div>
            <div>
                <input type="checkbox" href="#" id="checkbox-round " name="remember_me"><span id="span">Remember
                    me</span> </input>
                <input type="submit" value="Login" class="submit-btn">
            </div>
        </form>
    </div>
</div>