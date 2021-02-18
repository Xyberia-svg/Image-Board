<?php 

class Comment {
    private $id;
    private $user;
    private $content;
    private $image;
    private $date;

    public function __construct($user, $content, $image, $date) {
        $this->user = $user;
        $this->content = $content;
        $this->image = $image;
        $this->date = $date;
    }

    public function getUser(){
        return $this->user;
    }
    
    public function getContent(){
        return $this->content;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getImage(){
        return $this->image;
    }

    public function getDate(){
        return $this->date;
    }
}

?>