<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Based on tutorial at http://code.tutsplus.com/tutorials/how-to-upload-files-with-codeigniter-and-ajax--net-21684
 * Other resources:
 * 			http://codesamplez.com/development/codeigniter-file-upload
 * 			http://www.peachpit.com/articles/article.aspx?p=1967015
 * 			https://ellislab.com/codeigniter/user-guide/libraries/file_uploading.html
 */
class Upload extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('files_model');
        $this->load->database();
        $this->load->helper('url');
    }
 
    public function index()
    {
        $this->load->view('upload');
    }

	public function upload_file()
	{
	    $status = "";
	    $msg = "";
	    $file_element_name = 'userfile';
	     
	    if (empty($_POST['title']))
	    {
	        $status = "error";
	        $msg = "Please enter a title";
	    }
	     
	    if ($status != "error")
	    {
	        $config['upload_path'] = './files/';
	        $config['allowed_types'] = 'gif|jpg|png|doc|txt';
	        $config['max_size'] = 1024 * 8;
	        $config['encrypt_name'] = TRUE;
	 
	        $this->load->library('upload', $config);
	 
	        if (!$this->upload->do_upload($file_element_name))
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors('', '');
	        }
	        else
	        {
	            $data = $this->upload->data();
	            $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
	            if($file_id)
	            {
	                $status = "success";
	                $msg = "File successfully uploaded";
	            }
	            else
	            {
	                unlink($data['full_path']);
	                $status = "error";
	                $msg = "Something went wrong when saving the file, please try again.";
	            }
	        }
	        @unlink($_FILES[$file_element_name]);
	    }
	    echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function files()
	{
	    $files = $this->files_model->get_files();
	    $this->load->view('files', array('files' => $files));
	}
	
	public function delete_file($file_id)
	{
	    if ($this->files_model->delete_file($file_id))
	    {
	        $status = 'success';
	        $msg = 'File successfully deleted';
	    }
	    else
	    {
	        $status = 'error';
	        $msg = 'Something went wrong when deleteing the file, please try again';
	    }
	    echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	public function delete_file($file_id)
	{
	    $file = $this->get_file($file_id);
	    if (!$this->db->where('id', $file_id)->delete('files'))
	    {
	        return FALSE;
	    }
	    unlink('./files/' . $file->filename);    
	    return TRUE;
	}
	 
	public function get_file($file_id)
	{
	    return $this->db->select()
	            ->from('files')
	            ->where('id', $file_id)
	            ->get()
	            ->row();
	}
	
	
	
}