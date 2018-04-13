<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //grab password from post
    $password = $_POST['password'];
    //give it hash structure
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //file var
    $PASSWORD_FILE = 'password.txt';
    //make file if not exists add "123456789" in hash format
    if (!file_exists($PASSWORD_FILE)) {
        file_put_contents($PASSWORD_FILE, "$2y$10$7YYrvhUGjqP3JLjT6Pff7eEUFwZh4Vz1/GzWiqmDC5BwnCvnKRkUO");
    }

    //grab pw from db or wherever...
    $password_in_db = file_get_contents($PASSWORD_FILE);

    if (password_verify($password, $password_in_db)) {
        echo "Password is in db---LOGIN OK!";
    } else {
        echo "Password is NOT in db---LOGIN FAILED";
    }
}
