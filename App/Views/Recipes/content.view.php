<?php /** @var \App\Models\Recipe $data */ ?>

<div class="wrapper wrapper-me">
     <div class = "title-recipe">
         <h1 class = "moje-zarovnanie">
             <?php echo $data->getTitle() ?></h1>
     </div>


    <div class="flex-rule">

        <div class = "flex-rule-child flex-rule-child1">
            <h3> Ingrediencie</h3>
                <ul>
                    <?php
                    $ingrediencie = $data->getIngredient();
                    $ing_arr = explode(",", $ingrediencie);

                    foreach ($ing_arr as $value) {
                        echo "<li> $value </li>";
                    } ?>
                </ul>
        </div>


        <div class = "flex-rule-child flex-rule-child2">
            <h3>Postup</h3>
            <p>
                <?php echo $data->getProcess() ?>
            </p>
        </div>

    </div>
</div>