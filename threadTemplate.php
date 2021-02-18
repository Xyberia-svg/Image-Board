<?php
session_start();
require_once './Controls.php';
$ctrl = new Controls();

if (isset($_SESSION['threadArr'])) {
  $thread = $_SESSION['threadArr'];
  $threadUser = $thread['user'];
  $threadTitle = $thread['title'];
  $threadContent = $thread['content'];
  $threadImage = $thread['fname'];
  $threadDate = $thread['date'];
}
if (isset($_GET['threadID'])) {

  $thread = $ctrl->getThreadByID($_GET['threadID']);
  $threadUser = $thread->getUser();
  $threadTitle = $thread->getTitle();
  $threadContent = $thread->getContent();
  $threadImage = $thread->getImage();
  $threadDate = $thread->getDate();
  $cmtsArr = $ctrl->getCommentsByID($_GET['threadID']);
  $cmtsArr = array_reverse($cmtsArr);
}

?>

<!DOCTYPE html>
<html>

<head>
  <title><?= $threadTitle ?></title>
  <link href="https://bootswatch.com/4/slate/bootstrap.css" rel="stylesheet">
</head>

<body>
  <nav style="box-shadow: 2px 0px 15px 0px rgba(0,0,0,0.90)" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a style="font-size:2em" class="navbar-brand ml-5" href="homePage.php">4chan dyal Jumia</a>

  </nav>
  <div style="font-size:1.8em; ;width:1000px;padding:0; margin:auto; margin-bottom:0; box-shadow: 2px 0px 15px 0px rgba(0,0,0,0.25); border-radius:7px; border:2px grey solid" class="jumbotron mt-5">
      <div id="userPlace" class="card-header" style="font-size:20px;margin:0"><?= $threadUser ?> <span style="font-size: 15px">posted</span><span style="float:right;font-size:small;padding-top:7px;display:block""><?= $threadDate ?></span></div>
      <div id="titlePlace" style="font-size:30px; margin:20px 20px 10px;padding-left:20px;font-weight:700"><?= $threadTitle ?></div>
      <div class="card-body" style="padding-top:0">
        <p id="commentPlace" style="margin:0 20px;font-size:smaller;padding:0px" class="card-text"><?= $threadContent ?></p>
        <a href="/Personal projects/Image Board Application/upload/<?= $threadImage ?>"><img class="mb-4" style="display:block;margin:auto;margin-top:40px;border-radius:4px" width="650" src="/Personal projects/Image Board Application/upload/<?= $threadImage ?>"></a>
      </div>
  </div>
  <div style="width:800px; margin:0 auto 50px; padding-top: 20px;padding-bottom: 20px;box-shadow: 2px 0px 15px 0px rgba(0,0,0,0.25); border-radius:7px" class="jumbotron mt-5">
    <div style="font-size:1.6em; font-weight:900; ">Comments</div>
    <!-- COMMENTS PRINTING -->
    <?php if (isset($_GET['threadID'])) {
      if (count($cmtsArr) == 0) { ?>
        <div id="noCmnt" class="mt-5 fs-5">No comments here</div>
        <?php } else {
        foreach ($cmtsArr as $key => $value) { ?>
          <div style="border-radius:4px;border:1px grey solid" class="card border-primary mb-3 mt-3">
            <div id="userPlace" class="card-header" style="font-size:20px"><?= $value->getUser() ?> <span style="font-size: 15px">replied</span><span style="float:right;font-size:small;padding-top:7px;display:block""><?= $value->getDate() ?></span> </div>
            <div class="card-body">
              <p id="commentPlace" style="margin-left:20px" class="card-text"><?= $value->getContent() ?></p>
              <a href="/Personal projects/Image Board Application/upload/<?= $value->getImage() ?>"><img class="mb-4" style="display:block;margin:auto;margin-top:40px;border-radius:4px" width="650" src="/Personal projects/Image Board Application/upload/<?= $value->getImage() ?>"></a>
            </div>
          </div>

    <?php }
      }
    } ?>
    <!-- END OF COMMENTS PRINTING -->
    <!-- AJAX COMMENT HERE -->
    <div id="comments">
    </div>
    <!-- END OF AJAX COMMENT -->


    <div style="width:700px; margin:auto; margin-bottom:100px">
      <form id="replyForm" enctype="multipart/form-data">
        <textarea name="user" id="user" style="border: 2px solid black; height:50px; resize:none;background-color:white" placeholder="Enter username" class="form-control mt-5"></textarea>
        <textarea name="comment" id="comment" style="border:1px solid black; display:inline-flex; font-size:1.3em;" placeholder="Whats on your mind ..." class="form-control mt-1"></textarea>
        <input hidden name="MAX_FILE_SIZE" value="3000000">
        <input hidden name="threadID" value="<?php if (isset($_GET['threadID'])) {
                                                echo $_GET['threadID'];
                                              } ?>">
        <span><input class="btn btn-secondary mt-3 mb-3" style="display:inline-flex; float:left;width:500px" id="file" type="file" name="file"></span>
        <button style="display:inline-flex; float:right;border-radius:3px" class="btn btn-primary mt-3 mb-3" type="submit">Send</button>
      </form>
    </div>
    <div style="margin-left:30px" id="upInfo"></div>

  </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="./dependencies/jquery-3.5.1.min.js"></script>
<script src="script.js"></script>

</html>
<?php unset($_SESSION) ?>