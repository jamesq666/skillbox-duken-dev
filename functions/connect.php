<?php

/**
 * @return false|mysqli|void|null
 */
function dbConnect()
{

    static $connect = null;

    if ($connect == null) {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbName = 'mydb';
        $connect = mysqli_connect($host, $user, $password, $dbName) or die('Connection Error');
    }

    return $connect;
}
