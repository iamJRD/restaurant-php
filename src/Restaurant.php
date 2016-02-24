<?php
    class Resaurant
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

    }
?>
