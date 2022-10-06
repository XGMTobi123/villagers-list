<?php
/* @var $name string
 * @var $result array
 */
session_start();
?>
<h1>Home</h1>
<?php if (isset($_SESSION['deleted'])) { ?>
    <h3><?php echo $_SESSION['deleted'] ?></h3>
    <?php unset($_SESSION['deleted']) ?>
<?php } ?>
<h3>Welcome <?php echo $name ?></h3>
<form id="search" action="search" method="get">
    <div class="d-table">
        <div class="d-tr">
            <div class='d-th'>Id</div>
            <div class='d-th'>Name</div>
            <div class='d-th'>Age</div>
            <div class='d-th'>City</div>
            <div class='d-th'>Edit</div>
            <div class='d-th'>Delete</div>
        </div>
        <div class="d-tr">
            <div class="d-th">#</div>
            <div class="d-th">
                <input type="text" name="name" value="">
            </div>
            <div class="d-th">
                <input type="number" name="age" value="">
            </div>
            <div class="d-th"><select id="cities" input type="cid" name="cid">
                    <option value="0" selected>City</option>
                    <?php
                    $cities = \app\models\Cities::getCities();
                    foreach ($cities as $key => $value) { ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                    <?php } ?>
                </select></div>
            <div class="d-th">#</div>
            <div class="d-th">#</div>
            <input type="submit" hidden>
        </form>
</div>
<?php
foreach ($result as $c => $value) {
    ?>
    <div id = 'tr_<?=$value['id']?>' class='d-tr'>
        <div id = "id_<?=$value['id']?>" class='d-td'><?= $value['id'] ?></div>
        <div id = "name_<?=$value['id']?>" class='d-td'><?= $value['name'] ?></div>
        <div id = "age_<?=$value['id']?>" class='d-td'><?= $value['age'] ?></div>
        <div id = "cid_<?=$value['id']?>" class='d-td'><?= $value['cid'] ?></div>
<!--        <div class='d-td'><a href="/edit?id=--><?//= $value['id'] ?><!--">Edit</a></div>-->
        <div id = "edit_<?=$value['id']?>" class="d-td"><a class="js-edit-row" href="#" data-id="<?=$value['id']?>">Edit</a></div>
        <div class='d-td'><a class="js-delete-row" href="#" data-id="<?= $value['id'] ?>">Delete</a></div>
    </div>
<?php } ?>
</div>
