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



    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Restaurant::deleteAll();
            // Cuisine::deleteAll();
        }

        function testSaveRestaurant()
        {
            //arrange

            $restaurant_name = "La Bonita";
            $cuisine_id = 1;
            $description = "Burritos as big as your consciousness";
            $test_restaurant = new Restaurant($restaurant_name, $description, $cuisine_id);

            //act
            $test_restaurant->save();

            //assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);

        }

        function testGetAll ()
        {
            //arrange
            $restaurant_name = "La Bonita";
            $id = null;
            $cuisine_id = 1;
            $description = "Burritos as big as your consciousness";
            $test_restaurant = new Restaurant($restaurant_name, $description, $cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "La Bamba";
            $id2 = null;
            $cuisine_id2 = 1;
            $description2 = "Good Pork!";
            $test_restaurant2 = new Restaurant($restaurant_name2, $description2, $cuisine_id2, $id2);
            $test_restaurant2->save();

            //act
            $result = Restaurant::getAll();

            //assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testDeleteAll()
        {
            //arrange
            $restaurant_name = "La Bonita";
            $id = null;
            $cuisine_id = 1;
            $description = "Burritos as big as your consciousness";
            $test_restaurant = new Restaurant($restaurant_name, $description, $cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "La Bamba";
            $id2 = null;
            $cuisine_id2 = 1;
            $description2 = "Good Pork!";
            $test_restaurant2 = new Restaurant($restaurant_name2, $description2, $cuisine_id2, $id2);
            $test_restaurant2->save();

            //act
            Restaurant::deleteAll();

            //assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            // Arrange
            $restaurant_name = "La Bonita";
            $id = null;
            $cuisine_id = 1;
            $description = "Burritos as big as your consciousness";
            $test_restaurant = new Restaurant($restaurant_name, $description, $cuisine_id, $id);
            $test_restaurant->save();

            // Act
            $result = $test_restaurant->getId();

            // Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_find()
        {
            // Arrange
            $restaurant_name = "La Bonita";
            $id = null;
            $cuisine_id = 1;
            $description = "Burritos as big as your consciousness";
            $test_restaurant = new Restaurant($restaurant_name, $description, $cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "La Bamba";
            $id2 = null;
            $cuisine_id2 = 1;
            $description2 = "Good Pork!";
            $test_restaurant2 = new Restaurant($restaurant_name2, $description2, $cuisine_id2, $id2);
            $test_restaurant2->save();

            // Act
            $result = Restaurant::find($test_restaurant->getId());

            // Assert
            $this->assertEquals($test_restaurant, $result);
        }
    }
?>
