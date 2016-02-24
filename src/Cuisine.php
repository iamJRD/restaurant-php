<?php
    class Cuisine
    {
        private $cuisine_type;
        private $id;

        function __construct($cuisine_type, $id = NULL)
        {
            $this->cuisine_type = $cuisine_type;
            $this->id = $id;
        }

        function setCuisineType($new_cuisine_type)
        {
            $this->cuisine_type = $new_cuisine_type;
        }

        function getCuisineType()
        {
            return $this->cuisine_type;
        }
        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (name) VALUES ('{$this->getCuisineType()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine)
            {
                $cuisine_type = $cuisine['name'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($cuisine_type, $id);

                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine){
                $cuisine_id = $cuisine->getId();
                if($cuisine_id == $search_id){
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }

        function getRestaurants()
        {
            $restaurants = array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
            foreach($returned_restaurants as $restaurant)
            {
                $restaurant_name = $restaurant['name'];
                $description = $restaurant['description'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($restaurant_name, $description, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);

            }
            return $restaurants;
        }

        function update($new_cuisine_type)
        {
            $GLOBALS['DB']->exec("UPDATE cuisine SET name = '{$new_cuisine_type}' WHERE id= {$this->getId()};");
            $this->setCuisineType($new_cuisine_type);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id = {$this->getId()};");
        }

        
    }

?>
