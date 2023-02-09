<div class="content-margin-bottom-create">
<div class="container form-field background-color-form">
<form  method="post" name="myForm" onsubmit="return validateForm()" action="?c=recipes&a=store" enctype="multipart/form-data">
   <div class="moje-zarovnanie">

    <?php /** @var Array $data */

       if($data['recept'] != null) { ?>
        <div>
            <h1 class = "moje-zarovnanie">
                Uprav recept
            </h1>
        </div>
        <input type="hidden" name="id" value="<?php echo $data['recept']->getId() ?>">
    <?php } else { ?>
        <div>
            <h1 class = "moje-zarovnanie">
                Vytvor nový recept
            </h1>
        </div>
    <?php } ?>

   <div class="text-center text-danger mb-3">
       <?= @$data['message'] ?>
   </div>


    <div class="mb-3" >
        <label class="col-form-label">Názov receptu:</label>
        <div class="input-group">

            <input type="text" class="form-control" minlength="3" maxlength="65" id = "title" placeholder="vlož názov receptu" name="title"
                   value="<?php if($data['recept'] != null) { echo $data['recept']->getTitle(); } ?>" >
        </div>
    </div>
    <div class="mb-3">

        <label class="col-form-label">Ingrediencie:</label>
        <div class="input-group">
            <input type="text" class="form-control" minlength="5" maxlength="500" id = "ingredient" placeholder="vlož ingrediencie oddelené čiarkov" name="ingredient"
                   value="<?php if($data['recept'] != null) { echo $data['recept']->getIngredient(); } ?>" >
        </div>
    </div>
    <div class="mb-3">
        <label for="comment" class="col-form-label">Postup:</label>
        <div class="input-group">
            <textarea class="form-control"  rows="5" minlength="5" maxlength="2000" placeholder="vlož postup" id="comment"
                      name="process" ><?php if($data['recept'] != null) { echo $data['recept']->getProcess(); } ?></textarea>
        </div>
    </div>

    <div>
        <label class="col-form-label">Kategória:</label>
        <div class="input-group">
            <select class="form-select form-control select-form-height" name="typ">
                <?php  if($data['recept'] != null) { ?>
                <option><?php echo $data['recept']->getNameOfType() ?></option>
                <?php foreach ($data['categiries'] as $catogory) {
                   if($catogory->getId() != $data['recept']->getCategory()) { ?>
                <option><?php echo $catogory->getName() ?></option>
                <?php }}} else {
                    foreach ($data['categiries'] as $catogory) { ?>
                        <option><?php echo $catogory->getName() ?></option>
                    <?php }
                } ?>
            </select>
        </div>
    </div>

       <?php  if($data['recept'] == null) { ?>
       <div>
           <label class="col-form-label">Vyber obrázok z počítača:</label>
           <input type="file" name="image" accept="image/jpeg image/png image/jpg" id="image" value="<?php if($data['recept'] != null) { echo $data['recept']->getImage(); } ?>">
       </div>
       <?php } ?>
        <button type="submit" class="btn my-button color-create odsadenie">Odoslať</button>
       <p id="demo"></p>
    </div>


</form>
</div>
</div>