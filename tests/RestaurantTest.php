<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurants_DB_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);



    class RestaurantTest extends PHPUnit_Framework_TestCase{


    }
?>
