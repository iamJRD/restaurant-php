<?php
    class Restaurant
    {
        private $restaurant_name;
        private $id;
        private $cuisine_id;
        private $restaurant_description;

        function __construct($restaurant_name, $restaurant_description, $cuisine_id, $id = NULL)
        {
            $this->restaurant_name = $restaurant_name;
            $this->restaurant_description = $restaurant_description;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }
// SETTERS
        function setRestaurantName($new_restaurant_name)
        {
            $this->restaurant_name = $new_restaurant_name;
        }

        function setRestaurantDescription($new_restaurant_description)
        {
            $this->restaurant_description = $new_restaurant_description;
        }

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = $new_cuisine_id;
        }
// GETTERS
        function getRestaurantName()
        {
            return $this->restaurant_name;
        }

        function getRestaurantDescription()
        {
            return $this->restaurant_description;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, description) VALUES ('{$this->getRestaurantName()}', {$this->getCuisineId()}, '{$this->getRestaurantDescription()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant)
            {
                $name = $restaurant['name'];
                $description = $restaurant['description'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($name, $description, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant){
                $restaurant_id = $restaurant->getId();
                if($restaurant_id == $search_id){
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

        function update($new_restaurant_name, $new_restaurant_description)
        {
            $GLOBALS['DB']->exec("UPDATE restaurant SET name = '{$new_restaurant_name}', description = '{$new_restaurant_description}' WHERE id = {$this->getId()};");
            $this->setRestaurantName($new_restaurant_name);
            $this->setRestaurantDescription($new_restaurant_description);
        }
    }
?>
