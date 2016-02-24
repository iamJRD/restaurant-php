<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=restaurants_DB_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);



    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function testSaveCuisine()
        {
            //arrange
            $cuisine_type = "Mexican";
            $test_cuisine = new Cuisine($cuisine_type);

            //act
            $test_cuisine->save();

            //assert
            $result = Cuisine::getAll();
            $this->assertEquals($test_cuisine, $result[0]);
        }

        function testGetall()
        {
            //arrange
            $cuisine_type = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            $cuisine_type2 = "Peruvian";
            $test_cuisine2 = new Cuisine($cuisine_type2, $id);
            $test_cuisine2->save();

            //act
            $result = Cuisine::getAll();

            //assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function testDeleteAll()
        {
            //arrange
            $cuisine_type = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            $cuisine_type2 = "Peruvian";
            $test_cuisine2 = new Cuisine($cuisine_type2, $id);
            $test_cuisine2->save();

            //act
            Cuisine::deleteAll();

            //assert
            $result = Cuisine::getAll();
            $this->assertEquals([], $result);
        }

        function testGetId()
        {
            // Arrange
            $cuisine_type = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            // Act
            $result = $test_cuisine->getId();

            // Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testFind()
        {
            // Arrange
            $cuisine_type = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            $cuisine_type2 = "Peruvian";
            $test_cuisine2 = new Cuisine($cuisine_type2, $id);
            $test_cuisine2->save();

            // Act
            $result = Cuisine::find($test_cuisine->getId());

            // Assert
            $this->assertEquals($test_cuisine, $result);
        }

        function testGetRestaurants()
        {
            //arrange
            $cuisine_type = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $restaurant_name = "La Bonita";
            $description = "Burritos as big as your consciousness";
            $test_restaurant = new Restaurant($restaurant_name, $description, $test_cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "La Bamba";
            $description2 = "Good Pork!";
            $test_restaurant2 = new Restaurant($restaurant_name2, $description2, $test_cuisine_id, $id);
            $test_restaurant2->save();

            //act
            $result = $test_cuisine->getRestaurants();

            //assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testUpdate()
        {
            // Arrange
            $cuisine_type = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            $new_cuisine_type = "Guatemalan";

            // Act
            $test_cuisine->update($new_cuisine_type);

            // Assert
            $this->assertEquals("Guatemalan", $test_cuisine->getCuisineType());
        }

        function testDelete()
        {
            // Arrange
            $cuisine_type = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_type, $id);
            $test_cuisine->save();

            $cuisine_type2 = "Guatemalan";
            $test_cuisine2 = new Cuisine($cuisine_type2, $id);
            $test_cuisine2->save();

            // Act
            $test_cuisine->delete();

            // Assert
            $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }
    }
 ?>
