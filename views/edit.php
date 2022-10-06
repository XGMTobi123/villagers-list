<h1>Edit a record</h1>
<?php
/* @var $cities array
 * @var $model \app\models\Villager
 *
 *
 */

$form = \app\core\form\Form::begin('', "post") ?>
<input type="hidden" value="<?=$model->id?>" name="id">
<?php
//TODO make $form->field hidden
?>

<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'age') ?>
<?php //echo $form->field($model, 'cid') ?>
<!--<div class="form-group">-->
<!--    <label>%s</label>-->
<!--    <input type="%s" name="%s" value = "%s" class="form-control %s">-->
<!--    <div class="invalid-feedback">-->
<!--        %s-->
<!--    </div>-->
<!--</div>-->
<div class="form-group">
    <label>cid</label>
    <select inputtype = "cid" name="cid" value='cid' class="form-control cid">
        <?php
        foreach ($cities as $key => $value){?>
            <option value = "<?=$key?>"<?php if($key == $model->cid){echo 'selected';}?>><?=$value?></option>
        <?php } ?>
    </select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>