<?php 
require_once './DBConnect.php';
require_once './Comment.php';
require_once './Image.php';
require_once './Thread.php';

class Controls{
    private $sqlString;
    private $table;
    private $DBconnect;

    public function __construct() {
        $DBinstance = DBConnect::getInstance('board');
        $this->DBconnect = $DBinstance->getConnection();
        $this->table = 'comment';
        
    }

    // retrieve comments
    public function getComments(){
        $this->sqlString = "SELECT * FROM $this->table ORDER BY id DESC";
        $query = $this->DBconnect->query($this->sqlString);
        $comments = array();
        while ($row = $query->fetch()){
            $image = new Image($row[3], $row[4], $row[5]);
            $comment = new Comment($row[2], $row[1], $image, $row[5]);
            $comment->setId($row[0]);
            array_push($comments, $comment);
        }
        $query->closeCursor();
        return $comments;
    }
    
    // add comment
    public function addComment($user, $comment, $image, $threadID){
        $this->sqlString = "INSERT INTO $this->table VALUES (NULL, :content, :username, :imgName, :imgSize, :upDate, :threadID)";
        $query = $this->DBconnect->prepare($this->sqlString);
        $paramArray = array (
            'content' => $comment,
            'username' => $user,
            'imgName' => $image->getImgName(),
            'imgSize' => $image->getImgSize(),
            'upDate' => $image->getUpDate(),
            'threadID' => $threadID
        );
        $query->execute($paramArray);
        $query->closeCursor();
        $commentArray = array($user, $comment, $image);
        return $commentArray;
    }

    // remove comment - NOT IMPLEMENTED YET
    public function deleteComment($IDcomment){
        $this->sqlString = "DELETE FROM $this->table WHERE id = ?";
        $query = $this->PDO->prepare($this->sqlString);
        $query->execute([$IDcomment]);
        $query->closeCursor();
    }

    public function getCommentsByID($threadID){
        $this->sqlString = "SELECT * FROM $this->table WHERE id_thread = ?";
        $stmt = $this->DBconnect->prepare($this->sqlString);
        $stmt->execute([$threadID]);
        $cmtsArr = array();
        while ($row = $stmt->fetch()){
            $cmt = new Comment($row[2], $row[1], $row[3], $row[5]);
            array_push($cmtsArr, $cmt);
        }
        $stmt->closeCursor();
        return $cmtsArr;
    }

    public function getAllThreads(){
        $this->sqlString = "SELECT * FROM thread";
        $stmt = $this->DBconnect->query($this->sqlString);
        $arr = array();
        while ($row = $stmt->fetch()){
            $thread = new Thread($row[0], $row[1], $row[2], $row[3], $row[4]);
            array_push($arr, $thread);
        }
        $stmt->closeCursor();
        return $arr;
    }

    public function getThreadByID($threadID){
        $this->sqlString = "SELECT * FROM thread WHERE ID = ?";
        $stmt = $this->DBconnect->prepare($this->sqlString);
        $stmt->execute([$threadID]);
        while ($row = $stmt->fetch()){
            $thread = new Thread($row[0], $row[1], $row[2], $row[3], $row[4]);
        }
        $stmt->closeCursor();
        return $thread;
    }

    public function insertThread($title, $user, $content, $fname, $date){
        $this->sqlString = "INSERT INTO thread VALUES (NULL, :user, :content, :title, :fname, :date)";
        $query = $this->DBconnect->prepare($this->sqlString);
        $paramArray = array(
            'user' => $user,
            'content' => $content,
            'title' => $title,
            'fname' => $fname,
            'date' => $date
        );
        $query->execute($paramArray);
        $query->closeCursor();
    }




}

?>