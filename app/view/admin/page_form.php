<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div class=" w3-padding-small w3-card-4 autch">
    <div class="w3-container w3-amber">
        <h2><?= $title ?? ''?></h2>
    </div>
<form action="<?= $data['actionForForm'] ?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="title" id="title" class="w3-input w3-border" value="<?= $data['title'] ?? ''?>"/>
        <div>
            <?php if(isset($data['errors']['title'])): ?>
                <p class="w3-panel w3-pale-red w3-leftbar w3-border w3-border-red"><?=$data['errors']['title'];?></p>
            <?php endif; ?>
        </div>
        <label for="summernote">Content</label>
        <textarea id="content" name="content"><?= $data['content'] ?? ''?></textarea>
        <div>
            <?php if(isset($data['errors']['content'])): ?>
                <p class="w3-panel w3-pale-red w3-leftbar w3-border w3-border-red"><?=$data['errors']['content'];?></p>
            <?php endif; ?>
        </div>
        <label for="btn_name">btn_name</label>
        <input type="text" name="btn_name" placeholder="btn_name" id="btn_name" class="w3-input w3-border" value="<?= $data['btn_name'] ?? '' ?>">
        <div>
            <?php if(isset($data['errors']['btn_name'])): ?>
                <p class="w3-panel w3-pale-red w3-leftbar w3-border w3-border-red"><?=$data['errors']['btn_name'];?></p>
            <?php endif; ?>
        </div>
        <input type="hidden" name="id" value="<?= $data['id'] ?? ''?>">
        <p>
            <input type="submit" class="btn btn-primary w3-margin-top" value="<?= $data['buttonText'] ?>"/>
        </p>


    </div>
</form>
</div>
<script>
    $(document).ready(function() {
        $('#content').summernote();
    });
</script>