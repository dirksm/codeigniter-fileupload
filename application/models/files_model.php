<?php
class Files_Model extends CI_Model {
 
    public function insert_file($filename, $file)
    {
        $data = array(
            'name'      => $_FILES['file']['name'],
            'file'		=> file_get_contents($_FILES['file']['tmp_name']),
            'file_type'		=> $_FILES['file']['type'],
            'file_size' => intval($_FILES['file']['size'])
        );
        $this->db->insert('files', $data);
        return $this->db->insert_id();
    }

	public function get_files()
	{
	    return $this->db->select()
	            ->from('files')
	            ->get()
	            ->result();
	} 

}