<?php /** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<div class="content-margin-bottom-create">
    <div class="container form-field">
        <h2 class="align-forms ">
            Spravovanie kategórií
        </h2>


        <div class="space-types">
        <!-- PRIDAVANIE KATEGORII -->
        <div class="text-center text-danger mb-3">
            <?= @$data['message'] ?>
        </div>

        <!-- bud-->
        <div id="addTypeForm">
            <form  method="post" name="myForm" action="?c=types&a=store">
                <input type="hidden" name="comment-id">
                <div class="flex-rule">
                    <textarea class="form-control flex-rule-child commeten-area" rows="1" minlength="3" maxlength="30" placeholder="Pridaj kategoriu..." id="type" name="name" ></textarea>
                    <button class="btn my-button color-create my-margin flex-rule-child my-border" type="submit" onclick="showAddTypeForm()" id="button-addon2">Pridaj</button>
                </div>
            </form>
        </div>

        <!-- alebo -->
        <div id="addType">
            <div class="row align-forms">
                <div class="col">
                    <button class="btn my-button color-create my-margin flex-rule-child my-border" onclick="showAddTypeForm()">Pridaj kategoriu</button>
                </div>
            </div>
        </div>
        </div>


    <!-- KATEGORIE -->
    <table class="table table-hover family-font">
        <tbody>
        <?php foreach ($data['types'] as $type) { ?>
        <div id="typ-<?=$type->getId() ?>">
            <tr>
                <td><?php echo $type->getName() ?></td>
                <td>
                    <a href="?c=types&a=delete&id=<?= $type->getId() ?>" class="btn my-button my-button-color-2 my-border">Vymazať</a>
                </td>
            </tr>
        </div>

        <?php } ?>
        </tbody>
    </table>

    </div>
</div>