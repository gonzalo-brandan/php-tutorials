<?php

function connectDb(): PDO { //pdo is php extension used to connect to different DBs. is kind of a DB abstraction
    $pdo = new PDO('sqlite:' . DB_DIR . '/' . 'db.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    return $pdo;
}