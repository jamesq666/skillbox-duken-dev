<?php

/**
 * @param array $order
 * @return array|void
 */
function createOrder($order)
{
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "insert into orders (amount, surname, name, middle_name, telephone, email, delivery, city, street, home, apartment, payment, comment, status)
                                                        values ('$productID', '$categoryID')");

        return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }
}

/**
 * @return array|void
 */
function getOrders()
{
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "select * from orders order by cr_date desc");

        return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }
}

/**
 * @return array
 */
function getSortedOrders()
{
    $orders = getOrders();

    $uncompletedOrders = [];
    $completedOrders = [];

    foreach ($orders as $order) {
        if ($order['status'] == 0) {
            array_push($uncompletedOrders, $order);
        } else {
            array_push($completedOrders, $order);
        }
    }

    return array_merge($uncompletedOrders, $completedOrders);
}
