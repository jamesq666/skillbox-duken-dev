<?php

include $_SERVER['DOCUMENT_ROOT'] . '/functions/connect.php';

if (isset($_GET['product_id'])) {

    $productID = $_GET['product_id'];

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "update products set visible = 0 where id = '$productID'");
    }
}
