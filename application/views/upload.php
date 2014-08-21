<!doctype html>
<html>
<head>
	<script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript" ></script>
	<script src="<?php echo base_url(); ?>js/fileupload/upload.js"></script>
	<script src="<?php echo base_url(); ?>js/fileupload/jquery.fileupload.js"></script>
	<script src="<?php echo base_url(); ?>js/fileupload/jquery.fileupload-ui.js"></script>
	<link href="<?php echo base_url(); ?>js/fileupload/jquery.fileupload-ui.css" rel="stylesheet" type="text/css"/>
    <script>
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
		        return $(getDownloadRow(file.result.id, file.result.attachid, file.result.size, file.result.name));
	        }
	    });
		$('#idAttachmentList').show();
	});

    </script>
</head>
<body>
    <h1>Upload File</h1>
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
</body>
</html>