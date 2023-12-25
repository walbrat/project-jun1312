<h1>Ceate page</h1>
<form action="<?=$url?>" method="post" name="create">
    <div>
    <label for="title">Title</label>
    <input type="text" name="title" placeholder="title" id="title" value="<?= $data['title'] ?? ''?>"/>
    <label for="content">Content</label>
    <input type="text" name="content" placeholder="content" id="content" value="<?= $data['content'] ?? '' ?>"/>
    <label for="btn_name">Button name</label>
    <input type="text" name="btn_name" placeholder="button name" id="btn_name" value="<?= $data['btn_name'] ?? '' ?>">
    <input type="submit" class="btn btn-primary" value="Create"/>
    </div>
</form>
