<!DOCTYPE html>
<html lang="en">
<?php include_once 'head.php' ?>

<body>
    <div class="card">
        <h2 class="card-heading">
            Add Products
        </h2>
        <form class="card-form" enctype="multipart/form-data" method="POST">
            <div class="input">
                <input name="products" type="file" />
            </div>
            <div class="action">
                <input type="submit" value="Upload file" class="action-button" />
            </div>
        </form>
    </div>
</body>

</html>