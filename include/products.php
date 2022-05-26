<?php

session_start(['name' => 'session_id']);

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/product.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/category.php';

if (!empty($_POST)) {
    if (!empty($_POST['product-photo'])) {
        $photo = $_POST['product-photo'];
    } else {
        $photo = $_POST['product-photo-old'];
    }

    $new = isset($_POST['new']) ? 1 : 0;
    $sale = isset($_POST['sale']) ? 1 : 0;

    if (isset($_POST['id'])) {
        if (updateProduct($_POST['id'], $_POST['product-name'], $_POST['product-price'], $photo, $_POST['categories'], $new, $sale)) {
            include $_SERVER['DOCUMENT_ROOT'] . '/include/successful.php';
        }
    } else {
        if (createProduct($_POST['product-name'], $_POST['product-price'], $photo, $_POST['categories'], $new, $sale)) {
            include $_SERVER['DOCUMENT_ROOT'] . '/include/successful.php';
        }
    }
}

?>

<main class="page-products">
  <h1 class="h h--1">Товары</h1>

  <a class="page-products__button button" href="create.php">Добавить товар</a>
  <div class="page-products__header">
    <span class="page-products__header-field">ID</span>
    <span class="page-products__header-field">Название товара</span>
    <span class="page-products__header-field">Цена</span>
    <span class="page-products__header-field">Категория</span>
    <span class="page-products__header-field">Новинка</span>
  </div>
  <ul class="page-products__list">
      <?php foreach (getProducts() as $product) { ?>
        <li class="product-item page-products__item">
          <span class="product-item__field" id="<?= $product['id'] ?>"><?= $product['id'] ?></span>
          <b class="product-item__name"><?= $product['name'] ?></b>
          <span class="product-item__field"><?= $product['price'] ?> руб.</span>
          <span class="product-item__field">
          <?php foreach (getProductCategories() as $category) {
              if ($product['id'] == $category['id']) {
                  if ($category['title'] == 'female') {
                      echo 'Женщины' . '<br/>';
                  } else if ($category['title'] == 'male') {
                      echo 'Мужчины' . '<br/>';
                  } else if ($category['title'] == 'children') {
                      echo 'Дети' . '<br/>';
                  } else {
                      echo 'Аксессуары';
                  }
              }
          } ?>
        </span>
          <span class="product-item__field"><?= $product['new'] ?></span>
          <a href="update<?= '?id=' . $product['id'] ?>" class="product-item__edit" aria-label="Редактировать"></a>
          <button class="product-item__delete" name="<?= $product['id'] ?>"></button>
        </li>
      <?php } ?>
  </ul>
  <br>
  <ul class="shop__paginator paginator">
    <li>
      <a class="paginator__item" id="1" href="#">1</a>
    </li>
    <li>
      <a class="paginator__item" id="2" href="#">2</a>
    </li>
    <li>
      <a class="paginator__item" id="3" href="#">3</a>
    </li>
    <li>
      <a class="paginator__item" id="4" href="#">4</a>
    </li>
    <!-- js функция addPagination -->
  </ul>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
