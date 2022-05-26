<?php

session_start(['name' => 'session_id']);

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/order.php';

?>

<main class="page-order">
  <h1 class="h h--1">Список заказов</h1>
  <ul class="page-order__list">
      <?php foreach (getSortedOrders() as $order) { ?>
        <li class="order-item page-order__item">
          <div class="order-item__wrapper">
            <div class="order-item__group order-item__group--id">
              <span class="order-item__title">Номер заказа</span>
              <span class="order-item__info"><?= 'id:' . $order['id'] ?></span>
            </div>
            <div class="order-item__group">
              <span class="order-item__title">Сумма заказа</span>
              <span class="order-item__info"><?= $order['amount'] ?> руб.</span>
            </div>
            <button class="order-item__toggle"></button>
          </div>
          <div class="order-item__wrapper">
            <div class="order-item__group order-item__group--margin">
              <span class="order-item__title">Заказчик</span>
              <span class="order-item__info"><?= $order['surname'] ?> <?= $order['name'] ?> <?= $order['middle_name'] ?></span>
            </div>
            <div class="order-item__group">
              <span class="order-item__title">Номер телефона</span>
              <span class="order-item__info"><?= $order['telephone'] ?></span>
            </div>
            <div class="order-item__group">
              <span class="order-item__title">Способ доставки</span>
              <span class="order-item__info"><?= $order['delivery'] ?></span>
            </div>
            <div class="order-item__group">
              <span class="order-item__title">Способ оплаты</span>
              <span class="order-item__info"><?= $order['payment'] ?></span>
            </div>
            <div class="order-item__group order-item__group--status">
              <span class="order-item__title">Статус заказа</span>
              <span class="order-item__info order-item__info--<?php if ($order['status'] == 1) {
                  echo 'yes';
              } else {
                  echo 'no';
              } ?>" id="<?= $order['id'] ?>"><?= ($order['status']) ? 'Выполнено' : 'Не выполнено' ?></span>
              <button class="order-item__btn" name="<?= $order['id'] ?>">Изменить</button>
            </div>
          </div>
          <div class="order-item__wrapper">
            <div class="order-item__group">
              <span class="order-item__title">Адрес доставки</span>
                <?php if ($order['delivery'] == 'Самовывоз') { ?>
                  <span class="order-item__info">Самовывоз</span>
                <?php } else { ?>
                  <span class="order-item__info">г. <?= $order['city'] ?>, ул. <?= $order['street'] ?>, д. <?= $order['home'] ?>, кв. <?= $order['apartment'] ?></span>
                <?php } ?>
            </div>
          </div>
          <div class="order-item__wrapper">
            <div class="order-item__group">
              <span class="order-item__title">Комментарий к заказу</span>
              <span class="order-item__info"><?= $order['comment'] ?></span>
            </div>
          </div>
        </li>
      <?php } ?>
  </ul>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
