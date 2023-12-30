<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title><?php echo SITE_NAME; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
</head>
<body>
<!-- Sidebar -->
<?php include_once ADMIN_PAGES_FOLDER . 'includes/header.php'; ?>
<!-- Page Content -->
<div style="margin-left:15%">
    <div class="w3-container w3-teal">
        <h1>Dashboard</h1>
        <?php if (!empty($data['login'])): ?>
            <div><?= $data['login']; ?></div>
        <?php endif; ?>
    </div>
    <div class="w3-container">
        <?php include_once ADMIN_PAGES_FOLDER . $page . '.php'; ?>
    </div>
    <?php include_once ADMIN_PAGES_FOLDER . 'includes/footer.php'; ?>
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</div>
</body>
</html>