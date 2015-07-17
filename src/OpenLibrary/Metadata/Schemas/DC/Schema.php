<?php
    /**
     * Created by PhpStorm.
     * User: hajime
     * Date: 15-07-16
     * Time: 23:58
     */
    namespace UBC\LSIT\OpenCollections\Metadata\Schemas\DC;

    class Schema {

        protected $uri = "http://purl.org/dc/elements/1.1/";

        protected $label = "";

        protected $term = "dc";

        protected $value;

        public function __construct($value, $uri = false, $term = false, $label = false){
            if($uri){
                $this->uri = $uri;
            }

            if($term){
                $this->term .= ".{$term}";
            }

            if($label){
                $this->label = $label;
            }

            $this->value = $value;
        }

        /**
         * @return string
         */
        public function getUri ()
        {
            return $this->uri;
        }

        /**
         * @param string $uri
         */
        public function setUri ($uri)
        {
            $this->uri = $uri;
        }

        /**
         * @return string
         */
        public function getLabel ()
        {
            return $this->label;
        }

        /**
         * @param string $label
         */
        public function setLabel ($label)
        {
            $this->label = $label;
        }

        /**
         * @return string
         */
        public function getTerm ()
        {
            return $this->term;
        }

        /**
         * @param string $term
         */
        public function setTerm ($term)
        {
            $this->term = $term;
        }

        /**
         * @return mixed
         */
        public function getValue ()
        {
            return $this->value;
        }

        /**
         * @param mixed $value
         */
        public function setValue ($value)
        {
            $this->value = $value;
        }
    }