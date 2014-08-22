<!doctype html>
<html>
<head>
	<script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript" ></script>
	<link href="<?php echo base_url(); ?>css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>


	<script src="<?php echo base_url(); ?>js/fileupload/upload.js"></script>
	<script src="<?php echo base_url(); ?>js/fileupload/jquery.fileupload.js"></script>
	<script src="<?php echo base_url(); ?>js/fileupload/jquery.fileupload-ui.js"></script>
	<link href="<?php echo base_url(); ?>js/fileupload/jquery.fileupload-ui.css" rel="stylesheet" type="text/css"/>
    <script>
    var contextPath = '<?php echo base_url(); ?>';
	$(document).ready(function(){
	    $('#file_upload').fileUploadUI({
	        uploadTable: $('#files'),
	        downloadTable: $('#files'),
	        buildUploadRow: function (files, index) {
	            return $('<tr><td>' + files[index].name + '<\/td>' +
	                    '<td class="file_upload_progress"><div><\/div><\/td>' +
	                    '<td class="file_upload_cancel">' +
	                    '<button class="ui-state-default ui-corner-all" title="Cancel">' +
	                    '<span class="ui-icon ui-icon-cancel">Cancel<\/span>' +
	                    '<\/button><\/td><\/tr>');
	        },
	        buildDownloadRow: function (file) {
	        	if (file.status == 'success') {
			        return $(getDownloadRow(file.id, file.attachid, file.size, file.name));
	        	} else {
	        		alert(file.msg);
	        	}
	        }
	    });
<?php
	if(isset($attachments) && !empty($attachments)) {
		foreach ( $attachments as $attachment ) {
?>
		addAttachment($('#files'), '<?php echo $attachment['fkObjectId']; ?>', '<?php echo $attachment['id']; ?>', '<?php echo $attachment['file_size']; ?>', '<?php echo $attachment['name']; ?>');
<?php
}
	}
?>
		$('#idAttachmentList').show();
	});

    </script>
<style type="text/css">
	table#files {
		min-width: 50%;
	}
	body {
		padding: 15px;
		background: #FFFFFF;
	}
</style>
</head>
<body>
    <h1>Upload File</h1>
<div class="well well-lg">
		<div id="idAttachmentList" style="display:none;" >
		<fieldset>
		<legend>
		Attachments
		</legend>
		<div class="outer-well noPrint" >
				<table id="files"></table>
				<br/>
				<br/>
				<form id="file_upload" action="<?php echo base_url(); ?>upload/upload_file" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="7"/>
				    <input type="file" name="file" id="file" multiple/>
				    <button>Upload</button>
				    <div>Upload Attachments</div>
				</form>
		</div>
		</fieldset>
</div>
</body>
</html>