<!doctype html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="<?php echo base_url()?>js/site.js"></script>
    <script src="<?php echo base_url()?>js/ajaxfileupload.js"></script>
    <link href="<?php echo base_url()?>css/style.css" rel="stylesheet" />
</head>
<body>
    <h1>Upload File</h1>
    <form method="post" action="" id="upload_file">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="" />
 
        <label for="userfile">File</label>
        <input type="file" name="userfile" id="userfile" size="20" />
 
        <input type="submit" name="submit" id="submit" />
    </form>
    <h2>Files</h2>
    <div id="files"></div>
</body>
</html>