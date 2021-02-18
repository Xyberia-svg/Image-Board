<?php
require_once './Controls.php';
$ctrl = new Controls();
$arr = $ctrl->getAllThreads();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
    <link href="https://bootswatch.com/4/slate/bootstrap.css" rel="stylesheet">
    <link href="fontawesome-free-5.15.2-web\fontawesome-free-5.15.2-web\css\all.css" rel="stylesheet">
</head>

<body style="padding-bottom:100px">
    <nav style="box-shadow: 2px 0px 15px 0px rgba(0,0,0,0.90);justify-content: space-between" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a style="font-size:2em" class="navbar-brand ml-5" href="#">4chan dyal Jumia</a>
        <button style="border-radius:5px;font-size:1.2rem;float:right;text-align:center" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-plus-square fa-lg"></i> New thread</button>
    </nav>

    <div class="container">
        <div class="row w-200">
            <?php foreach ($arr as $key => $value) { ?>
                <form action="threadTemplate.php" method="GET">
                    <input hidden name="threadID" value="<?= $value->getId() ?>">
                    <div class="col">
                        <div style="top:50px;margin:40px 20px;width:300px;border-radius:5px" class="card">
                            <div style="position:absolute; background-color:rgba(0,0,0,0.70); width:100%; padding:10px"><?= $value->getTitle() ?></div>
                            <img src="/Personal projects/Image Board Application/upload/<?= $value->getImage() ?>" class="card-img-top" alt="..."">
                            <div class="card-body">
                                <p class="card-text" style="height:200px; overflow:auto; overflow-x: hidden"><?= $value->getContent() ?></p>
                            </div>
                            <button type="submit" class="btn btn-primary">View</button>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create a new thread</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="createPost.php" method="POST" enctype="multipart/form-data">
                        <textarea name="user" id="user" style="border: 2px solid black; height:50px; resize:none;background-color:white" placeholder="Enter username" class="form-control mt-1 "></textarea>
                        <textarea name="title" id="title" style="border: 2px solid black; height:50px; resize:none;background-color:white" placeholder="Enter a title" class="form-control mt-2"></textarea>
                        <textarea name="content" id="comment" style="border:1px solid black; display:inline-flex; font-size:1.3em;" placeholder="Whats on your mind ..." class="form-control mt-2"></textarea>
                        <input hidden name="MAX_FILE_SIZE" value="3000000">
                        <span><input class="btn btn-secondary mt-3 mb-3" style="display:inline-flex; float:left;" id="file" type="file" name="file"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="./dependencies/jquery-3.5.1.min.js"></script>



</html>