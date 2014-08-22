<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Based on tutorial at http://code.tutsplus.com/tutorials/how-to-upload-files-with-codeigniter-and-ajax--net-21684
 * Other resources:
 * 			http://codesamplez.com/development/codeigniter-file-upload
 * 			http://www.peachpit.com/articles/article.aspx?p=1967015
 * 			https://ellislab.com/codeigniter/user-guide/libraries/file_uploading.html
 */
class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('files_model');
        $this->load->database();
        $this->load->helper('url');
    }
 
    public function index()
    {
    	$data['attachments'] = $this->files_model->getFileList();
        $this->load->view('upload', $data);
    }

	public function upload_file()
	{
	    $status = "";
	    $msg = "";
	    $file_element_name = 'file';
	     	     
	    if ($status != "error")
	    {
	        $config['upload_path'] = './files/';
	        $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|jpeg|xls|docx|xlsx';
	        $config['max_size'] = 1024 * 8;
	        $config['encrypt_name'] = FALSE;
	 
	        $this->load->library('upload', $config);
	 
	        if (!$this->upload->do_upload($file_element_name))
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors('', '');
	        }
	        else
	        {
	            $data = $this->upload->data();
	            $file_id = $this->files_model->insert_file($data['full_path'], $data['file_name'], $data['file_type'], $data['file_size']);
	            if($file_id)
	            {
	                $status = "success";
	                $msg = "File successfully uploaded";
	            }
	            else
	            {
	                $status = "error";
	                $msg = "Something went wrong when saving the file, please try again.";
	            }
	            $size = filesize($data['full_path'])/1000;
	            unlink($data['full_path']);
	        }
	    }
	    echo json_encode(array('status'=>$status, 'msg'=>$msg, 'attachid' => $file_id, 'id' => '1', 'name' => $data['file_name'], 'type'=> $data['file_type'], 'size' => $size));
	}
	
	public function deleteFile($file_id)
	{
	    if ($this->files_model->delete_file($file_id))
	    {
	        $status = 'success';
	        $msg = 'File successfully deleted';
	    }
	    else
	    {
	        $status = 'error';
	        $msg = 'Something went wrong when deleting the file, please try again';
	    }
	    echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	public function viewFile($fileId) {
		$file = $this->files_model->get($fileId);
		if ( $file != null ) {
			header("Content-Type: ".$file->file_type);
			header("Content-Length: ".$file->file_size);
			header("Content-Disposition: attachment; filename=".$file->name);
			echo $file->file;
		}
	}
	
	public function clearFiles() {
		$this->db->query('TRUNCATE TABLE  `files`');
	}

	
}