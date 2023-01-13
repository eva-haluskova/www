<?php /** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<div class="content-margin-bottom">
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

<section style="background-color: #ad655f;">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card text-dark">
                    <div class="card-body p-4">
                        <h4 class="mb-0">Komentáre</h4>
                    </div>

                    <hr class="my-0" />

                    <?php foreach ($data['comments'] as $comment) {
                    if ($comment->getRecipe() == $data['recept']->getId()) { ?>
                        <div class="card-body p-4">
                            <div class="d-flex flex-start">
                                <div>
                                    <h6 class="fw-bold mb-1">
                                        <?php foreach ($data['users'] as $user) {
                                            if ($user->getId() == $comment->getAuthor()) {
                                                echo $user->getLogin();
                                            }
                                        } ?>
                                    </h6>
                                    <div class="d-flex align-items-center mb-3">
<!--                                        <p class="mb-0">-->
<!--                                            March 15, 2021-->
<!--                                        </p>-->
                                    </div>
                                    <p class="mb-0">
                                        <?= $comment->getText() ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                    <?php }} ?>


                </div>
            </div>
        </div>

        <?php if ($auth->isLogged()) { ?>
            <div class="d-flex justify-content-center">
                <a href="?c=comments&a=create" class="btn my-button my-color">Pridať komentár</a>
            </div>
        <?php } ?>

    </div>
</section>
