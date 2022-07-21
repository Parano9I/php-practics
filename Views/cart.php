<!DOCTYPE html>
<html lang="en">
<?php include_once 'head.php' ?>

<body>
  <section class="products">
    <div class="container">
      <h1 class="products__title">Cart</h1>
      <ul class="products__list">
        <?php if (!empty($cartProducts)) : ?>
          <?php foreach ($cartProducts as $product) : ?>
            <li class="">
              <form action="" method="POST" class="products__item product">
                <img class="product__img" src="<?php echo $product['image'] ?>" alt="">
                <h3 class="product__title"><?php echo $product['name'] ?></h3>
                <p class="product__descr"><?php echo $product['description'] ?></p>
                <input type="hidden" name="productId" value="<?php echo $product['id'] ?>" required />
                <div class="product__bottom-wrapper">
                  <span class="product__price"><?php echo $product['price'] ?>$</span>
                  <input type="submit" class="product__btn" value="Add to cart" />
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