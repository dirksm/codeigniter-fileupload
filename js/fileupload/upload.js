var allDeleteButtons = $([]).add();

function getDownloadRow(id, attachid, size, name) 
{
	var deleteBtn = 'delete_'+attachid;
	var retStr = '<tr id="file_'+attachid+'"><td class="file_preview"><a href="javascript:void(0);" onclick="location.href=\''+contextPath+'upload/viewFile/'+attachid+'\'" title="View '+name+'"><img src="'+contextPath+'/images/preview.gif" border="0"/></a><\/td>';
	retStr+= '<td class="filename"><a href="javascript:void(0);" onclick="location.href=\''+contextPath+'upload/viewFile/'+attachid+'\'">' + name + '</a></td>';
	retStr+= '<td class="filesize">'+size+' KB</td>';
	retStr+= '<td class="file_delete"><button id="'+deleteBtn+'" class="btn btn-default btn-xs" title="Delete" onclick="if(confirm(\'This action will delete '+name+'.  Are you sure?\')){deleteAttachment(\''+attachid+'\')}"><span class="glyphicon glyphicon-trash"></span></button></td>';
	retStr+= '</tr>';
	return retStr;
}
function addAttachment(JQTable, id, attachid, size, name){     
	JQTable.each(function(){         
		var $table = $(this);
		var row = getDownloadRow(id, attachid, size, name);
		if($('tbody', this).length > 0){             
			$('tbody', this).append(row);         
		}else {             
			$(this).append(row);         
		}
		var idDeleteBtn = $('#delete_'+attachid);
		idDeleteBtn.attr('title', 'Remove '+name);
		allDeleteButtons.push(idDeleteBtn);
	}); 
}
function hideDeleteButtons()
{
	allDeleteButtons.each(function(){
		$(this).hide();
	});
}

function deleteAttachment(attachId)
{
	$.ajax({
		  type: "POST",
		  url: contextPath+"upload/deleteFile/"+attachId,
		  dataType: 'json'
		}).done(function( result ) {
			if(result.status == 'success') {
				$('#file_'+attachId).remove();
			} else {
				alert(result.msg);
			}
		});
}
