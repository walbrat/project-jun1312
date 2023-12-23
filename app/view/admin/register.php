<?php
var_dump($_SESSION);
?>

<div class="w3-container">
    <div class="w3-card-4 autch">
        <div class="w3-container w3-amber">
            <h2>Register root user now</h2>
        </div>
        <form name="registration_form" class="w3-container" action="checkRegister" method="post">
            <p>
                <label>Login</label>
                <input name="login" type="text" value="<?= $login ?>" class="w3-input w3-border">
                <?php if (isset($errors['name'])) : ?>
            <p class="w3-panel w3-pale-red w3-leftbar w3-border w3-border-red"><?= $errors['login'] ?></p>
            <?php endif; ?>
            </p>
            <p>
                <label>E-mail</label>
                <input name="email" type="text" value="<?= $email ?>" class="w3-input w3-border">
                <?php if (isset($errors['email'])) : ?>
            <p class="w3-panel w3-pale-red w3-leftbar w3-border w3-border-red"><?= $errors['email'] ?></p>
        <?php endif; ?>
            </p>
            <p>
                <label>Password</label>
                <input name="password" type="password" class="w3-input w3-border">
                <?php if (isset($errors['password'])) : ?>
            <p class="w3-panel w3-pale-red w3-leftbar w3-border w3-border-red"><?= $errors['password'] ?></p>
        <?php endif; ?>
            </p>
            <p>
                <label>Confirm password</label>
                <input name="password_confirm" type="password" class="w3-input w3-border">
                <?php if (isset($errors['pass_confirm'])) : ?>
            <p class="w3-panel w3-pale-red w3-leftbar w3-border w3-border-red"><?= $errors['password_confirm'] ?></p>
        <?php endif; ?>
            </p>
            <p>
                <input type="submit" value="Register" class="w3-btn w3-green">
                <a href="/" class="w3-btn w3-green w3-right">Cancel</a>
            </p>
        </form>
    </div>
</div>
