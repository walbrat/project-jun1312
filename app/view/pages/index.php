

<div class="w3-bar w3-black">
    <?php foreach ($content as $page){?>
    <a class="w3-bar-item w3-button" href="/index/index/<?php echo $page['id']; ?>"class="header_name" > <?php echo $page['title']?></a>
    <?php }?>
</div>
<?php echo $title;?>