
<?php
try {
    // host
    define("HOST", "localhost");

    // db name
    define("DB_NAME", "coffee_shop");
    

    // user
    define("USER", "root");

    // password
    define("PASSWORD", "");

    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASSWORD);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
