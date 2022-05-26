<?php

session_start(['name' => 'session_id']);

include $_SERVER['DOCUMENT_ROOT'] . '/include/constants.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/functions/connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/cookies.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/user.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

var_dump($_POST);

?>

<script>
    $(document).ready ( function(){
        getProducts();
    });
</script>

<main class="shop-page">
  <header class="intro">
    <div class="intro__wrapper">
      <h1 class=" intro__title">DUKEN</h1>
      <p class="intro__info">Collection 2022</p>
    </div>
  </header>
  <section class="shop container">
    <section class="shop__filter filter">
      <form>
        <div class="filter__wrapper">
          <b class="filter__title">Категории</b>
          <ul class="filter__list">
            <li>
              <a class="filter__list-item active" id="all" href="#">Все</a>
            </li>
            <li>
              <a class="filter__list-item" id="female" href="#">Женщины</a>
            </li>
            <li>
              <a class="filter__list-item" id="male" href="#">Мужчины</a>
            </li>
            <li>
              <a class="filter__list-item" id="children" href="#">Дети</a>
            </li>
            <li>
              <a class="filter__list-item" id="access" href="#">Аксессуары</a>
            </li>
          </ul>
        </div>
        <div class="filter__wrapper">
          <b class="filter__title">Фильтры</b>
          <div class="filter__range range">
            <span class="range__info">Цена</span>
            <div class="range__line" aria-label="Range Line"></div>
            <div class="range__res">
              <span class="range__res-item min-price" id="min-price">350 руб.</span>
              <span class="range__res-item max-price" id="max-price">32000 руб.</span>
            </div>
          </div>
        </div>

        <fieldset class="custom-form__group">
          <input type="checkbox" name="new" id="new" class="custom-form__checkbox">
          <label for="new" class="custom-form__checkbox-label custom-form__info" style="display: block;">Новинка</label>
          <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
          <label for="sale" class="custom-form__checkbox-label custom-form__info"
                 style="display: block;">Распродажа</label>
        </fieldset>
        <a class="button" type="submit" style="width: 100%" id="apply">Применить</a>
      </form>
    </section>

    <div class="shop__wrapper">
      <section class="shop__sorting">
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="category" id="sort">
            <option hidden="">Сортировка</option>
            <option value="price">По цене</option>
            <option value="name">По названию</option>
          </select>
        </div>
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="prices" id="order">
            <option hidden="">Порядок</option>
            <option value="asc">По возрастанию</option>
            <option value="desc">По убыванию</option>
          </select>
        </div>
        <p class="shop__sorting-res">Найдено <span class="res-sort" id="res-sort"></span><?= ' моделей'; ?></p>
        <!-- js функция addProductsCount -->
      </section>
      <section class="shop__list">
        <!-- js функция addTags -->
      </section>
      <ul class="shop__paginator paginator" id="123">
        <!-- js функция addPagination -->
      </ul>
    </div>
  </section>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/order.php'; ?>

    <?php //include $_SERVER['DOCUMENT_ROOT'] . '/include/continue.php'; ?>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

