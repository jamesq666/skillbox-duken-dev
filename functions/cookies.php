<?php

/**
 * @param string $email
 */
function setCookies(string $email)
{
    setcookie('login', 1, time() + 60 * 60, '/');
    $_SESSION['email'] = $email;
}

/**
 *
 */
function deleteCookies()
{
    setcookie('login', '', time() - 10000, '/');
    session_unset();
    $_SESSION = array();
    unset($_SESSION['email']);
}
