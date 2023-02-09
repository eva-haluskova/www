<?php

?>
<?php
$layout = 'auth';
/** @var Array $data */
?>
<div class="container odsatenie-dole-registracia">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5 family-color">
                <div class="card-body">
                    <h5 class="card-title text-center">Registrácia</h5>
                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>
                    <form class="form-signin" method="post" action="?c=auth&a=store">

                        <h6 class="mb-0">Prihlasovacie meno:</h6>
                        <div class="form-label-group mb-3 odsadenie-1">
                            <input name="login" type="text" id="login" class="form-control" placeholder="Login" required autofocus value ="<?php if ($data != null) {
                                echo $data['login'];
                            }?>">
                        </div>

                        <h6 class="mb-0">Email:</h6>
                        <div class="form-label-group mb-3 odsadenie-1">
                            <input name="email" type="email" id="email" class="form-control"
                                   placeholder="Email" required value ="<?php if ($data != null) {
                                echo $data['email'];
                            }?>">
                        </div>

                        <h6 class="mb-0">Heslo:</h6>
                        <div class="form-label-group mb-3 odsadenie-1">
                            <input name="password_one" type="password" id="password_one" class="form-control"
                                   placeholder="Password" required>
                        </div>

                        <h6 class="mb-0">Zopakuj heslo:</h6>
                        <div class="form-label-group mb-3 odsadenie-1">
                            <input name="password_two" type="password" id="password_two" class="form-control"
                                   placeholder="Repead password" required>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary color-create border-salala" type="submit" name="submit">Zaregistrovať sa
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>