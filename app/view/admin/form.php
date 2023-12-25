
<form action="<?= $data['actionForForm'] ?>" method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="title" id="title" value="<?= $data['title'] ?? ''?>"/>
            <?php if(isset($data['errors']['title'])): ?>
                <div><?=$data['errors']['title'];?></div>
            <?php endif; ?>
        <label for="content">Content</label>
        <input type="text" name="content" placeholder="content" id="content" value="<?= $data['content'] ?? '' ?>"/>
            <?php if(isset($data['errors']['content'])): ?>
                <div><?=$data['errors']['content'];?></div>
            <?php endif; ?>
        <label for="btn_name">btn_name</label>
        <input type="text" name="btn_name" placeholder="btn_name" id="btn_name" value="<?= $data['btn_name'] ?? '' ?>">
            <?php if(isset($data['errors']['btn_name'])): ?>
                <div><?=$data['errors']['btn_name'];?></div>
            <?php endif; ?>
        <input type="submit" class="btn btn-primary" value="<?= $data['buttonText'] ?>"/>
        <input type="hidden" name="id" value="<?= $data['id'] ?? ''?>">
    </div>
</form>
