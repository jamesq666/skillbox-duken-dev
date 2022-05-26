<?php

session_start(['name' => 'session_id']);

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/product.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/category.php';

$product = getProductByID($_GET['id']);
$categories = getCategoriesByProductID($_GET['id']);
$cat = [];

foreach ($categories as $category) {
    array_push($cat, $category['title']);
}

?>

<main class="page-add">
  <h1 class="h h--1">Изменение товара</h1>
  <form class="custom-form" action="products" method="post">
    <input type="text" name="id" value="<?= $_GET['id'] ?>" hidden>
    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Данные о товаре</legend>
      <label for="product-name" class="custom-form__input-wrapper page-add__first-wrapper">
        <input type="text" class="custom-form__input" name="product-name" id="product-name"
               value="<?= $product['name'] ?>">
        <p class="custom-form__input-label">
        </p>
      </label>
      <label for="product-price" class="custom-form__input-wrapper">
        <input type="text" class="custom-form__input" name="product-price" id="product-price"
               value="<?= $product['price'] ?>">
        <p class="custom-form__input-label">

        </p>
      </label>
    </fieldset>
    <fieldset class="page-add__group custom-form__group">
      <img class="page-add__first-wrapper" src="<?= "/img/products/" . $product['img'] ?>" align="right" alt="">
      <input type="text" name="product-photo-old" value="<?= $product['img'] ?>" hidden>
      <legend class="page-add__small-title custom-form__title">Изменить фотографию товара</legend>
      <ul class="add-list">
        <li class="add-list__item add-list__item--add">
          <input type="file" name="product-photo" id="product-photo" hidden="">
          <label for="product-photo">Выбрать фотографию</label>
        </li>
      </ul>
    </fieldset>
    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Раздел</legend>
      <div class="page-add__select">
        <select name="categories[]" class="custom-form__select" multiple="multiple">
          <option hidden="">Название раздела</option>
          <option <?php if (in_array('female', $cat)) {
              echo 'selected';
          } ?> value="female">Женщины
          </option>
          <option <?php if (in_array('male', $cat)) {
              echo 'selected';
          } ?> value="male">Мужчины
          </option>
          <option <?php if (in_array('children', $cat)) {
              echo 'selected';
          } ?> value="children">Дети
          </option>
          <option <?php if (in_array('access', $cat)) {
              echo 'selected';
          } ?> value="access">Аксессуары
          </option>
        </select>
      </div>
      <input type="checkbox" name="new" id="new" class="custom-form__checkbox" <?php if ($product['new'] == 1) {
          echo 'checked';
      } ?>>
      <label for="new" class="custom-form__checkbox-label">Новинка</label>
      <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox" <?php if ($product['sale'] == 1) {
          echo 'checked';
      } ?>>
      <label for="sale" class="custom-form__checkbox-label">Распродажа</label>
    </fieldset>
    <button class="button" type="submit" name="add">Изменить данные</button>
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
