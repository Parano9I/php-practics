<!DOCTYPE html>
<html lang="en">
<?php include_once 'head.php' ?>
<body>
    <div class="card">
        <h2 class="card-heading">
            Sign up
        </h2>
        <form class="card-form" name="signin" method="POST">
            <div class="input">
                <input name="username" type="text" class="input-field" value="<?php echo !empty($_POST['username']) ? $_POST['username'] : '' ?>" required />
                <label class="input-label">Username</label>
            </div>
            <div class="input">
                <input name="email" type="text" class="input-field" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : '' ?>" required />
                <label class="input-label">Email</label>
            </div>
            <div class="input">
                <input name="password" type="password" class="input-field" value="" required />
                <label class="input-label">Password</label>
            </div>
            <div class="action">
                <input type="submit" value="Sign up" class="action-button">
            </div>
        </form>
        <p class="signin-link">
            If already registered —
            <a href="/signin.php" class="signin-link__link">Sign in</a>
        </p>
    </div>
</body>
</html>
