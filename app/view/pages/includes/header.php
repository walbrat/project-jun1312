<div class="w3-bar w3-black">
    <?php foreach ($menuBtns as $button){?>
        <a class="w3-bar-item w3-button" href="<?php echo $button['url']; ?>"class="header_name" > <?php echo $button['btn_name']?></a>
    <?php }?>
</div>