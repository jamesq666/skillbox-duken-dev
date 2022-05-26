<?php

/**
 * @param string $url
 * @return bool
 */
function getCurrentUrl(string $url)
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $url;
}

/**
 * @param array $menu
 * @return mixed|void
 */
function getTitle(array $menu)
{
    foreach ($menu as $menuItem) {
        if (getCurrentUrl($menuItem['path'])) {
            return $menuItem['title'];
        }
    }
}

/**
 * @param array $menu
 * @return array|void
 */
function getMenu(array $menu)
{
    if (isset($_SESSION['email']) && isset($_COOKIE['login'])) {
        $roles = getUserRoles($_SESSION['email']);
    } else {
        return $menu;
    }

    if (is_array($roles)) {
        foreach ($roles as $role) {
            if ($role['title'] == 'admin') {
                array_push($menu,
                    [
                        'title' => 'Заказы',
                        'path' => '/include/orders',
                    ],
                    [
                        'title' => 'Товары',
                        'path' => '/include/products',
                    ]);
                return $menu;
            } else if ($role['title'] == 'operator') {
                array_push($menu,
                    [
                        'title' => 'Заказы',
                        'path' => '/include/orders',
                    ]);
                return $menu;
            }
        }
    } else {
        return $menu;
    }
}
