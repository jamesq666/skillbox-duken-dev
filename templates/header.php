<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/functions/connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/menu.php';
include $_SERVER['DOCUMENT_ROOT'] . '/functions/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/functions/user.php';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title><?= getTitle(getMenu($menu)); ?></title>

  <meta name="description" content="Fashion - интернет-магазин">
  <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">

  <meta name="theme-color" content="#393939">

  <link rel="preload" href="/fonts/opensans-400-normal.woff2" as="font">
  <link rel="preload" href="/fonts/roboto-400-normal.woff2" as="font">
  <link rel="preload" href="/fonts/roboto-700-normal.woff2" as="font">

  <link rel="icon" href="/img/favicon.png">
  <link rel="stylesheet" href="/css/style.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="/js/scripts.js" defer=""></script>
</head>
<body>
<header class="page-header">
  <a class="page-header__logo" href="/">
    <img src="/img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <ul class="main-menu main-menu--header">

        <?php foreach (getMenu($menu) as $section) { ?>
          <li>
            <a class="main-menu__item" id="<?= $section['id'] ?>" href="<?= $section['path'] ?>"><?= $section['title'] ?></a>
          </li>
        <?php } ?>
    </ul>
  </nav>
</header>
