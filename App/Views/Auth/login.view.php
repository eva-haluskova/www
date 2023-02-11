<?php
/** @var Array $data */
?>
<!-- prihlasovanie do aplikacie -->
<div class="container registration-bottom family-font">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto ">
            <div class="card card-signin my-5">
                <div class="card-body family-color">

                    <h4 class="card-title text-center">Prihlásenie</h4>

                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>

                    <form class="form-signin" method="post" action="<?= \App\Config\Configuration::LOGIN_URL ?>">
                        <div class="form-label-group mb-3 space-forms ">
                            <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                                   required autofocus>
                        </div>

                        <div class="form-label-group mb-3 space-forms ">
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Password" required>
                        </div>
                        <div class="text-center">
                            <button class="btn my-button-color-1 my-button my-border" type="submit" name="submit">Prihlásiť
                            </button>
                        </div>
                        <div class="text-center mt-3">
                            <h5>Ešte nie si zaregistrovaný?
                                <a id="registrationLink" href="?c=auth&a=registration">Tu sa zaregistruj.</a>
                            </h5>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
