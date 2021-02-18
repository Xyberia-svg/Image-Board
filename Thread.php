<?php 

class Thread{
    private $id;
    private $title;
    private $user;
    private $content;
    private $image;
    private $date;
    

    public function __construct($id, $user, $content, $title, $imgName){
        $this->id = $id;
        $this->user = $user;
        $this->title = $title;
        $this->content = $content;
        $this->image = $imgName;
    }

    public function getId(){
        return $this->id;
    }

    public function getUser(){
        return $this->user;
    }

    public function getContent(){
        return $this->content;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getImage(){
        return $this->image;
    }

    public function getDate(){
        return $this->date;
    }
}

?>