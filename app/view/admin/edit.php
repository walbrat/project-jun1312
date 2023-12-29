<?php if (isset($_SESSION['error'])) : ?>
    <p class="w3-panel w3-pale-red w3-leftbar w3-border w3-border-red"><?= $_SESSION['error']?></p>
<?php endif; ?>
<div class="container">
<form action="<?=$url?>" method="post">
    <div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" placeholder="title" id="title" maxlength="<?=LENGTH_TITLE?>" value="<?= $data[0]['title'] ?? ''?>"/>
        </div>
        <div class="form-group">
            <label for="comment">Content:</label>
            <textarea class="form-control" rows="5" name="content" placeholder="content" id="editor1"><?=htmlspecialchars($data[0]['content']);?></textarea>
        </div>
        <div class="form-group">
            <label for="slug">Button name:</label>
            <input type="text" class="form-control" name="btn_name" placeholder="button name" id="btn_name" maxlength="<?=LENGTH_BTN_NAME?>" value="<?= $data[0]['btn_name'] ?? '' ?>">
        </div>
        <div class="form-group">
            <input type="hidden" name="idPage" value="<?= $data['id'] ?? ''?>">
        </div>
        <button type="submit" class="btn  btn-primary">Edit</button>
<!--            <input type="submit"  class="btn btn-primary" value=""/>-->

    </div>
</form>
</div>
