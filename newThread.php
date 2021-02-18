<!DOCTYPE html>
<html>
<head>
   <link href="dependencies/bootstrap.css" rel="stylesheet">
</head>
<body>
   <form action="createPost.php" method="POST" enctype="multipart/form-data" style="width:50%; margin:200px auto">
      <textarea name="user" id="user" style="border: 2px solid black; height:50px; resize:none;background-color:white" placeholder="Enter username" class="form-control mt-1 "></textarea>
      <textarea name="title" id="title" style="border: 2px solid black; height:50px; resize:none;background-color:white" placeholder="Enter a title" class="form-control mt-2"></textarea>
      <textarea name="content" id="comment" style="border:1px solid black; display:inline-flex; font-size:1.3em;" placeholder="Whats on your mind ..." class="form-control mt-2"></textarea>
      <input hidden name="MAX_FILE_SIZE" value="3000000">
      <span><input class="btn btn-secondary mt-3 mb-3" style="display:inline-flex; float:left;" id="file" type="file" name="file"></span>
      <button type="submit" class ="btn btn-primary mt-3" style="float:right">Send</button>
   </form>
</body>

</html>