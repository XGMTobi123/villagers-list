<h1>Delete a record</h1>
<?php

use app\core\Model;

echo $form->field($model, 'id') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>