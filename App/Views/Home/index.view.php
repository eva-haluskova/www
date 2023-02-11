<?php
/** @var \App\Core\IAuthenticator $auth */
use App\Models\Recipe;
/** @var Recipe[] $data */

?>

<!-- VYHLADAVANIE -->
<div class="container">
    <div class="row  search-bar d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="search">
                <i class="fa fa-search"></i>
                <form  method="post" name="myForm" onsubmit="return validateForm()" action="?c=home&a=search" >
                <input type="text" class="form-control" name = "search"  maxlength="65" placeholder="Aký recept hľadáte?">
                <button class="btn  my-button-color-1 my-border">Hľadať</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- PRIDANIE NOVEHO RECEPTU -->
<!-- iba ak je pouzivatel prihlaseny -->
<?php if ($auth->isLogged()) { ?>
    <div class="row align-forms create-margin">
        <div class="col">
            <a href="?c=recipes&a=create" class="btn color-create my-button my-border">Pridať nový recept</a>
        </div>
    </div>
<?php } ?>

<!-- RECEPTY -->
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
                                            <a href="?c=recipes&a=edit&id=<?= $recipe->getId() ?>" class="btn my-button my-button-color-1 my-border">Upraviť</a>
                                            <button class="btn my-button-color-2 my-button my-border" type="submit" onclick="deleteRecipe(<?=$recipe->getId() ?>)">Zmazať</button>
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