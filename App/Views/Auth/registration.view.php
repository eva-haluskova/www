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





<!--
<section class="vh-80">
  <div class="container h-80">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-9">

        <h1 class="text-white mb-4">Registrácia</h1>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body">

            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Prihlasovacie meno:</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input type="text" class="form-control form-control-lg" />

              </div>
            </div>

            <hr class="mx-n3">

            <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Email:</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input type="email" class="form-control form-control-lg" placeholder="example@example.com" />

              </div>
            </div>

            <hr class="mx-n3">

            <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Heslo:</h6>

              </div>
              <div class="col-md-9 pe-5">

                <textarea class="form-control" rows="3" placeholder="Message sent to the employer"></textarea>

              </div>
            </div>

            <hr class="mx-n3">

            <hr class="mx-n3">

            <div class="px-5 py-4">
              <button type="submit" class="btn btn-primary btn-lg">Pošli údaje</button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</section>
-->