<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="/public/css/style.css">
        <title><?php echo SITE_NAME; ?></title>
    </head>
    <body>
    <div class="w3-container">
        <header class="w3-container w3-teal">
            <img class="logo" src="/images/logo.svg" alt="">
            <h1><?php echo $title; ?></h1>
        </header>
        <?php include_once ADMIN_PAGES_FOLDER . $page . '.php'; ?>
        <?php include_once PAGES_FOLDER . 'includes\footer.php'; ?>
    </div>
    </body>
</html>
