<?php

/**
 * @return array|void
 */
function getProducts()
{
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "select * from products where visible = 1");

        return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }
}

/**
 * @param $id
 * @return array|false|string[]|void|null
 */
function getProductByID($id)
{
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "select * from products where id = '$id'");

        return mysqli_fetch_assoc($queryResult);
    }
}

/**
 * @param $name
 * @param $price
 * @param $photo
 * @param $categories
 * @param $new
 * @param $sale
 * @return bool|mysqli_result|void
 */
function createProduct($name, $price, $photo, $categories, $new, $sale)
{
    $verifiedName = mysqli_real_escape_string(dbConnect(), $name);
    $verifiedPrice = mysqli_real_escape_string(dbConnect(), $price);

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "
        insert into products (name, price, img, new, sale) 
        values ('$verifiedName', '$verifiedPrice', '$photo', '$new', '$sale')");

        $id = mysqli_insert_id(dbConnect());
        setProductCategories($id, $categories);

        return $queryResult;
    }
}

/**
 * @param $id
 * @param $name
 * @param $price
 * @param $photo
 * @param $categories
 * @param $new
 * @param $sale
 * @return bool|mysqli_result|void
 */
function updateProduct($id, $name, $price, $photo, $categories, $new, $sale)
{
    $verifiedName = mysqli_real_escape_string(dbConnect(), $name);
    $verifiedPrice = mysqli_real_escape_string(dbConnect(), $price);

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "
        update products set name = '$verifiedName', price = '$verifiedPrice', img = '$photo', new = '$new', sale = '$sale' 
        where id = '$id'");

        updateProductCategories($id, $categories);

        return $queryResult;
    }
}
