<?php

session_start(['name' => 'session_id']);

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/cookies.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
  if (getSuccess($_POST['email'], $_POST['password'])) {
      session_name('session_id');
      session_start();
      setCookies($_POST['email']);
      header("Location: /index.php");
  }
}

if (isset($_POST['exit'])) {
    deleteCookies();
    header("Refresh: 0");
}

?>

<main class="page-authorization">
  <h1 class="h h--1">Авторизация</h1>
  <form class="custom-form" action="/admin/authorization.php" method="post">
      <?php if (!isset($_COOKIE['login']) || $_COOKIE['login'] == 0) { ?>
        <input type="email" class="custom-form__input" required="" placeholder="e-mail" name="email">
        <input type="password" class="custom-form__input" required="" placeholder="пароль" name="password">
        <button class="button" type="submit">Войти в личный кабинет</button>
      <?php } else { ?>
        <button class="button" type="submit" name="exit">Выйти</button>
      <?php } ?>
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
