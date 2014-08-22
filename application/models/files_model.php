<?php
class Files_Model extends CI_Model {
 
    public function insert_file($file_path, $file_name, $file_type, $file_size)
    {
        $data = array(
        	'fkObjectId' => '1',
            'name'      => $file_name,
            'file'		=> file_get_contents($file_path),
            'file_type'		=> $file_type,
            'file_size' => filesize($file_path),
            'crc' =>  hash_file('md5', $file_path)
        );
        $this->db->insert('files', $data);
        return $this->db->insert_id();
    }

	
	public function delete_file ($id){
        $this->db->where('id', $id);
        $this->db->delete('files');
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }
	
	public function getFileList() {
		$sql = "select id, fkObjectId, name, cast(file_size/1000 as decimal(10,2)) as file_size from files where fkObjectId = '1'";
		return $this->db->query($sql)->result('array');
	}
	
	public function get($id) {
        return $this->db->get_where('files', array('id'=> $id))->row();
	}

}