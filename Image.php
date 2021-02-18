<?php
class Image{
    public $imgName;
    public $imgSize;
    public $upDate;

    public function __construct($imgName, $imgSize, $upDate){
        $this->imgName = $imgName;
        $this->imgSize = $imgSize;
        $this->upDate = $upDate;
    }

    public function getImgName(){
        return $this->imgName;
    }

    public function getImgSize(){
        return $this->imgSize;
    }

    public function getUpDate(){
        return $this->upDate;
    }

}

?>