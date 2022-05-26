<?php

/**
 * @param string $email
 * @return array|string|void|null
 */
function getUserRoles(string $email)
{
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(),
            "select r.title from users u 
            join user_roles ur on u.id = ur.user 
            join roles r on r.id = ur.role where u.email = '$email'");

        $roles = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    }

    if ($roles != null) {
        return $roles;
    } else {
        return 'У пользователя нет ролей!';
    }
}

/**
 * @param string $email
 * @param string $password
 * @return bool
 */
function getSuccess(string $email, string $password)
{
    $email = mysqli_real_escape_string(dbConnect(), $email);
    $password = mysqli_real_escape_string(dbConnect(), $password);

    $user = getUser($email);

    if (password_verify($password, $user['password'])) {
        return true;
    } else {
        return 'Вы ввели неверный пароль!';
    }
}

/**
 * @param string $email
 * @return array|string|void|null
 */
function getUser(string $email)
{
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit;
    } else {
        $queryResult = mysqli_query(dbConnect(), "select * from users where email = '$email'");
        $user = mysqli_fetch_assoc($queryResult);
    }

    if ($user != null) {
        return $user;
    } else {
        return 'Пользователь не найден!';
    }
}
