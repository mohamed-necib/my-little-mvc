<?php
require_once 'vendor/autoload.php';
session_start();

use App\Model\Clothing;
use App\Model\Electronic;
use App\Controller\ShopController;

$shop = new ShopController();

if (isset($_GET['page'])) {
  $page = intval($_GET['page']);
} else {
  $page = 1;
}

$allProducts = $shop->index($page);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MY-LITTLE-MVC-SHOP</title>
  <link rel="stylesheet" href="./assets/css/shop.css">
</head>

<body>
  <?php
  require_once "header.php";
  ?>
  <div class="container">
    <div class="title">Liste de Produits</div>
    <div class="product-list">

      <!-- Liste des produits -->
      <?php foreach ($allProducts as $product) :
        $type = $shop->productType($product->getId());
      ?>
        <a href="product.php?id_product=<?= $product->getId(), '&product_type=', $type ?>" class="product">
          <img src="<?= $product->getPhotos()[0] ?>" alt="">
          <h2><?= $product->getName() ?></h2>
          <div class="price"><?= $product->getPrice() ?> €</div>

          <!-- <p><?= $product->getDescription() ?></p>
          <p><?= $product->getQuantity() ?></p> -->

        </a>
      <?php endforeach; ?>
      <!-- Pagination -->
      <?php if ($page > 1) : ?>
        <a href="shop.php?page=<?= $page - 1 ?>">Page précédente</a>
      <?php endif; ?>
      <?php
      if ($allProducts != empty([])) {
        $message = "Il n'y a plus de produits";
      } else { ?>
        <a href="shop.php?page=<?= $page + 1 ?>">Page suivante</a>
      <?php
      }
      if (isset($message)) { ?>
        <h2><?= $message ?></h2>
      <?php
      }
      ?>
    </div>
  </div>



</body>

</html>