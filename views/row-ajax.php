<div id = 'tr_<?=$data['id']?>' class='d-tr'>
    <div id = "id_<?=$data['id']?>" class='d-td'><?= $data['id'] ?></div>
    <div id = "name_<?=$data['id']?>" class='d-td'><?= $data['name'] ?></div>
    <div id = "age_<?=$data['id']?>" class='d-td'><?= $data['age'] ?></div>
    <div id = "cid_<?=$data['id']?>" class='d-td'><?= $data['cid'] ?></div>
    <div id = "edit_<?=$data['id']?>" class="d-td"><a class="js-edit-row" href="#" data-id="<?=$data['id']?>">Edit</a></div>
    <div class='d-td'><a class="js-delete-row" href="#" data-id="<?= $data['id'] ?>">Delete</a></div>
</div>
