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



    class CuisineTest extends PHPUnit_Framework_TestCase{

        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function testSaveCuisine()
        {
            //arrange
            $cuisine_type = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_type, $id);

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

        function test_getId()
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
    }
 ?>
