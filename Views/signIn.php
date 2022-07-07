<!DOCTYPE html>
<html lang="en">
<?php include_once 'head.php' ?>
<body>
<div class="card">
    <h2 class="card-heading">
        Sign in
    </h2>
    <?php if ($isAuth): ?>
        <div class="auth-message" style="background-color: #578a4288;"><?php echo $_POST['username'] ?></div>
    <?php endif; ?>
    <?php if (!$isAuth && !empty($_POST)): ?>
        <div class="auth-message" style="background-color: #8a424288;">Wrong login or password</div>
    <?php endif; ?>
    <form class="card-form" method="POST">
        <div class="input">
            <input type="text" class="input-field" name="username" value="" required />
            <label class="input-label">Username</label>
        </div>
        <div class="input">
            <input type="password" class="input-field" name="password" required value="" />
            <label class="input-label">Password</label>
        </div>
        <div class="action">
            <input type="submit" value="Sign in" class="action-button" />
        </div>
    </form>
</div>
</body>
</html>
