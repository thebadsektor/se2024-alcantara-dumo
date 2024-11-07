<?php
    $dsn = 'mysql:host=mysql-db;port=3306;dbname=barbershop';
    $user = 'barber_user';
    $pass = 'barber_password_here';  // Matches docker-compose.yml settings
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    $attempts = 0;
    $connected = false;

    while (!$connected && $attempts < 5) {
        try {
            $con = new PDO($dsn, $user, $pass, $options);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connected = true;
        } catch (PDOException $ex) {
            $attempts++;
            if ($attempts >= 5) {
                echo "Failed to connect with database! " . $ex->getMessage();
                die();
            }
            // Wait 2 seconds before retrying to give MySQL time to initialize
            sleep(2);
        }
    }
?>
