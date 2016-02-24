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

        function setId($new_id)
        {
            $this->id = $new_id;
        }
        function getId()
        {
            return $this->id;
        }
        
    }

?>
