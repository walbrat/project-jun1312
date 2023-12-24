<?php

?>
<form action="<?=$url?>" method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="title" id="title" value="<?= $data[0]['title'] ?? ''?>"/>
        <label for="content">Content</label>
        <input type="text" name="content" placeholder="content" id="content" value="<?= $data[0]['content'] ?? '' ?>"/>
        <label for="slug">Slug</label>
        <input type="text" name="slug" placeholder="slug" id="slug" value="<?= $data[0]['btn_name'] ?? '' ?>">
        <input type="submit" class="btn btn-primary" value="Edit"/>
        <input type="hidden" name="idPage" value="<?= $data['id'] ?? ''?>">


    </div>
</form>
