<?php


$pdo = null;


function getConnection() {
    global $pdo;

    if (is_null($pdo)) {
        $options = [
            \PDO::ATTR_EMULATE_PREPARES   => false,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $dsn ='postgres://tfdnhhaubrgmiy:75a0b7b1eb5c01aad0d086f67bc6a03913e99f7456eb1d030bffd82990a27cbb@ec2-46-137-156-205.eu-west-1.compute.amazonaws.com:5432/d2h65mlefqfto5';

        // $dsn = getenv('DATABASE_URL');
        $database_connection = parse_url($dsn);
        $host = $database_connection['host'];
        $port = $database_connection['port'];
        $user = $database_connection['user'];
        $pass = $database_connection['pass'];
        $database = ltrim($database_connection['path'], '/');
        

        try {
            $pdo_dsn = 'pgsql:host='.$host.';port='.$port.';dbname='.$database;
            
            $pdo = new \PDO($pdo_dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            var_dump($e);
            die("cant connect to the database");
        }
    }
    
    return $pdo;
}


