<!DOCTYPE html>
<html lang="en">
<?php include_once 'head.php' ?>

<body>
    <div class="card">
        <h2 class="card-heading">
            Sign in
        </h2>
        <?php if ($errorMsg) : ?>
            <div class="error-msg"><?php echo $errorMsg ?></div>
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
            <label class="form-checked__label" style="display: inline-block; margin-top: 20px">
                <input type="checkbox" class="form-checked__input" name="remember" value="true" />
                Remember me
            </label>
            <div class="action">
                <input type="submit" value="Sign in" class="action-button" />
            </div>
        </form>
    </div>
</body>

</html>