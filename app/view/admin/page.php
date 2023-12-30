<?php
session_start();
use core\Router;
?>

<h2>Pages</h2>
<!--<div class = "container">-->
    <table class="table table-success table-striped">
        <tr>
            <th>id</th>
            <th>Title</th>
            <th>url address</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($pages as $key => $page): ?>
            <tr>
                <td><?= $page['id']; ?></td>
                <td style="width: 70%"><?= $page['title']; ?></td>
                <td><?= $page['btn_name']; ?></td>
                <td>
                    <a class="btn btn-secondary" href="<?= Router::getUrl('page', 'getform',  'id=' . $page['id']) ?>">Edit</a>
                    <a class="btn btn-success" href="<?= Router::getUrl('page', 'destroy',  'id=' . $page['id']) ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<!--</div>-->

<a class="btn btn-info" href=<?= Router::getUrl('page', 'getform') ?>>Create</a>