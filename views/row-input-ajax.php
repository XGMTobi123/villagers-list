<?php
/* @var $data array
 */
?>
<div id = 'tr_<?=$data['id']?>' class='d-tr'>
    <div id="id_<?= $data['id'] ?>" class='d-td'><?= $data['id'] ?></div>
    <div id="name_<?= $data['id'] ?>" class='d-td'><input id="iname_<?= $data['id'] ?>" = type ='text' name='name' value='<?= $data['name'] ?>'>
    </div>
    <div id="age_<?= $data['id'] ?>" class='d-td'><input id="iage_<?= $data['id'] ?>" type ='number' name='age' value='<?= $data['age'] ?>'>
    </div>
    <div id="cid_<?= $data['id'] ?>" class='d-td'><select id="icid_<?= $data['id'] ?>" input type="cid" name="cid">
            <?php
            $cities = \app\models\Cities::getCities();
            foreach ($cities as $key => $value) { ?>
                <option value="<?= $key ?>"<?php if($key == $data['cid']){echo 'selected';}?>><?= $value?></option>
            <?php } ?>
        </select></div>
    <div id="save_<?= $data['id'] ?>" class="d-td"><a class="js-save-row" href="#" data-id="<?= $data['id'] ?>">Save</a>
    </div>
    <div class='d-td'><a class="js-delete-row" href="#" data-id="<?= $data['id'] ?>">Delete</a></div>
</div>
