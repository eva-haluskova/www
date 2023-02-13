<?php
/** @var Array $data */
?>
<!-- registracia do aplikacie -->
<div class="container registration-bottom family-font">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body family-color">
                    <h4 class="card-title text-center">Registrácia</h4>
                    <!-- vypis chybovej spravy v pripade zlych vstupov -->
                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>

                    <form class="form-signin" method="post" action="?c=auth&a=store">

                        <h5 class="mb-0">Prihlasovacie meno:</h5>
                        <p><span id="txtLogin"></span></p>
                        <div class="form-label-group mb-3 space-forms ">
                            <input name="login" type="text" id="login" class="form-control" placeholder="Login" onKeyUp="checkLogin(this.value)" required autofocus
                                   minlength="4" maxlength="30" value ="<?php if ($data != null) { echo $data['login']; }?>">
                        </div>

                        <h5 class="mb-0">Email:</h5>
                        <div class="form-label-group mb-3 space-forms ">
                            <input name="email" type="email" id="email" class="form-control"
                                   placeholder="Email" required minlength="5" maxlength="40" value ="<?php if ($data != null) { echo $data['email']; }?>">
                        </div>

                        <h5 class="mb-0">Heslo:</h5>
                        <div class="form-label-group mb-3 space-forms ">
                            <input name="password_one" type="password" id="password_one" minlength="8" maxlength="255" class="form-control"
                                   placeholder="Password" required>
                        </div>

                        <h5 class="mb-0">Zopakuj heslo:</h5>
                        <div class="form-label-group mb-3 space-forms ">
                            <input name="password_two" type="password" id="password_two" minlength="8" maxlength="255" class="form-control"
                                   placeholder="Repead password" required>
                        </div>

                        <div class="text-center">
                            <button class="btn color-create my-button my-border" type="submit" name="submit">Zaregistrovať sa
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>