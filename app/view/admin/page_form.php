<form action="<?= $data['actionForForm'] ?>" method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="title" id="title" value="<?= $data['title'] ?? ''?>"/>
        <div>
            <?php if(isset($data['errors']['title'])): ?>
                <?=$data['errors']['title'];?>
            <?php endif; ?>
        </div>
        <label for="content">Content</label>
        <textarea type="text" name="content" placeholder="content" id="content"><?= $data['content'] ?? '' ?></textarea>
        <div>
            <?php if(isset($data['errors']['content'])): ?>
                <?=$data['errors']['content'];?>
            <?php endif; ?>
        </div>
        <label for="btn_name">btn_name</label>
        <input type="text" name="btn_name" placeholder="btn_name" id="btn_name" value="<?= $data['btn_name'] ?? '' ?>">
        <div>
            <?php if(isset($data['errors']['btn_name'])): ?>
                <?=$data['errors']['btn_name'];?>
            <?php endif; ?>
        </div>
        <input type="submit" class="btn btn-primary" value="<?= $data['buttonText'] ?>"/>
        <input type="hidden" name="id" value="<?= $data['id'] ?? ''?>">
    </div>
</form>