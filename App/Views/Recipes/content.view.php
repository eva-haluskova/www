<?php /** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<div class="content-margin-bottom">
    <?php if (isset($_GET['e'])) { ?>
        <h1>Chyba recept :)</h1>
   <?php } else { ?>
<div class="wrapper wrapper-me">
     <div class = "title-recipe">
         <h1 class = "moje-zarovnanie">
             <?php echo $data['recept']->getTitle() ?></h1>
     </div>

    <div class="flex-rule">

        <div class = "flex-rule-child flex-rule-child1">
            <h3> Ingrediencie</h3>
                <ul>
                    <?php
                    $ingrediencie = $data['recept']->getIngredient();
                    $ing_arr = explode(",", $ingrediencie);

                    foreach ($ing_arr as $value) {
                        echo "<li> $value </li>";
                    } ?>
                </ul>
        </div>

        <div class = "flex-rule-child flex-rule-child2">
            <h3>Postup</h3>
            <p>
                <?php echo $data['recept']->getProcess() ?>
            </p>
        </div>

        <div>
            <img class="flex-rule-child picture-image" src="public/images/<?php echo $data['recept']->getImage() ?>" alt="Image of cake">
        </div>

    </div>
</div>
</div>


<!-- comment section -->

<div class="comment-dov">
<section class="comments-section">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card  text-dark">

                    <div class="card-body p-4">
                        <h4 class="mb-0">Komentáre</h4>
                    </div>

                    <hr class="my-0" />

                    <?php foreach ($data['comments'] as $comment) {
                    if ($comment->getRecipe() == $data['recept']->getId()) { ?>
<!--                            toto divko sa maze spolu so vsetkym v nom-->
                        <div class="card-body p-4" id="com-<?=$comment->getId() ?>" >
                            <div class="d-flex flex-start">
                                <div>
                                    <!-- autor receptu -->
                                    <h6 class="fw-bold mb-1">
                                        <i><?php echo $comment->getUserName(); ?></i>
                                    </h6>


                                    <div class="flex-rule">

                                        <!-- text komentara-->
                                        <p class="mb-0 flex-rule-child commeten-area flex-rule-child4">
                                            <?= $comment->getText() ?>
                                        </p>

                                        <!--ak je pouzivatel prihlaseny a je autorom komentara, tak sa mu zobrazi tlacidlo na zmazanie a upravu komentara-->
                                        <div class="d-flex align-items-center mb-3  flex-rule-child flex-rule-child3 ">
                                            <?php if ($auth->isLogged() && $comment->getAuthor() == $auth->getLoggedUserId()) { ?>
                                                <button class="btn my-button color-create odsadenie" type="submit" onclick="deleteComment(<?=$comment->getId() ?>)">Vymaz</button>
                                                <button class="btn my-button color-create odsadenie" type="submit" onclick="editC(<?=$comment->getId() ?>)">Uprav</button>
                                            <?php } ?>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                    <?php }} ?>


                    <!-- Ak je pouzivatel prihlaseny, tak sa mu zobrazi formular na pridanie komentara -->
                    <?php if ($auth->isLogged()) { ?>
                        <div class="card-body p-4">
                            <div class="d-flex flex-start">
                                <div>
                                    <h6 class="fw-bold mb-1">
                                        <i>
                                  <?= $auth->getLoggedUserName()?>
                                        </i>
                                    </h6>

                                    <form  method="post" name="myForm" action="?c=comments&a=store&id=<?=$data['recept']->getId() ?>">
<!--                                        TODO osetrit ak nebudu data receptu aby sa nezobrazil hidden-->
                                        <input type="hidden" name="comment-id">
                                        <div class="flex-rule">
                                            <textarea class="form-control flex-rule-child commeten-area" rows="1" cols="85" placeholder="Pridaj komentar..." id="comment" name="text" ></textarea>
                                            <button class="btn my-button color-create odsadenie flex-rule-child" type="submit" id="button-addon2">Pridaj</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                    <?php } ?>

                </div>
            </div>
         </div>
    </div>
</section>
    <?php } ?>
</div>