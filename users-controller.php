<?php

include "users-model.php";

if ($requestUri == "/users") {
    $srcCsses = ["../style.css"];
    $jsScripts = ["/assets/js/users.js"];
    $srcLogotypes = ["/img/log.jpg"];

    $handleRequest = function() use($users) {
    
        include "usersPagination.html";
    };

    include "index.php";
    die();
}


if ($requestUri == "/api/users") {
    header('Content-Type: application/json');
    if ($requestMethod == "GET") {

        $limit = filter_var($_GET["limit"], FILTER_VALIDATE_INT);
        $offset = filter_var($_GET["offset"], FILTER_VALIDATE_INT);
        echo json_encode(getUsers($limit, $offset));
        
        die();
    }

    if ($requestMethod == "POST") {
        $login = filter_var($_POST['login'] ,FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'] ,FILTER_SANITIZE_STRING);

        try {
            $user = createUser($login, $password);
            echo json_encode($user);
        } catch (Exception $exception) {
            echo $exception->getMessage();
            handleCreate();
        }
        header('Location: /users');
        die();
    }
    
}

if (startsWith($requestUri, "/api/users/")) {
    header('Content-Type: application/json');

    $path = explode("/", $requestUri);
    $userUuid = $path[count($path) - 1];
    
    $user = getUser($userUuid);
    

    if (is_null($user)) {
        http_response_code(404);
        die();
    }

    if ($requestMethod == "GET") {
        echo json_encode(getUser($userUuid));
        
        die();
    }

    if ($requestMethod == "POST") {
        $login = filter_var($_POST['login'] ,FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'] ,FILTER_SANITIZE_STRING);
        $isActive = filter_var($_POST['active'] ,FILTER_SANITIZE_STRING);

        
        
        $attributes = [];
        
        
    if (!$_FILES["picture"]["error"] == UPLOAD_ERR_NO_FILE) {
        $folder = $uploadFolder;
        $file_path = upload_image($_FILES["picture"], $folder);
        $file_path_exploded = explode("/", $file_path);
        $filename = $file_path_exploded[count($file_path_exploded) - 1];
        $file_url = "//$serverName/uploads/".$filename;
        $attributes["image"] = $file_url;
        
    }
        if (!empty($login)) {
            $attributes["login"] = $login;
        }

        if (!empty($password)) {
            $attributes["password"] = password_hash($password, PASSWORD_BCRYPT);
        }

        if (!empty($isActive)) {
            $attributes["active"] = true;
        } else {
            $attributes["active"] = false;
        }
       
        editUser($userUuid, $attributes);
        header('Location: /users');
        die();
    }

    if ($requestMethod == "DELETE") {
        deleteUser($userUuid);
        die();
    }
}

function handleView($user) {
    $srcLogotypes = ["/img/log.jpg"];
    $srcCsses = ["../style.css"];
    $handleRequest = function() use ($user) {
        include "templates/userView.php";
    };

    include "index.php";
    die();
}

function handleEdit($user) {
    $jsScripts = ['/assets/js/users-edit.js'];
    $srcLogotypes = ["/img/log.jpg"];
    $srcCsses = ["/style.css"];
    $userExists = isset($user["uuid"]);
    $handleRequest = function() use ($user, $userExists) {
        include "templates/userEdit.php";
    };

    include "index.php";
    die();
}

function handleCreate() {
    $jsScripts = ['/assets/js/users-edit.js'];
    $srcLogotypes = ["/img/log.jpg"];
    $srcCsses = ["../style.css"];
    $user = ["active" => true];
    $userExists = isset($user["uuid"]);
    
    $handleRequest = function() use ($user, $userExists) {
       
        include "templates/userEdit.php";
    };
    
    include "index.php";
    
    die();
}

if ($requestUri == "/users/create") {
    handleCreate();
}

if (startsWith($requestUri, "/users/")) {
    $path = explode("/", $requestUri);
    
    $userUuid = $path[2];
    
    $user = getUser($userUuid);
    
    if (is_null($user)) {
        http_response_code(404);
        die();
    }
     
  
    if ($path[count($path) - 1] == 'edit') {
        
        handleEdit($user);
    } else {
        handleView($user);
    }
}

