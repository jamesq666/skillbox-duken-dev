<?php

include $_SERVER['DOCUMENT_ROOT'] . '/functions/connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/constants.php';

$page = $_GET['page'] ?? 1;
$category = $_GET['category'] ?? 'all';
$minPrice = $_GET['minPrice'] ?? '350';
$maxPrice = $_GET['maxPrice'] ?? '32000';
$ch_new = $_GET['ch_new'] ?? null;
$ch_sale = $_GET['ch_sale'] ?? null;
$sort = $_GET['sort'] ?? 'name';
$order = $_GET['order'] ?? 'asc';

$offset = ($page - 1) * COUNT_PRODUCTS_PER_PAGE;

if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit;
} else {
    $response = [];
    $query = "select * from products p 
                join product_categories pc on p.id = pc.product
                join categories c on c.id = pc.category
                where p.visible = 1 and p.price >= $minPrice and p.price <= $maxPrice";

    if ($category != 'all') {
        $query = $query . " and c.title = '$category'";
    }
    if ($ch_new != null) {
        $query = $query . " and p.new = '$ch_new'";
    }
    if ($ch_sale != null) {
        $query = $query . " and p.sale = '$ch_sale'";
    }

    $query = $query . " group by p.name ";

    $queryResult = mysqli_query(dbConnect(), $query);
    $products = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    $count = count($products);
    $response['count'] = $count;

    $query = $query . " order by p.$sort $order limit " . COUNT_PRODUCTS_PER_PAGE . " offset $offset";

    //$response['query'] = $query;

    $queryResult = mysqli_query(dbConnect(), $query);
    $products = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    $response['products'] =  $products;

    echo json_encode($response);
}
