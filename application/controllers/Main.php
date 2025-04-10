<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('email');
		$this->load->model('admin_model', '', TRUE);
		$this->load->model('Email_model');
	}


	function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		if ($this->form_validation->run() == FALSE) {
			$data['pageTitle'] = "Admin Login";
			$data['action'] = 'main';

			$this->login_template->show('recruitment/adminLogin', $data);
		} else {
			$username = $this->input->post('username');
			if ($username == "recruitment-admin") {
				redirect('main/admin_dashboard', 'refresh');
			} else {
				redirect('recruitment-admin', 'refresh');
			}
			// redirect('recruitment-admin/dashboard', 'refresh');
		}
	}

	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->admin_model->login($username, md5($password));

		
		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			
			return TRUE;
		} else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}

	function admin_dashboard()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";
			$this->adminrec_template->show('recruitment/adminDashboard', $data);
		} else {
			redirect('recruitment-admin', 'refresh');
		}
	}
	public function uploadImage()
	{
		header('Content-Type: application/json');
		$config['upload_path']   = './uploads/profile/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 1024;
		$new_name = time() . $_FILES["image"]['name'];
		$config['file_name'] = $new_name;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			$error = array('error' => $this->upload->display_errors());
			//  echo json_encode($error);
			redirect('recruitment/profile', 'refresh');
		} else {
			$data = $this->upload->data();
			$success = $data['file_name'];
			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['id'];
			$details = $this->admin_model->getDetails('recruitment_users', 	$id)->row();
			$pro = $details->profile_pic;

			if (!empty($success)) {
				$data = array(
					'profile_pic' => $success
				);
				$this->db->where('id', $id);
				$this->db->update('recruitment_users', $data);
				unlink('./uploads/profile/' . $pro);
			}
			json_encode($success);
			redirect('recruitment/profile', 'refresh');
		}
	}

	function preview()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";

			$data['details'] = $this->admin_model->getDetails('recruitment_users', $id)->row();

			$data['education'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_education_details')->result();
			$data['research'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_research_exp')->result();
			$data['publications'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_publications_details')->result();
			$data['teaching'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_teaching_experience')->result();
			$data['industrial'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_industrial_experience')->result();

			$this->rec_template->show('recruitment/print', $data);
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function faculty_applications($id = '')
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "JOB APPLICATIONS ";
			$data['activeMenu'] = "faculty_applications";


			//	$this->admin_model->getDetails('recruitment_users',false)->result();
			$staffList = 	$this->admin_model->getApplicantsByPost($id);

			// print_r($facultyList);
			if ($staffList != null) {
				$table_setup = array('table_open' => '<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">');
				$this->table->set_template($table_setup);
				$this->table->set_heading(
					array('data' => 'No', 'width' => "2%"),
					array('data' => 'Appln. No.', 'width' => "10%"),
					array('data' => 'Name', 'width' => "15%"),
					array('data' => 'Department', 'width' => "15%"),
					array('data' => 'Applied Post', 'width' => "10%"),
					array('data' => 'Mobile', 'width' => "10%"),
					array('data' => 'Email', 'width' => "10%"),
					array('data' => 'Date', 'width' => "10%"),
					array('data' => 'Scrutiny Status', 'width' => "5%"),
					array('data' => 'Actions', 'width' => "10%")
				);
				$i = 1;
				foreach ($staffList as $staffList1) {

					if ($staffList1->profile_pic) {

						$img = base_url() . 'uploads/profile/' . $staffList1->profile_pic;
					} else {
						$img = 'http://via.placeholder.com/160x160';
					}
					
					if($staffList1->scrutinity=='0')
					{
					    $scr="Pending";
					    $btn='<a href="' . base_url() . 'main/faculty_applications_change_status/' . $staffList1->id . '/'.$id.'" " class="btn btn-primary btn-sm "  title="Change scrutinity status"><i class="fas fa-fw fa-check"></i> </a>';
					}
					else
					{
					    $scr="Completed";
					     $btn='';
					}
					$this->table->add_row(
						$i++,
						$staffList1->application,
						'<img src="' . $img . '" class="profile-pic">' . $staffList1->candidate_name,
						$staffList1->department,
						$staffList1->post_of,
						$staffList1->mobile,
						wordwrap($staffList1->email,10,"<br>\n",TRUE),
						date('d-m-Y', strtotime($staffList1->payment_date)),
						$scr,
						$btn.'<a href="' . base_url() . 'main/faculty_applications_view/' . $staffList1->id . '" class="btn btn-success btn-sm " title="View Application"><i class="fas fa-fw fa-eye"></i></a>'
					);
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['table'] = '<div class="text-center mb-5 mt-5 pb-5 pt-5"> <h2> No details found..! </h2> </div>';
			}
			$this->adminrec_template->show('recruitment/faculty_applications', $data);
		} else {
			redirect('main', 'refresh');
		}
	}
	
function	faculty_applications_change_status($staff,$job)
{
          $data = array(
                'scrutinity' => '1'
            );
            $this->db->where('id', $staff);
         $this->db->update('recruitment_users', $data);
 redirect('main/faculty_applications/'.$job, 'refresh');
         
}
	function faculty_applications_view($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];

			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";

			$data['details'] = $this->admin_model->getDetails('recruitment_users', $id)->row();

			$data['education'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'faculty_education_details')->result();
			$data['research'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'faculty_research_exp_details')->result();
			$data['publications'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'faculty_publications_details')->result();
			$data['teaching'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'faculty_teaching_experience_details')->result();
			$data['industrial'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'faculty_industrial_experience')->result();
			$data['affiliations'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'recruitment_affiliations')->result();
			$data['references'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'recruitment_references')->result();
			$data['documents'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'recruitment_documents')->result();
			$data['langs'] = $this->admin_model->getDetailsbyfield($id, 'user_id', 'recruitment_languages')->result();
			
			if($data['details']->post_of=="Non-Teaching")
			{
				$this->adminrec_template->show('recruitment/view_print_non', $data);
			}
			elseif($data['details']->post_of=="Librarian")
			{
				$this->adminrec_template->show('recruitment/view_print_lib', $data);
			}
			else
			{
				$this->adminrec_template->show('recruitment/view_print', $data);
			}
			
			


		} else {
			redirect('main', 'refresh');
		}
	}



	function changePassword()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Change Password";
			$data['activeMenu'] = "changePassword";

			$this->form_validation->set_rules('oldPassword', 'Old Password', 'required');
			$this->form_validation->set_rules('newPassword', 'New Password', 'required');
			if ($this->form_validation->run() === FALSE) {
				$data['Details'] = $this->admin_model->getDetailsbyfield($data['username'], 'username', 'logins')->row();
				$data['oldPassword'] = '';
				$data['newPassword'] = '';
				$data['action'] = 'main/changePassword/';
				$this->adminrec_template->show('recruitment/changePassword', $data);
			} else {
				$oldPassword = $this->input->post('oldPassword');
				$newPassword = $this->input->post('newPassword');

				if ($oldPassword == $newPassword) {
					$this->session->set_flashdata('message', '<h5 class="text-success">Old and New Password should not be same...!</h5>');
				} else {
					$updateDetails = array('password' => md5($newPassword));
					$result = $this->admin_model->adminPassword($data['username'], $oldPassword, $updateDetails);

					// var_dump($this->db->last_query());
					// die();
					if ($result) {
						$this->session->set_flashdata('message', '<h5 class="text-success">Password udpated successfully...!</h5>');
					} else {
						$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
					}
				}

				redirect('/main/changePassword', 'refresh');
			}
		} else {
			redirect('main', 'refresh');
		}
	}


	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('recruitment-admin', 'refresh');
	}


	function jobposts()
	{ 
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Job Post";
			$data['activeMenu'] = "departments";

			$recruitmentList = $this->admin_model->getDetailsbySort('updated_on','desc','recruitment_posts')->result();
			if ($recruitmentList != null) {

				$table_setup = array('table_open' => '<table class="table table-bordered table-hover" id="dataTable1" width="100%" cellspacing="0">');
				$this->table->set_template($table_setup);
				// $cell = array('data' => 'Blue', 'class' => 'highlight', 'colspan' => 2);
				$this->table->set_heading(
					array('data' => 'S.No', 'width' => '5%'),
					array('data' => 'title', 'width' => '25%'),
					array('data' => 'Posted Date', 'width' => '10%'),
					array('data' => 'Application Type', 'width' => '10%'),
					array('data' => 'Academic Year', 'width' => '10%'),
					array('data' => 'Fee', 'width' => '10%'),
					array('data' => 'Status', 'width' => '10%'),
					array('data' => 'Actions', 'width' => '30%')
				);
				$i = 1;
				foreach ($recruitmentList as $recruitmentList1) {


					$this->table->add_row(
						$i++,
						$recruitmentList1->title,
						date("d/m/Y", strtotime($recruitmentList1->updated_on)),
						$recruitmentList1->type,
						$recruitmentList1->ay,
						$recruitmentList1->fee,
						($recruitmentList1->status == "1") ? 'Active' : 'Inactive',
						anchor('main/editjobpost/' . $recruitmentList1->id, '<i class="fas fa-pencil"></i> Edit', 'class="btn btn-danger btn-sm"') . '&nbsp;' .
							anchor('main/faculty_applications/' . $recruitmentList1->id, '<i class="fas fa-eye"></i> View Applications', 'class="btn btn-primary btn-sm"')

					);
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['table'] = '<div class="text-center mb-5 mt-5 pb-5 pt-5"> <h2> No details found..! </h2> </div>';
			}

			$this->adminrec_template->show('recruitment/Jobposts', $data);
		} else {
			redirect('main', 'refresh');
		}
	}

	function addjobpost()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Add Post";
			$data['activeMenu'] = "system";
			$data['departments_list'] =  $this->admin_model->getDetailsbyfield('1', 'status', 'recruitment_departments')->result();
			// var_dump($this->db->last_query());
			// $this->form_validation->set_rules('dept_id', 'Department', 'required');
			$this->form_validation->set_rules('type', 'Application Type', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('ay', 'Academic Year', 'required');
			$this->form_validation->set_rules('fee', 'Application Fee', '');
			$this->form_validation->set_rules('departments[]', 'Departments', 'required');
			if ($this->form_validation->run() === FALSE) {
				$data['action'] = 'main/addjobpost/';

				//  $data['dept_id'] = $this->input->post('dept_id');
				$data['type'] = $this->input->post('type');
				$data['title'] = $this->input->post('title');
				$data['ay'] = $this->input->post('ay');
				$data['slug'] = create_slug($this->input->post('title'));
				$data['description'] = $this->input->post('description');
				$data['status'] = $this->input->post('status');
				$this->adminrec_template->show('recruitment/addjobpost', $data);
			} else {
				$status = ($this->input->post('status')) ? 1 : 0;
				$departments = $this->input->post('departments');

				// Convert the options array to a comma-separated string
				$departments_str = implode(',', $departments);
				$insertDetails = array(
					'title' => $this->input->post('title'),
					'slug' => create_slug($this->input->post('title')),
					'type' => $this->input->post('type'),
					'ay' => $this->input->post('ay'),
					'fee' => $this->input->post('fee'),
					'description' => $this->input->post('description'),
					'departments' => $departments_str,
					'status' => $status,
					'updated_on' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('recruitment_posts', $insertDetails);


				if ($result) {
					$this->session->set_flashdata('message', '<h5 class="text-success">Details added successfully...!</h5>');
				} else {
					$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
				}

				redirect('main/jobposts', 'refresh');
			}
		} else {
			redirect('main', 'refresh');
		}
	}

	function editjobpost($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Edit Post";
			$data['activeMenu'] = "system";
			$data['departments_list'] =  $this->admin_model->getDetailsbyfield('1', 'status', 'recruitment_departments')->result();

			// $this->form_validation->set_rules('dept_id', 'Department', 'required');
			$this->form_validation->set_rules('type', 'Application Type', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('ay', 'Academic Year', 'required');
			$this->form_validation->set_rules('fee', 'Application Fee', 'required');
			if ($this->form_validation->run() === FALSE) {

				$data['details'] = $this->admin_model->getDetails('recruitment_posts', $id)->row();
				$data['action'] = 'main/editjobpost/' . $id;

				$this->adminrec_template->show('recruitment/editjobpost', $data);
			} else {
				$status = ($this->input->post('status')) ? 1 : 0;
				$departments = $this->input->post('departments');

				// Convert the options array to a comma-separated string
				$departments_str = implode(',', $departments);
				$insertDetails = array(
					'title' => $this->input->post('title'),
					'slug' => create_slug($this->input->post('title')),
					'type' => $this->input->post('type'),
					'ay' => $this->input->post('ay'),
					'fee' => $this->input->post('fee'),
					'description' => $this->input->post('description'),
					'departments' => $departments_str,
					'status' => $status
				);
				// $result = $this->admin_model->insertDetails('recruitment_posts', $insertDetails);
				$result = $this->admin_model->updateDetails($id, $insertDetails, 'recruitment_posts');
				// var_dump($this->db->last_query());
				// die();

				if ($result) {
					$this->session->set_flashdata('message', '<h5 class="text-success">Details added successfully...!</h5>');
				} else {
					$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
				}

				redirect('main/jobposts', 'refresh');
			}
		} else {
			redirect('main', 'refresh');
		}
	}


	function getAcademicYears($id = false)
	{
		$return = array();
		if (!$id) {
			$acList = $this->admin_model->getDetails('academic_year', $id)->result();
			foreach ($acList as $acList1) {
				$return[$acList1->id] = $acList1->academic_year;
			}
			return $return;
		} else {
			$acList = $this->admin_model->getDetails('academic_year', $id)->row();
			$return = $acList->academic_year;
			return $return;
		}
	}


	function getpost()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$acList = $this->admin_model->getDetailsbyfield1($this->input->post('type'), 'type','1','status', 'recruitment_posts')->result();
			echo "<option>- Select -</option>";
			foreach ($acList as $acList1) {
				echo "<option value=" . $acList1->id . ">$acList1->title</option>";
			}
		} else {
			redirect('main', 'refresh');
		}
	}

	function getdepartment()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$post = $this->admin_model->getDetails('recruitment_posts', $this->input->post('id'))->row();
			$departments_str = explode(',', $post->departments);
			$this->db->select('*');
			$this->db->from('recruitment_departments');
			// $this->db->where_in('id', $departments_str);
			$query = $this->db->get();
			$acList = $query->result();
			
			// $acList = $this->admin_model->getDetailsbyfield($this->input->post('type'), 'type', 'recruitment_posts')->result();
			echo "<option>- Select -</option>";
			foreach ($acList as $acList1) {
				echo "<option value=" . $acList1->department_name . ">$acList1->department_name</option>";
			}
		} else {
			redirect('main', 'refresh');
		}
	}
	
	function faculty_applications1($id = '')
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "JOB APPLICATIONS ";
			$data['activeMenu'] = "faculty_applications";


			//	$this->admin_model->getDetails('recruitment_users',false)->result();
			$staffList = 		$this->db->where(array('payment_status' => '1', 'post_id' => $id))->order_by("application", "asc")->from("recruitment_users")->get()->result();;

			// print_r($facultyList);
			if ($staffList != null) {
			
				$data['table'] = $staffList;
			} else {
				$data['table'] = '';
			}
			$this->adminrec_template->show('recruitment/faculty_applications1', $data);
		} else {
			redirect('main', 'refresh');
		}
	}
}
