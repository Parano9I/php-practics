<!DOCTYPE html>
<html lang="en">
<?php include_once 'head.php' ?>

<body>
    <section class="products">
        <div class="container">
            <h1 class="products__title">Cart</h1>
            <ul class="products__list">
                <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                <li class="">
                    <form action="" method="POST" class="products__item product">
                        <img class="product__img" src="<?php echo $_ENV['IMAGE_URL'] . $product['image'] ?>" alt="">
                        <h3 class="product__title"><?php echo $product['title'] ?></h3>
                        <p class="product__descr"><?php echo $product['description'] ?></p>
                        <input type="hidden" name="productId" value="<?php echo $product['id'] ?>" required />
                        <span class="product__price">Total price: <?php echo $product['total_price'] ?>$</span>
                        <span class="product__price">Amount: <?php echo $product['amount'] ?></span>
                        <div class="product__bottom-wrapper">
                            <span class="product__price"><?php echo $product['price'] ?>$</span>
                            <input type="submit" class="product__btn" value="Remove" />
                        </div>
                    </form>
                </li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </section>
</body>

</html>