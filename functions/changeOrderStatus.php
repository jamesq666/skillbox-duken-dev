<?php

include $_SERVER['DOCUMENT_ROOT'] . '/functions/connect.php';

if (isset($_POST['order_status']) && isset($_POST['order_id'])) {

    $orderStatus = $_POST['status'] == 'Выполнено' ? 0 : 1;
    $orderID = $_POST['order_id'];

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "update orders set status = '$orderStatus' where id = '$orderID'");
    }
}
