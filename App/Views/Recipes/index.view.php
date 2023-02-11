<?php
/** @var \App\Core\IAuthenticator $auth */
use App\Models\Recipe;
/** @var Recipe[] $data */
?>
<!-- view dostane zoznam receptov podla zadanej kategorie ktore nasledne vypise -->
<div class="content-margin-bottom-recipes">
<div class="container-fluid">
    <section>
        <div class="container">
            <div class="row">
        <?php foreach ($data as $recipe) { ?>
                    <div class="col-md-4 col-sm-6 col-xl-3 mt-4" id="rec-<?=$recipe->getId() ?>">
                        <div class="card profile-card-5">
                            <div class="card-img-block">
                                <img class="card-img-top" src="public/images/<?= $recipe->getImage() ?>" alt="picture">
                            </div>
                            <div class="card-body pt-0">
                                <a class="a-content" href = "?c=recipes&a=display&id=<?= $recipe->getId() ?>">
                                    <h5 class="card-title title-card">
                                        <?= $recipe->getTitle() ?>
                                    </h5>
                                </a>
                                <!-- ak je pouzivatel prihlaseny, ma moznost vymazat alebo upravit svoj recept -->
                                <?php if ($auth->isLogged() && $recipe->getAuthor() == $auth->getLoggedUserId()) { ?>
                                <div class="d-flex justify-content-center">
                                    <a href="?c=recipes&a=edit&id=<?= $recipe->getId() ?>" class="btn my-button my-button-color-1">Upraviť</a>
                                    <button class="btn my-button-color-2 my-button" type="submit" onclick="deleteRecipe(<?=$recipe->getId() ?>)">Zmazať</button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
        <?php } ?>
            </div>
        </div>
    </section>
</div>
</div>