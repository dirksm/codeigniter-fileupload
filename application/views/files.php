<script>
$(document).ready(function(){
	$('.delete_file_link').live('click', function(e) {
	    e.preventDefault();
	    if (confirm('Are you sure you want to delete this file?'))
	    {
	        var link = $(this);
	        $.ajax({
	            url         : './upload/delete_file/' + link.data('file_id'),
	            dataType    : 'json',
	            success     : function (data)
	            {
	                files = $(#files);
	                if (data.status === "success")
	                {
	                    link.parents('li').fadeOut('fast', function() {
	                        $(this).remove();
	                        if (files.find('li').length == 0)
	                        {
	                            files.html('<p>No Files Uploaded</p>');
	                        }
	                    });
	                }
	                else
	                {
	                    alert(data.msg);
	                }
	            }
	        });
	    }
	});
	
});
</script>

<?php
if (isset($files) && count($files))
{
    ?>
        <ul>
            <?php
            foreach ($files as $file)
            {
                ?>
                <li class="image_wrap">
                    <a href="#" class="delete_file_link" data-file_id="<?php echo $file->id?>">Delete</a>
                    <strong><?php echo $file->title?></strong>
                    <br />
                    <?php echo $file->filename?>
                </li>
                <?php
            }
            ?>
        </ul>
    </form>
    <?php
}
else
{
    ?>
    <p>No Files Uploaded</p>
    <?php
}
?>