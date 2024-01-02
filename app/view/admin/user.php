<h2><?= $title; ?></h2>
<table class="table table-success table-striped">
    <tr>
        <th>id</th>
        <th>Login</th>
        <th>E-mail</th>
        <th></th>
    </tr>

    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['login']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?php if (!empty($user['url_edit'])) {?><a class="btn btn-secondary" href="<?=$user['url_edit']; ?>">Edit</a><?php } ?>
            <?php if (!empty($user['url_destroy'])) {?><a class="btn btn-success" href="<?=$user['url_destroy']; ?>">Delete</a><?php } ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a class="btn btn-info" href=<?=$url_create?>>Create</a>