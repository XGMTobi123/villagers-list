<?php
/* @var $model Model
 *
 *
 */
?>
<h1>Create a record</h1>

<?php
//TODO Сделать норм
use app\core\Model;

//$model = new \app\models\Villager();
$form = \app\core\form\Form::begin('js-add-record', "post") ?>
<!--<a class="js-delete-row" href="#" data-id="--><?//= $value['id'] ?><!--">-->
<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'age')->numberField() ?>
<?php //echo $form->field($model, 'cid') ?>
<!--<div class="form-group">-->
<!--    <label>%s</label>-->
<!--    <input type="%s" name="%s" value = "%s" class="form-control %s">-->
<!--    <div class="invalid-feedback">-->
<!--        %s-->
<!--    </div>-->
<!--</div>-->
<div class="form-group">
    <label>City</label>
    <select name="cid" class="form-control cid">
        <?php
        foreach ($cities as $key => $value){?>
            <option value = "<?=$key?>"><?=$value?></option>
        <?php } ?>
    </select>
</div>

<?php $data = get_object_vars($model);
unset ($data['errors'], $data['id']);
?>
<a class = "js-add-record" href="#">Submit</a>
<!--<button type="submit" class="btn btn-primary">Submit</button>-->
<?php \app\core\form\Form::end() ?>

