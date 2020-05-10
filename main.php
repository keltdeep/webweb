<?php

session_start();

$serverName = $_SERVER["HTTP_HOST"];
$documentRoot = $_SERVER["DOCUMENT_ROOT"];
$uploadFolder = $documentRoot.'/uploads';
$requestUri = $_SERVER["REQUEST_URI"];
$requestUri = explode("?", $requestUri);
$requestUri = $requestUri[0];
$requestMethod = $_SERVER["REQUEST_METHOD"];

$jsScripts = [];
$srcLogotypes = [];
$srcCsses = [];

if (is_null($_SESSION["currentUser"]) && $requestUri != '/login' && $requestUri != '/auth') {
    header('Location: /login');
}

include "users-controller.php";

if ($requestUri == "/logout"){
    session_destroy();
    header('Location: /');
    die();
}

if ($requestUri == "/login"){
    $srcCsses = ["../style.css"];
    $srcLogotypes = ["../img/log.jpg"];
    $handleRequest = function() {
        include "login.html";
    };
    include "index.php";
    die();
}

if ($requestUri == "/contacts"){
    $srcCsses = ["../style.css"];
    $srcLogotypes = ["../img/log.jpg"];
    $handleRequest = function() {
    
    include "contacts.html";
};
    
    include "index.php";
    die();
}



if ($requestUri == "/goods"){
    $srcCsses = ["../style.css"];
    $srcLogotypes = ["img/log.jpg"];
    $handleRequest = function() {

    include "goods/allgoods.html";

    };
    include "index.php";
    die();
}

if ($requestUri == "/goods/arbor_Foundation"){
    $srcLogotypes = ["../img/log.jpg"];
    $srcCsses = ["../style.css"];
    $handleRequest = function() {
    
    include "goods/arbor_Foundation.html";

    };
    include "index.php";
    die();

}
if ($requestUri == "/goods/burton_feather"){
    $srcCsses = ["../style.css"];
    $srcLogotypes = ["../img/log.jpg"];
    $handleRequest = function() {
    include "goods/burton_feather.html";
};
    include "index.php";
    die();
}
if ($requestUri == "/goods/jones_twin_sister"){
    $srcCsses = ["../style.css"];
    $srcLogotypes = ["../img/log.jpg"];
    $handleRequest = function() {
    include "goods/jones_twin_sister.html";
};
    include "index.php";
    die();
}

if ($requestUri == "/"){
    $srcCsses = ["../style.css"];
    $srcLogotypes = ["../img/log.jpg"];
    $handleRequest = function() {
        echo $_SESSION["currentUser"]["login"];
    };
    include "index.php";
    die();
}

if ($requestUri == "/auth"){
    $login = filter_var($_POST["login"] , FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"] , FILTER_SANITIZE_STRING);

    foreach (getUsers() as $user) {
        if ($user['active'] && $user['login'] == $login && password_verify($password, $user['password'])) {
            $_SESSION["currentUser"] = $user;
        }
}
header('Location: /');
die();
}

http_response_code(404);
die();


