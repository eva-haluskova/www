<?php /** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<div class="content-margin-bottom-create">
    <div class="container form-field">
    <table class="table table-hover">
        <thead>
        <tr>
<!--            <th scope="col">id</th>-->
            <th scope="col">Názov</th>
<!--            <th scope="col">Aktuálny počet receptov</th>-->
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($data['types'] as $type) { ?>
        <div id="typ-<?=$type->getId() ?>">
            <tr>
<!--                <th scope="row">--><?php //echo $type->getId() ?><!--</th>-->
                <td colspan="2"><?php echo $type->getName() ?></td>
<!--                <td colspan="2"></td>-->
                <td colspan="2">
                    <a href="?c=types&a=delete&id=<?= $type->getId() ?>" class="btn my-button my-color">Zmaž</a>
<!--                    <button class="btn my-button-color my-button" type="submit" onclick="deleteType(--><?=$type->getId() ?><!--)">Zmazať</button>-->
                </td>
            </tr>
        </div>

        <?php } ?>
        </tbody>
    </table>

    <div class="text-center text-danger mb-3">
        <?= @$data['message'] ?>
    </div>

<!--        toto bude skryte divko, hahahahahaha-->
    <div id="addTypeForm">
        <form  method="post" name="myForm" action="?c=types&a=store">
            <input type="hidden" name="comment-id">
            <div class="flex-rule">
                <textarea class="form-control flex-rule-child commeten-area" rows="1" cols="85" placeholder="Pridaj kategoriu..." id="type" name="name" ></textarea>
                <button class="btn my-button color-create odsadenie flex-rule-child" type="submit" onclick="showAddTypeForm()" id="button-addon2">Pridaj</button>
            </div>
        </form>
    </div>
<!-- vyries to tak aby to bolo bud alebo...-->

    <div id="addType">
        <div class="row moje-zarovnanie my-button-create">
            <div class="col">
                <button class="btn my-button color-create odsadenie flex-rule-child" onclick="showAddTypeForm()">Pridaj kategoriu</button>
            </div>
        </div>
    </div>

    </div>
</div>