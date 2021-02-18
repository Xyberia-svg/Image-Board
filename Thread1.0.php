<?php
require_once './Controls.php';
require_once './Comment.php';

$controls = new Controls();
$commentsList0 = $controls->getComments();
$commentsList = array_reverse($commentsList0);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Main page</title>
    <link href="https://bootswatch.com/4/lux/bootstrap.css" rel="stylesheet">

</head>

<body>
    <nav style="box-shadow: 2px 0px 15px 0px rgba(0,0,0,0.90)" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a style="font-size:2em" class="navbar-brand ml-5" href="#">COMMENTS PAGE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
    <div style="font-size:1.8em;text-align:center; ;width:1000px; margin:auto; margin-bottom:0; box-shadow: 2px 0px 15px 0px rgba(0,0,0,0.25); border-radius:7px; border:2px grey solid" class="jumbotron mt-5">
        Thread Here
    </div>
    <div style="width:800px; margin:0 auto 50px; padding-top: 20px;padding-bottom: 20px;box-shadow: 2px 0px 15px 0px rgba(0,0,0,0.25); border-radius:7px" class="jumbotron mt-5">
        <div style="font-size:1.6em; font-weight:900; ">Comments</div>
        <!-- COMMENTS PRINTING -->
        <?php if (count($commentsList) == 0) { ?>
            <div id="noCmnt" class="mt-5 fs-5">No comments here</div>
            <?php } else {
            foreach ($commentsList as $key => $value) { ?>
                <div style="border-radius:4px;border:1px grey solid" class="card border-primary mb-3 mt-3">
                    <div id="userPlace" class="card-header" style="font-size:20px"><?= $value->getUser() ?> <span style="font-size: 15px">replied</span> <span style="float:right; font-size:small;padding-top:7px;display:block"><?= $value->getImage()->getUpDate() ?></span></div>
                    <div class="card-body">
                        <p id="commentPlace" style="margin-left:20px" class="card-text"><?= $value->getContent() ?></p>
                        <a href="/Personal projects/Image Board Application/upload/<?= $value->getImage()->getImgName() ?>"><img class="mb-4" style="display:block;margin:auto;margin-top:40px;border-radius:4px" width="650" src="/Personal projects/Image Board Application/upload/<?= $value->getImage()->getImgName() ?>"></a>
                    </div>
                </div>

        <?php }
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
            <span><input class="btn btn-secondary mt-3 mb-3" style="display:inline-flex; float:left;width:500px" id="file" type="file" name="file"></span>
            <button style="display:inline-flex; float:right;border-radius:3px" class="btn btn-primary mt-3 mb-3" type="submit">Send</button>
        </form>
    </div>
    <div style="margin-left:30px" id="upInfo"></div>

    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="script.js"></script>

</html>