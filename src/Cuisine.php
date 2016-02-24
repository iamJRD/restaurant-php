<?php
    class Cuisine
    {
        private $cuisine_type;
        private $id;

        function __construct($cuisine_type, $id)
        {
            $this->cuisine_type = $cuisine_type;
            $this->id = $id;
        }

        function setCusineType($new_cuisine_type)
        {
            $this->cuisine_type = $cuisine_type;
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

    }

?>
