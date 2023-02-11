<?php /** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<!-- RECEPT -->
<div class="content-margin-bottom family-font">
    <!-- kontrola ci nie je chyba, teda zadane id receptu neexistuje-->
    <?php if (isset($_GET['e'])) { ?>
            <div class="container-2 flex-rule-child" id="errorRecipe">
                <h1 id="chyba" >Page not fount</h1>
                <img src="public/images/sad-cloud.png">
            </div>
   <?php } else { ?>
<div class="wrapper wrapper-me">
    <!-- nazov receptu -->
     <div class = "title-recipe">
         <h1 class = "align-forms">
             <?php echo $data['recept']->getTitle() ?></h1>
     </div>

    <div class="flex-rule">
        <!-- ingrediencie -->
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

        <!-- postup -->
        <div class = "flex-rule-child flex-rule-child2">
            <h3>Postup</h3>
            <ol>
                <?php
                $process = $data['recept']->getProcess();
                $pro_arr = preg_split('/[0-9]+\./', $process);
                array_shift($pro_arr);

                foreach ($pro_arr as $value) {
                    echo "<li> $value </li>";
                } ?>
            </ol>

        </div>

        <!-- obrazok -->
        <div>
            <img class="flex-rule-child image-recipe" src="public/images/<?php echo $data['recept']->getImage() ?>" alt="Image of cake">
        </div>

    </div>
</div>
</div>


<!-- KOMENTARE -->
<!-- TODO osetrenie vsupov klient + server -->
<!-- TODO mazanie komentaroc ajax -->

<div class="comment-div">
<section class="comments-section">

    <div class="container  my-3  pt-3 pb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10">

                <!-- cast s komentarmi-->
                <div class="card text-dark">

                    <!--hlavicka-->
                    <div class="card-body p-4">
                        <h4 class="mb-0 family-font">Komentáre</h4>
                    </div>

                    <hr/>

                    <!-- content -->
                    <?php foreach ($data['comments'] as $comment) { ?>
                    <div class="card-body p-4" id="com-<?=$comment->getId() ?>">
                    <div class="d-flex flex-start">
                        <div>
                            <!-- autor -->
                            <h6 class="fw-bold mb-1">
                                <i>
                                    <?= $comment->getUserName() ?>
                                </i>
                            </h6>


                            <?php if ($auth->isLogged() && $comment->getAuthor() == $auth->getLoggedUserId()) { ?>
                                <div id="commentEdit-<?=$comment->getId() ?>" class="flex-rule">
                                    <p class=" flex-rule-child flex-rule-child4 commeten-area " ><?php echo $comment->getText() ?></p>
                                        <button class="btn my-button my-button-color-1  my-margin my-border" type="submit" onclick="editComment(<?=$comment->getId() ?>)">Upraviť</button>
                                        <button class="btn my-button my-button-color-2 my-margin my-border" type="submit" onclick="deleteComment(<?=$comment->getId() ?>)">Vymazať</button>

                                </div>

                            <?php } else { ?>
                                <p class="mb-0 flex-rule-child commeten-area flex-rule-child3">

                                    <?= $comment->getText() ?>
                                </p>
                            <?php } ?>


                        </div>
                    </div>
                </div>
                <hr/>
                <?php } ?>

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
                                        <button class="btn my-button color-create my-margin flex-rule-child my-border" type="submit" id="button-addon2">Pridať</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>

            </div>
         </div>
    </div>



</section> <!--koniec sekcie komentarov-->
    <?php } ?>
</div>