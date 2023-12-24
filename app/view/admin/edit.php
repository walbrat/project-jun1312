
<form action="<?=\core\Router::getUrl('page', 'update', "id = 2") ?>" method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="title" id="title" value="<?= $data['title'] ?? ''?>"/>
        <label for="content">Content</label>
        <input type="text" name="content" placeholder="content" id="content" value="<?= $data['content'] ?? '' ?>"/>
        <label for="slug">Slug</label>
        <input type="text" name="slug" placeholder="slug" id="slug" value="<?= $data['btn_name'] ?? '' ?>">
        <input type="submit" class="btn btn-primary" value="Edit"/>
        <input type="hidden" name="idPage" value="<?= $data['id'] ?? ''?>">

    </div>
</form>
