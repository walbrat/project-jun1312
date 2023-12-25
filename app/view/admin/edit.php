
<form action="<?=$url?>" method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="title" id="title" value="<?= $data[0]['title'] ?? ''?>"/>
        <label for="content">Content</label>
        <input type="text" name="content" placeholder="content" id="content" value="<?= $data[0]['content'] ?? '' ?>"/>
        <label for="slug">Button name</label>
        <input type="text" name="btn_name" placeholder="button name" id="btn_name" value="<?= $data[0]['btn_name'] ?? '' ?>">
        <input type="submit" class="btn btn-primary" value="Edit"/>
        <input type="hidden" name="idPage" value="<?= $data['id'] ?? ''?>">
    </div>
</form>
