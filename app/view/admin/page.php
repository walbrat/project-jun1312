<?php

use core\Router;
?>

<h2>Pages</h2>
<table>
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Content</th>
        <th>url address</th>
    </tr>
<tr>
    <td><?php foreach ($pages as $key => $page): ?></td>
    <td><?= $page['id']; ?></td>
    <td><?= $page['title']; ?></td>
    <td><?= $page['content']; ?></td>
    <td><?= $page['slug']; ?></td>
    <td>
        <a href="<?= Router::getUrl('page', 'getform', true) . '?idPage=' . $page['id']?>">Edit</a>
        <a href="<?= Router::getUrl('page', 'destroy', true) . '?idPage=' . $page['id']?>">Delete</a>
        
    </td>
</tr>
    <?php endforeach; ?>
</table>
<a href="<?= Router::getUrl('page', 'create') . '&idPage=' . $page['id']?>">Create</a>