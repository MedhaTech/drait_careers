<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public $courseTypes = array("UG" => "Under Graduation", "PG" => "Post Graduation", "Ph.D" => "Ph.D");
	public $Designations = array("" => "", "1" => "Professor", "2" => "Associate Professor", "3" => "Assistant Professor");
	public $CI = NULL;

	function __construct()
	{
		parent::__construct();
		$this->CI = &get_instance();
		$this->load->model('admin_model', '', TRUE);
		$this->load->library(array('table', 'form_validation', 'pagination'));
		$this->load->helper(array('form', 'form_helper'));
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{
		$data['mainMenu'] = 'Home';
		$data['parentMenu'] = false;
		$data['recruitmentList'] = $this->admin_model->getDetailsWithDepartments('updated_on','desc','recruitment_posts');
	
		
		$this->template->show('home', $data);
	}
	public function career_detail($id)
	{
		$data['mainMenu'] = 'Home';
		$data['parentMenu'] = false;
		$data['post'] = $this->admin_model->getDetailsbyfield($id, 'slug', 'recruitment_posts')->row();
	
		
		$this->template->show('detail', $data);
	}
}
