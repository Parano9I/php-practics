<!DOCTYPE html>
<html lang="en">
<?php include_once 'head.php' ?>

<body>
    <section class="products">
        <div class="container">
            <h1 class="products__title">Products</h1>
            <ul class="products__list">
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                        <li class="products__item product">
                            <img class="product__img" src="<?php echo $product['image'] ?>" alt="">
                            <h3 class="product__title"><?php echo $product['name'] ?></h3>
                            <p class="product__descr"><?php echo $product['description'] ?></p>
                            <div class="product__bottom-wrapper">
                                <span class="product__price"><?php echo $product['price'] ?>$</span>
                                <a href="" class="product__link">Details</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </section>
</body>

</html>