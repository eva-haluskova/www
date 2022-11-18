
<div class="container form-field">
<form  method="post"  action="?c=recipes&a=store">
   <div class="moje-zarovnanie">

    <?php /** @var \App\Models\Recipe $data */
    if ($data->getId()) { ?>
        <div>
            <h1 class = "moje-zarovnanie">
                Uprav recept
            </h1>
        </div>
        <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
    <?php } else { ?>
        <div>
            <h1 class = "moje-zarovnanie">
                Vytvor nový recept
            </h1>
        </div>
    <?php } ?>


    <div class="mb-3" >
        <label class="col-form-label">Názov receptu:</label>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?php echo $data->getTitle() ?>">
        </div>
    </div>
    <div class="mb-3">

        <label class="col-form-label">Ingrediencie:</label>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter ingredient" name="ingredient" value="<?php echo $data->getIngredient() ?>">
        </div>
    </div>
    <div class="mb-3">
        <label for="comment" class="col-form-label">Postup:</label>
        <div class="input-group">
  <!--          <input type="text"  class="form-control" rows="5" placeholder="Enter process" name="process" value="<?php echo $data->getProcess() ?>"> -->
            <textarea class="form-control" rows="5" id="comment" name="process">
                <?php echo $data->getProcess() ?>
            </textarea>
        </div>
    </div>

    <div>
        <label class="col-form-label">Druh:</label>
        <div class="input-group">
            <select class="form-select form-control" name="type" value="<?php echo $data->getType() ?>">
                <option>Zákusok</option>
                <option>Torta</option>
                <option>Múčnik</option>
                <option>Kysnutý koláč</option>
                <option>Iné</option>
            </select>
        </div>
    </div>

       <div>
           <label for="avatar">Choose a profile picture:</label>
           <input type="file" id="avatar" accept="image/png, image/jpeg" name="image" value="<?php echo $data->getImage() ?>">>
       </div>

        <button type="submit" class="btn my-button my-color odsadenie">Odoslať</button>
    </div>

</form>
</div>

