<?php
$layout = 'auth';
/** @var Array $data */
?>
<div class="container odsatenie-dole-registracia">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5 family-color">
                <div class="card-body">
                    <h5 class="card-title text-center">Prihlásenie</h5>
                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>
                    <form class="form-signin" method="post" action="<?= \App\Config\Configuration::LOGIN_URL ?>">
                        <div class="form-label-group mb-3">
                            <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                                   required autofocus>
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Password" required>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary color-create border-salala" type="submit" name="submit">Prihlásiť
                            </button>
                        </div>
                        <div class="text-center mt-3">
                            <p>Ešte nie si zaregistrovaný?
                                <a class="a-login-two" href="?c=auth&a=registration">Tu sa zaregistruj.</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
