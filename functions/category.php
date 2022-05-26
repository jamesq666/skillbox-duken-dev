<?php

/**
 * @return array|void
 */
function getCategories () {
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "select * from categories");

        return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }
}

/**
 * @return array|void
 */
function getProductCategories()
{
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "
            select p.id, c.title from products p 
            join product_categories pc on p.id = pc.product 
            join categories c on c.id = pc.category
        ");

        return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }
}

/**
 * @param $productID
 * @return array|void
 */
function getCategoriesByProductID($productID)
{
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "
            select c.title from products p 
            join product_categories pc on p.id = pc.product 
            join categories c on c.id = pc.category
            where p.id = '$productID'
        ");

        return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }
}

/**
 * @param $productID
 * @param $newCategories
 * @return bool|mysqli_result|void
 */
// TODO не удалять данные по категориям, если они не изменились
function updateProductCategories($productID, $newCategories)
{
    $categories = getCategories();
    $categoriesID = [];

    foreach ($categories as $category) {
        if (in_array($category['title'], $newCategories)) {
            array_push($categoriesID, $category['id']);
        }
    }

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $deleteQuery = mysqli_query(dbConnect(), "delete from product_categories where product = '$productID'");

        foreach ($categoriesID as $categoryID) {
            $insertQuery = mysqli_query(dbConnect(), "insert into product_categories (product, category) values ('$productID', '$categoryID')");
        }

        return $insertQuery;
    }
}

/**
 * @param $productID
 * @param $newCategories
 * @return bool|mysqli_result|void
 */
function setProductCategories($productID, $newCategories)
{
    $categories = getCategories();
    $categoriesID = [];

    foreach ($categories as $category) {
        if (in_array($category['title'], $newCategories)) {
            array_push($categoriesID, $category['id']);
        }
    }

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        foreach ($categoriesID as $categoryID) {
            $queryResult = mysqli_query(dbConnect(), "insert into product_categories (product, category) values ('$productID', '$categoryID')");
        }

        return $queryResult;
    }
}
