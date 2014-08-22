var allDeleteButtons = $([]).add();

function getDownloadRow(id, attachid, size, name) 
{
	var deleteBtn = 'delete_'+attachid;
	var retStr = '<tr id="file_'+attachid+'"><td class="file_preview"><a href="javascript:void(0);" onclick="location.href=\''+contextPath+'/violation/getAttachment.do?id='+attachid+'\'" title="View '+name+'"><img src="'+contextPath+'/images/preview.gif" border="0"/></a><\/td>';
	retStr+= '<td class="filename"><a href="javascript:void(0);" onclick="location.href=\''+contextPath+'/violation/getAttachment.do?id='+attachid+'\'">' + name + '</a></td>';
	retStr+= '<td class="filesize">'+size+'</td>';
	retStr+= '<td class="file_delete"><button id="'+deleteBtn+'" class="ui-state-default ui-corner-all" title="Delete" onclick="if(confirm(\'This action will delete '+name+'.  Are you sure?\')){deleteAttachment(\''+attachid+'\')}"><i class="icon-trash"></i></button></td>';
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
//		alert('adding ' + idDeleteBtn.val() + ' to allDeleteButtons. Size: ' + allDeleteButtons.length);
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
		  url: contextPath+"/violation/deleteAttachment.do",
		  data: {id : attachId}
		}).done(function( result ) {
			$('#file_'+attachId).remove();
		});
}
