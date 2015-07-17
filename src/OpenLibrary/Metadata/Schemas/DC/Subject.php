<?php
    /**
     * Created by PhpStorm.
     * User: skhanker
     * Date: 15/07/2015
     * Time: 5:49 PM
     */

    namespace UBC\LSIT\OpenCollections\Metadata\Schemas\DC;


    class Subject extends Schema
    {
        protected $uri = "http://purl.org/dc/elements/1.1/subject";

        protected $label = "Subject";

        protected $term = "subject";//becomes dc.contributor

        public function __construct($value,$label = false){
            if(!$label){
                $label = $this->label;
            }
            parent::__construct($value,$this->uri,$this->term,$label);
        }
    }
