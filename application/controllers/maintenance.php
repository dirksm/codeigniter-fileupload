<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Maintenance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('files_model');
        $this->load->database();
        $this->load->helper('url');
    }

	public function index() {
		$this->db->query('TRUNCATE TABLE  `files`');
	}

}