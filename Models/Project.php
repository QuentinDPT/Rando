<?php

class Project{
    private $_id;
    private $_name;
    private $_belowName;
    private $_description;
    private $_tags;
    private $_location;

    public function __construct($id, $name, $belowName, $desc, $tags, $location){
        $this->_id          = $id;
        $this->_name        = $name;
        $this->_belowName   = $belowName;
        $this->_description = $desc;
        $this->_tags        = $tags;
        $this->_location    = $location;
    }

    public function getId(){ return $this->_id ; }
    public function getName(){ return $this->_name ; }
    public function getBelowName(){ return $this->_belowName ; }
    public function getDescription(){ return $this->_description ; }
    public function getTags(){ return $this->_tags ; }
    public function getLocation(){ return $this->_location ; }

    public function setName($name){ $this->_name = $name ; }
    public function setBelowName($belowName){ $this->_belowName = $belowName ; }
    public function setDescription($description){ $this->_description = $description ; }
}
