<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Recruitment extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model', '', TRUE);

		$this->load->model('Email_model');
		$this->load->library(array('table', 'form_validation', 'upload'));
		$this->load->helper(array('form', 'form_helper'));
		date_default_timezone_set('Asia/Kolkata');
		ini_set('upload_max_filesize', '100M');

		// require_once APPPATH.'third_party/PHPExcel.php';
		// $this->excel = new PHPExcel(); 
	}

	function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		if ($this->form_validation->run() == FALSE) {
			$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
			$data['action'] = 'recruitment';

			$this->rec_template->show('recruitment/login', $data);
		} else {

			if ($this->session->userdata('logged_in')) {

				$session_data = $this->session->userdata('logged_in');
				$data['id'] = $session_data['id'];
				$details = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			}
			// if ($details->payment_status == 1) {
			// 	redirect('recruitment/print', 'refresh');
			// } else {
			redirect('recruitment/dashboard', 'refresh');
			// }
		}
	}

	function register()
	{
		$this->form_validation->set_rules('candidate_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[recruitment_users.email]');
		$this->form_validation->set_rules('mobile', 'Mobile number', 'required|is_unique[recruitment_users.mobile]');
		$this->form_validation->set_rules('post_of', 'Application Type', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
			$data['action'] = 'recruitment/register';

			$this->rec_template->show('recruitment/register', $data);
		} else {
			$token = $this->generate_unique_id();
			$insertDetails = array(
				'candidate_name' => $this->input->post('candidate_name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'email_verified' => '1',
				'post_of' => $this->input->post('post_of'),
				'password' => md5($this->input->post('password')),
				'reg_date' => date('Y-m-d H:i:s'),
				'token' => $token
			);

			$result = $this->admin_model->insertDetails('recruitment_users', $insertDetails);

			if ($result) {
				$data['res'] = 1;
				$data['token'] = $token;
				$to = $this->input->post('email');

				// $this->Email_model->send_email($to,$data,'activation');
			} else {
				$data['res'] = 0;
			}

			$this->rec_template->show('recruitment/register_res', $data);
		}
	}

	function test()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World !');

		$writer = new Xlsx($spreadsheet);
		$filename = 'Report';
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		$email = $this->input->post('email');

		//query the database
		$result = $this->admin_model->rec_user_login($email, md5($password));

		if ($result) {
			$poststat = $this->admin_model->get_post_status($result->post_id);


			if ($result->email_verified == 0) {
				$this->form_validation->set_message('check_database', 'Please verify your email first.');
				return false;
			} else {
				if ($poststat->status == 1 || $poststat->status == '') {
					$sess_array = array();

					$sess_array = array(
						'id' => $result->id,
						'candidate_name' => $result->candidate_name,
						'email' => $result->email,
						'mobile' => $result->mobile
					);
					$this->session->set_userdata('logged_in', $sess_array);

					return TRUE;
				} elseif ($result->payment_status == 1) {
					$sess_array = array();

					$sess_array = array(
						'id' => $result->id,
						'candidate_name' => $result->candidate_name,
						'email' => $result->email,
						'mobile' => $result->mobile
					);
					$this->session->set_userdata('logged_in', $sess_array);

					return TRUE;
				} else {
					$this->form_validation->set_message('check_database', 'The online application has been closed as the last date has been met.');
					return false;
				}
			}
		} else {
			$this->form_validation->set_message('check_database', 'Invalid email or password');
			return false;
		}
	}

	function profile()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();



			if (isset($_REQUEST['flag'])) {

				if ($_REQUEST['flag'] > $data['user_data']->menu_flag) {
					$this->Email_model->update_menu_flag($data['id'], $_REQUEST['flag']);
				}
			}
			$data['details'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['education'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_education_details')->result();
			$data['research'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_research_exp_details')->result();
			$data['publications'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_publications_details')->result();
			$data['teaching'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_teaching_experience_details')->result();
			$data['industrial'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_industrial_experience')->result();
			$data['affiliations'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_affiliations')->result();
			$data['references'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_references')->result();
			$data['documents'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_documents')->result();
			$data['langs'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_languages')->result();
			$data['projects'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'sponsored_projects')->result();
			$data['consultancy'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'consultancy_undertaken')->result();
			$data['membership'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'professional_membership')->result();
			$data['seminars'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'seminars_workshops_courses')->result();
			$data['patents'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'user_patents')->result();
			// if ($data['details']->post_of && $data['details']->department) {

			if ($data['details']->post_of == "Non-Teaching") {
				$this->rec_template->show('recruitment/profile-non', $data);
			} else {
				$this->rec_template->show('recruitment/profile', $data);
			}
			// } else {
			// 	$data['action'] = 'recruitment/apply_for';
			// 	$this->rec_template->show('recruitment/apply_for', $data);
			// }
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function dashboard()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();

			$data['recruitmentList'] = $this->admin_model->getDetailsWithDepartments('updated_on', 'desc', 'recruitment_posts');
			$data['appliedList'] = $this->admin_model->applied_jobs($data['id']);
			if (isset($_REQUEST['flag'])) {

				if ($_REQUEST['flag'] > $data['user_data']->menu_flag) {
					$this->Email_model->update_menu_flag($data['id'], $_REQUEST['flag']);
				}
			}
			$data['details'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['education'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_education_details')->result();
			$data['research'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_research_exp_details')->result();
			$data['publications'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_publications_details')->result();
			$data['teaching'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_teaching_experience_details')->result();
			$data['industrial'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_industrial_experience')->result();
			$data['affiliations'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_affiliations')->result();
			$data['references'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_references')->result();
			$data['documents'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_documents')->result();
			$data['langs'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_languages')->result();
			$data['projects'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'sponsored_projects')->result();
			$data['consultancy'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'consultancy_undertaken')->result();
			$data['membership'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'professional_membership')->result();
			$data['seminars'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'seminars_workshops_courses')->result();
			// if ($data['details']->post_of && $data['details']->department) {


			$this->rec_template->show('recruitment/dashboard', $data);
			// } else {
			// 	$data['action'] = 'recruitment/apply_for';
			// 	$this->rec_template->show('recruitment/apply_for', $data);
			// }
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function career($slug)
	{
		if ($this->session->userdata('logged_in')) {

			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();

			$data['recruitmentList'] = $this->admin_model->getDetailsWithDepartments('updated_on', 'desc', 'recruitment_posts');

			if (isset($_REQUEST['flag'])) {

				if ($_REQUEST['flag'] > $data['user_data']->menu_flag) {
					$this->Email_model->update_menu_flag($data['id'], $_REQUEST['flag']);
				}
			}
			$data['details'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['education'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_education_details')->result();
			$data['research'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_research_exp_details')->result();
			$data['publications'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_publications_details')->result();
			$data['teaching'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_teaching_experience_details')->result();
			$data['industrial'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_industrial_experience')->result();
			$data['affiliations'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_affiliations')->result();
			$data['references'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_references')->result();
			$data['documents'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_documents')->result();
			$data['langs'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_languages')->result();
			$data['projects'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'sponsored_projects')->result();
			$data['consultancy'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'consultancy_undertaken')->result();
			$data['membership'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'professional_membership')->result();
			$data['seminars'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'seminars_workshops_courses')->result();
			$data['post'] = $this->admin_model->getDetailsbyfield($slug, 'slug', 'recruitment_posts')->row();
			$this->rec_template->show('recruitment/career', $data);
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function apply_for()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('post_of', 'Application Type', 'trim|required');
			$this->form_validation->set_rules('department', 'Department', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/apply_for';

				$this->rec_template->show('recruitment/apply_for', $data);
			} else {

				$updateDetails = array(
					'post_of' => $this->input->post('post_of'),
					'department' => str_replace('_', ' ', $this->input->post('department')),
					'updated_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->updateDetails($data['id'], $updateDetails, 'recruitment_users');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/profile', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function manageEducation()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Education";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('program', 'Program', 'required');
			$this->form_validation->set_rules('program_type', 'Program Type', 'required');
			$this->form_validation->set_rules('year_of_passing', 'Year of Passing', 'required');
			$this->form_validation->set_rules('degree', 'Degree', 'required');
			$this->form_validation->set_rules('specialization', 'Specialization', 'required');
			$this->form_validation->set_rules('university_name', 'University Name', 'required');
			$this->form_validation->set_rules('marks_percentage', 'Percentage of Marks', 'required');
			$this->form_validation->set_rules('class_awarded', 'Class Awarded', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/manageEducation';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_education_details')->result();

				$this->rec_template->show('recruitment/manage_education', $data);
			} else {

				$insertDetails = array(
					'user_id' => $data['id'],
					'program' => $this->input->post('program'),
					'degree' => $this->input->post('degree'),
					'specialization' => $this->input->post('specialization'),
					'university_name' => $this->input->post('university_name'),
					'year_of_passing' => $this->input->post('year_of_passing'),
					'program_type' => $this->input->post('program_type'),
					'marks_percentage' => $this->input->post('marks_percentage'),
					'class_awarded' => $this->input->post('class_awarded'),
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('faculty_education_details', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageEducation', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updateEducation($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Education";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('program', 'Program', 'required');
			$this->form_validation->set_rules('program_type', 'Program Type', 'required');
			$this->form_validation->set_rules('year_of_passing', 'Year of Passing', 'required');
			$this->form_validation->set_rules('degree', 'Degree', 'required');
			$this->form_validation->set_rules('specialization', 'Specialization', 'required');
			$this->form_validation->set_rules('university_name', 'University Name', 'required');
			$this->form_validation->set_rules('marks_percentage', 'Percentage of Marks', 'required');
			$this->form_validation->set_rules('class_awarded', 'Class Awarded', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateEducation/' . $id;

				$data['details'] = $this->admin_model->getDetails('faculty_education_details', $id)->row();

				$this->rec_template->show('recruitment/update_education', $data);
			} else {

				$updateDetails = array(
					'program' => $this->input->post('program'),
					'degree' => $this->input->post('degree'),
					'specialization' => $this->input->post('specialization'),
					'university_name' => $this->input->post('university_name'),
					'year_of_passing' => $this->input->post('year_of_passing'),
					'program_type' => $this->input->post('program_type'),
					'marks_percentage' => $this->input->post('marks_percentage'),
					'class_awarded' => $this->input->post('class_awarded')
				);

				$result = $this->admin_model->updateDetails($id, $updateDetails, 'faculty_education_details');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageEducation', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deleteEducation($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Education";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('faculty_education_details', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/manageEducation', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function manageResearch()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Research";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('institution', 'Institution', 'required');
			$this->form_validation->set_rules('area_of_research', 'Area of Research', 'required');
			$this->form_validation->set_rules('exp_from', 'Exp From', 'required');
			$this->form_validation->set_rules('exp_to', 'Exp To', 'required');
			$this->form_validation->set_rules('total', 'Total', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/manageResearch';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_research_exp_details')->result();

				$this->rec_template->show('recruitment/manage_research', $data);
			} else {

				$insertDetails = array(
					'user_id' => $data['id'],
					'institution' => $this->input->post('institution'),
					'area_of_research' => $this->input->post('area_of_research'),
					'exp_from' => $this->input->post('exp_from'),
					'exp_to' => $this->input->post('exp_to'),
					'total' => $this->input->post('total'),
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('faculty_research_exp_details', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageResearch', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updateResearch($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Research";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('institution', 'Institution', 'required');
			$this->form_validation->set_rules('area_of_research', 'Area of Research', 'required');
			$this->form_validation->set_rules('exp_from', 'Exp From', 'required');
			$this->form_validation->set_rules('exp_to', 'Exp To', 'required');
			$this->form_validation->set_rules('total', 'Total', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateResearch/' . $id;

				$data['details'] = $this->admin_model->getDetails('faculty_research_exp_details', $id)->row();

				$this->rec_template->show('recruitment/update_research', $data);
			} else {

				$updateDetails = array(
					'institution' => $this->input->post('institution'),
					'area_of_research' => $this->input->post('area_of_research'),
					'exp_from' => $this->input->post('exp_from'),
					'exp_to' => $this->input->post('exp_to'),
					'total' => $this->input->post('total')
				);

				$result = $this->admin_model->updateDetails($id, $updateDetails, 'faculty_research_exp_details');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageResearch', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deleteResearch($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Research";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('faculty_research_exp_details', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/manageResearch', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function managePublications()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Publications";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('publication_type', 'Publication Type', 'required');
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_rules('title_of_paper', 'Title of Paper', 'required');
			$this->form_validation->set_rules('publication_date', 'Publication Date', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/managePublications';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_publications_details')->result();

				$this->rec_template->show('recruitment/manage_publications', $data);
			} else {

				$insertDetails = array(
					'user_id' => $data['id'],
					'publication_type' => $this->input->post('publication_type'),
					'category' => $this->input->post('category'),
					'title_of_paper' => $this->input->post('title_of_paper'),
					'publication_date' => $this->input->post('publication_date'),
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('faculty_publications_details', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/managePublications', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updatePublication($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Research";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('publication_type', 'Publication Type', 'required');
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_rules('title_of_paper', 'Title of Paper', 'required');
			$this->form_validation->set_rules('publication_date', 'Publication Date', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updatePublication/' . $id;

				$data['details'] = $this->admin_model->getDetails('faculty_publications_details', $id)->row();

				$this->rec_template->show('recruitment/update_publications', $data);
			} else {

				$updateDetails = array(
					'publication_type' => $this->input->post('publication_type'),
					'category' => $this->input->post('category'),
					'title_of_paper' => $this->input->post('title_of_paper'),
					'publication_date' => $this->input->post('publication_date')
				);

				$result = $this->admin_model->updateDetails($id, $updateDetails, 'faculty_publications_details');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/managePublications', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deletePublication($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Publications";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('faculty_publications_details', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/managePublications', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function manageTeaching()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Teaching";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('institution', 'Institution', 'required');
			$this->form_validation->set_rules('designation', 'Designation', 'required');
			$this->form_validation->set_rules('period_from', 'Period From', 'required');
			$this->form_validation->set_rules('period_to', 'Period To', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/manageTeaching';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_teaching_experience_details')->result();

				$this->rec_template->show('recruitment/manage_teaching', $data);
			} else {

				$insertDetails = array(
					'user_id' => $data['id'],
					'institution' => $this->input->post('institution'),
					'designation' => $this->input->post('designation'),
					'period_from' => $this->input->post('period_from'),
					'period_to' => $this->input->post('period_to'),
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('faculty_teaching_experience_details', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageTeaching', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updateTeaching($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Research";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('institution', 'Institution', 'required');
			$this->form_validation->set_rules('designation', 'Designation', 'required');
			$this->form_validation->set_rules('period_from', 'Period From', 'required');
			$this->form_validation->set_rules('period_to', 'Period To', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateTeaching/' . $id;

				$data['details'] = $this->admin_model->getDetails('faculty_teaching_experience_details', $id)->row();

				$this->rec_template->show('recruitment/update_teaching', $data);
			} else {

				$updateDetails = array(
					'institution' => $this->input->post('institution'),
					'designation' => $this->input->post('designation'),
					'period_from' => $this->input->post('period_from'),
					'period_to' => $this->input->post('period_to')
				);

				$result = $this->admin_model->updateDetails($id, $updateDetails, 'faculty_teaching_experience_details');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageTeaching', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deleteTeaching($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Teaching";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('faculty_teaching_experience_details', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/manageTeaching', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function manageIndustrial()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Industrial";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('organization', 'Organization', 'required');
			$this->form_validation->set_rules('position_held', 'Position Held', 'required');
			$this->form_validation->set_rules('period_from', 'Period From', 'required');
			$this->form_validation->set_rules('period_to', 'Period To', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/manageIndustrial';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_industrial_experience')->result();

				$this->rec_template->show('recruitment/manage_industrial', $data);
			} else {

				$insertDetails = array(
					'user_id' => $data['id'],
					'organization' => $this->input->post('organization'),
					'position_held' => $this->input->post('position_held'),
					'period_from' => $this->input->post('period_from'),
					'period_to' => $this->input->post('period_to'),
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('faculty_industrial_experience', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageIndustrial', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updateIndustrial($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Industrial";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('organization', 'Organization', 'required');
			$this->form_validation->set_rules('position_held', 'Position Held', 'required');
			$this->form_validation->set_rules('period_from', 'Period From', 'required');
			$this->form_validation->set_rules('period_to', 'Period To', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateIndustrial/' . $id;

				$data['details'] = $this->admin_model->getDetails('faculty_industrial_experience', $id)->row();

				$this->rec_template->show('recruitment/update_industrial', $data);
			} else {

				$updateDetails = array(
					'organization' => $this->input->post('organization'),
					'position_held' => $this->input->post('position_held'),
					'period_from' => $this->input->post('period_from'),
					'period_to' => $this->input->post('period_to')
				);

				$result = $this->admin_model->updateDetails($id, $updateDetails, 'faculty_industrial_experience');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageIndustrial', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deleteIndustrial($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Industrial";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('faculty_industrial_experience', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/manageIndustrial', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
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

			$data['details'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			if ($this->input->post('post_id')) {
				$data['education'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_education_details')->result();
				$data['research'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_research_exp_details')->result();
				$data['publications'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_publications_details')->result();
				$data['teaching'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_teaching_experience_details')->result();
				$data['industrial'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_industrial_experience')->result();
				$data['affiliations'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_affiliations')->result();
				$data['references'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_references')->result();
				$data['documents'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_documents')->result();
				$data['langs'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_languages')->result();
				$data['projects'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'sponsored_projects')->result();
				$data['consultancy'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'consultancy_undertaken')->result();
				$data['membership'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'professional_membership')->result();
				$data['seminars'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'seminars_workshops_courses')->result();
				$data['patents'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'user_patents')->result();
				$data['post_id'] = $this->input->post('post_id');
				$data['post_details'] = $this->admin_model->getDetails('recruitment_posts', $data['post_id'])->row();
				$data['department'] = $this->input->post('department');
				$data['in_service_note'] = $this->input->post('in_service_note');
				$data['additional_info'] = $this->input->post('additional_info');
				if ($data['details']->post_of == "Non-Teaching") {
					$this->rec_template->show('recruitment/preview-non', $data);
				} else {
					$this->rec_template->show('recruitment/preview', $data);
				}
			} else {
				redirect('recruitment/dashboard', 'refresh');
			}
			//  		$this->rec_template->show('recruitment/preview',$data);    

		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function payment()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['mobile'] = $session_data['mobile'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";
			$details = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			$post = $this->admin_model->getDetails('recruitment_posts', $details->post_id)->row();
			$datenow = date("d/m/Y h:m:s");
			$transactionDate = str_replace(" ", "%20", $datenow);
			$transactionId = str_replace(".", "", microtime(true)) . rand(000, 999);

			$this->load->library('transaction_request');

			//  $merchantId = "9132";
			// 	$transactionPassword = "Test@123";
			// 	$productId = "NSE";
			//     $fee = $post->fee;
			// 	$requestHashKey = "KEY123657234";
			// 	$requestAESKey = "A4476C2062FFA58980DC8F79EB6A799E";
			// 	$requestSaltKey = "A4476C2062FFA58980DC8F79EB6A799E";

			$merchantId = "336013";
			$transactionPassword = "4732ac1c";
			$productId = "RECRUITMENT";
			$fee = $post->fee;
			$requestHashKey = "0016f5f5e8d94711b9";
			$requestAESKey = "EE7334D01D5D752E0C67D59724BFAC9A";
			$requestSaltKey = "EE7334D01D5D752E0C67D59724BFAC9A";

			// 	$encrypt_programme_type = base64_encode($this->encrypt->encode($programme_type));
			// $param = $year.','.$programme_type.','.$details->aided_unaided.','.$section->programme_type.','.$section->dept_id;

			// $encrypt_param = base64_encode("fee");

			$retunrURL = base_url() . 'recruitment/payment_response/';

			$this->transaction_request->setLogin($merchantId);
			$this->transaction_request->setPassword($transactionPassword);
			$this->transaction_request->setProductId($productId);
			$this->transaction_request->setAmount($fee);
			$this->transaction_request->setTransactionCurrency("INR");
			$this->transaction_request->setTransactionAmount(0);
			$this->transaction_request->setReturnUrl($retunrURL);
			$this->transaction_request->setClientCode('001');
			$this->transaction_request->setTransactionId($transactionId);              // GENERATED UNIQUE TRANSACTION ID
			$this->transaction_request->setTransactionDate($transactionDate);          // CURRENT DATE AND TIME  
			$this->transaction_request->setCustomerUSN($data['email']);                          // USN
			$this->transaction_request->setCustomerName($data['candidate_name']);                 // STUDENT NAME
			// $this->transaction_request->setCustomerDepartment($department);            // DEPARTMENT
			$this->transaction_request->setCustomerEmailId($data['email']);             // STUDENT EMAIL
			$this->transaction_request->setCustomerMobile($data['mobile']);             // STUDENT MOBILE
			// $this->transaction_request->setCustomerAided($aided);                      // AIDED
			// $this->transaction_request->setCustomerCategory($category);                // CATEGORY
			// $this->transaction_request->setCustomerAdmissionQuota($admissionQuota);    // ADMISSION QUOTA
			// $this->transaction_request->setCustomerBillingAddress($studentAddress);    // STUDENT ADDRESS
			$this->transaction_request->setCustomerAccount("639827");
			$this->transaction_request->setReqHashKey($requestHashKey);
			// $this->transaction_request->seturl("https://paynetzuat.atomtech.in/paynetz/epi/fts");
			$this->transaction_request->seturl("https://payment.atomtech.in/paynetz/epi/fts");
			$this->transaction_request->setRequestEncypritonKey($requestAESKey);
			$this->transaction_request->setSalt($requestSaltKey);


			// $this->transaction_request->setLogin($merchantId);
			// $this->transaction_request->setPassword($transactionPassword);
			// $this->transaction_request->setProductId($productId);
			// $this->transaction_request->setAmount($fee);
			// $this->transaction_request->setTransactionCurrency("INR");
			// $this->transaction_request->setTransactionAmount(0);
			// $this->transaction_request->setReturnUrl($retunrURL);
			// $this->transaction_request->setClientCode('001');
			// $this->transaction_request->setTransactionId($transactionId);              // GENERATED UNIQUE TRANSACTION ID
			// $this->transaction_request->setTransactionDate($transactionDate);          // CURRENT DATE AND TIME  
			// $this->transaction_request->setCustomerUSN("Sd");                          // USN
			// $this->transaction_request->setCustomerName("Sreenivas");                 // STUDENT NAME
			// $this->transaction_request->setCustomerAccount("639827");
			// $this->transaction_request->setReqHashKey($requestHashKey);
			// // $this->transaction_request->seturl("https://payment.atomtech.in/paynetz/epi/fts");
			// $this->transaction_request->seturl("https://paynetzuat.atomtech.in/paynetz/epi/fts");
			// $this->transaction_request->setRequestEncypritonKey($requestAESKey);
			// $this->transaction_request->setSalt($requestSaltKey);

			$url = $this->transaction_request->getPGUrl();
			header("Location: $url");
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function payment_response()
	{

		$this->load->library('transaction_response');

		//    $responseHashKey = "KEYRESP123657234";
		//     $responseAESKey = "75AEF0FA1B94B3C10D4F5B268F757F11";
		// 	$responseSaltKey = "75AEF0FA1B94B3C10D4F5B268F757F11";

		$responseHashKey = "0a806e7b4a54e4105c";
		$responseAESKey = "E12E9BB5AF6120013F422E32C99C9A82";
		$responseSaltKey = "E12E9BB5AF6120013F422E32C99C9A82";

		$this->transaction_response->setRespHashKey($responseHashKey);
		$this->transaction_response->setResponseEncypritonKey($responseAESKey);
		$this->transaction_response->setSalt($responseSaltKey);

		$arrayofdata = $this->transaction_response->decryptResponseIntoArray($_POST['encdata']);
		// print_r($arrayofdata); die;

		if ($arrayofdata['f_code'] == "Ok") {
			$email = $arrayofdata['udf11'];
			$txn_id = $arrayofdata['ipg_txn_id'];
			//query the database
			$result = $this->admin_model->rec_user_login($email, md5("SREENI"));

			if ($result) {
				$sess_array = array();
				$id = $result->id;
				$sess_array = array(
					'id' => $result->id,
					'candidate_name' => $result->candidate_name,
					'email' => $result->email,
					'mobile' => $result->mobile
				);
				$postid = $result->post_id;
				$this->session->set_userdata('logged_in', $sess_array);
				$appln = $this->db->where(array('payment_status' => '1', 'post_id' => $postid))->from("recruitment_users")->count_all_results();
				$appln_nos = sprintf("%03d", $appln + 1);

				if ($result->post_of == "Non-Teaching") {
					$appln_no = "Dr.AIT/2023-24/NT/" . $appln_nos;
				} elseif ($result->post_of == "Librarian") {
					$appln_no = "Dr.AIT/2023-24/LP/" . $appln_nos;
				} else {
					$appln_no = "Dr.AIT/2023-24/AFP/" . $appln_nos;
				}


				$updateDetails = array('payment_status' => '1', 'txn_id' => $txn_id, 'txn_response' => json_encode($arrayofdata), 'application' => $appln_no, 'payment_date' => date('Y-m-d H:i:s'));
				$result = $this->admin_model->updateDetails($id, $updateDetails, 'recruitment_users');

				if ($result) {
					$this->session->set_flashdata('message', '<h5 class="text-success"> Payment Done and Application Submitteed successfully...!</h5>');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/print', 'refresh');
			} else {
				redirect('recruitment/timeout', 'refresh');
			}
		} else {

			$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
			$this->session->set_flashdata('status', 'alert-danger');

			redirect('recruitment/profile', 'refresh');
		}
	}

	function payment_response1()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";


			$this->load->library('transaction_response');
			$responseHashKey = "KEYRESP123657234";
			$responseAESKey = "75AEF0FA1B94B3C10D4F5B268F757F11";
			$responseSaltKey = "75AEF0FA1B94B3C10D4F5B268F757F11";

			// 	$responseHashKey = "147e14239ba15947d1";
			//     $responseAESKey = "19DE2650AF672D308C508346BD114289";
			// 	$responseSaltKey = "19DE2650AF672D308C508346BD114289";

			$this->transaction_response->setRespHashKey($responseHashKey);
			$this->transaction_response->setResponseEncypritonKey($responseAESKey);
			$this->transaction_response->setSalt($responseSaltKey);

			$arrayofdata = $this->transaction_response->decryptResponseIntoArray($_POST['encdata']);

			print_r($arrayofdata);
			die;

			$usn = $arrayofdata['udf11'];
			$txn_id = $arrayofdata['mer_txn'];

			if ($arrayofdata['f_code'] == "Ok") {
			} else {
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function notifications()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Notifications";
			$data['activeMenu'] = "notifications";

			// $Notifications = $this->admin_model->getDetails('notifications', false)->result();
			$Notifications = $this->admin_model->getDetailsbySort('created_date', 'ASC', 'notifications')->result();


			if ($Notifications != null) {
				$table_setup = array('table_open' => '<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">');
				$this->table->set_template($table_setup);
				$this->table->set_heading(
					array('data' => 'S.No', 'width' => '5%'),
					array('data' => 'Details', 'width' => '60%'),
					array('data' => 'File', 'width' => '10%'),
					array('data' => 'Create', 'width' => '20%'),
					array('data' => 'Action', 'width' => '5%')
				);
				$i = 1;
				$Notifications = array_reverse($Notifications);
				foreach ($Notifications as $Notifications1) {

					if ($Notifications1->status) {
						$newStatus1 = anchor('COEADMIN/updateNewsStatus/' . $Notifications1->id . '/0', '<i class="fas fa-toggle-on"></i>', 'class="text-primary"');
					} else {
						$newStatus1 = anchor('COEADMIN/updateNewsStatus/' . $Notifications1->id . '/1', '<i class="fas fa-toggle-off"></i>', 'class="text-gray-300"');
					}

					if ($Notifications1->download != '') {
						$download = anchor(base_url() . 'notifications/' . $Notifications1->download, '<i class="fas fa-download"></i>', 'class="btn btn-sm btn-warning" target="_blank"');
					} else {
						$download = "";
					}

					if ($Notifications1->link != '') {
						if ($download != '') $linkSpace = "&nbsp;";
						else $linkSpace = null;
						$link = $linkSpace . anchor($Notifications1->link, '<i class="fas fa-link"></i>', 'class="btn btn-sm btn-info" target="_blank"');
					} else {
						$link = "";
					}
					$created_date = date('d-m-Y h:i A', strtotime($Notifications1->created_date));

					$this->table->add_row(
						$i++,
						$Notifications1->details,
						$download . $link,
						$created_date,
						$newStatus1 . '&nbsp;' .
							anchor('COEADMIN/editNotifications/' . $Notifications1->id, '<i class="fas fa-edit"></i>', 'class="text-success"') . '&nbsp;' .
							anchor('COEADMIN/deleteNotifications/' . $Notifications1->id, '<i class="fas fa-times"></i>', 'class="text-danger"')
					);
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['table'] = '<div class="text-center mb-5 mt-5 pb-5 pt-5"> <h2> No details found..! </h2> </div>';
			}

			$this->coe_template->show('COE/Notifications', $data);
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function addNotifications()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Add New Notification";
			$data['activeMenu'] = "notifications";

			$this->form_validation->set_rules('details', 'Details', 'required');
			if ($this->form_validation->run() === FALSE) {
				$data['action'] = 'COEADMIN/addNotifications/';
				$data['details'] = $this->input->post('details');
				$data['link'] = $this->input->post('link');
				$this->coe_template->show('COE/addNotifications', $data);
			} else {

				if ($_FILES['userfile']['name'] != '' || $_FILES['userfile']['error'] != 4) {
					$this->load->library('upload');
					$config['upload_path']    = './notifications/';
					$config['allowed_types']  = 'pdf|doc|docx';
					$config['max_size']       = 100000;
					$config['overwrite']      = TRUE;

					$this->upload->initialize($config);
					$this->upload->set_allowed_types('pdf|doc|docx');

					if (!$this->upload->do_upload('userfile')) {
						$data['msg'] = $this->upload->display_errors();
						$this->session->set_flashdata('message', '<h5 class="text-danger">' . $data['msg'] . '</h5>');
						redirect("COEADMIN/notifications/");
					} else {
						$upload_data = $this->upload->data();
						$file_name = $upload_data['file_name'];
					}
				} else {
					$file_name = '';
				}

				$insertDetails = array(
					'details' => $this->input->post('details'),
					'download' => $file_name,
					'link' => $this->input->post('link'),
					'created_date' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('notifications', $insertDetails);
				if ($result) {
					$this->session->set_flashdata('message', '<h5 class="text-success">Notifications Details added successfully...!</h5>');
				} else {
					$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
				}

				redirect('COEADMIN/notifications', 'refresh');
			}
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function editNotifications($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Edit Notifications";
			$data['activeMenu'] = "notifications";

			$this->form_validation->set_rules('details', 'Details', 'required');
			if ($this->form_validation->run() === FALSE) {
				$data['action'] = 'COEADMIN/editNotifications/' . $id;
				$Notifications = $this->admin_model->getDetails('notifications', $id)->row();
				$data['details'] = $Notifications->details;
				$data['userfile'] = $Notifications->download;
				$data['link'] = $Notifications->link;
				$this->coe_template->show('COE/addNotifications', $data);
			} else {
				if ($_FILES['userfile']['name'] != '' || $_FILES['userfile']['error'] != 4) {
					$this->load->library('upload');
					$config['upload_path']    = './notifications/';
					$config['allowed_types']  = 'pdf|doc|docx';
					$config['max_size']       = 100000;
					$config['overwrite']      = TRUE;

					$this->upload->initialize($config);
					$this->upload->set_allowed_types('pdf|doc|docx');

					if (!$this->upload->do_upload('userfile')) {
						$data['msg'] = $this->upload->display_errors();
						$this->session->set_flashdata('message', '<h5 class="text-danger">' . $data['msg'] . '</h5>');
						redirect("COEADMIN/notifications/");
					} else {
						$upload_data = $this->upload->data();
						$file_name = $upload_data['file_name'];
					}

					$updateDetails = array(
						'details' => $this->input->post('details'),
						'download' => $file_name,
						'link' => $this->input->post('link'),
						'created_date' => date('Y-m-d H:i:s')
					);
				} else {
					$updateDetails = array(
						'details' => $this->input->post('details'),
						'link' => $this->input->post('link'),
						'created_date' => date('Y-m-d H:i:s')
					);
				}


				$result = $this->admin_model->updateDetails($id, $updateDetails, 'notifications');

				if ($result) {
					$this->session->set_flashdata('message', '<h5 class="text-success">Notification Details updated successfully...!</h5>');
				} else {
					$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
				}

				redirect('COEADMIN/notifications', 'refresh');
			}
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function updateNewsStatus($id, $status)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Edit Notifications";
			$data['activeMenu'] = "notifications";

			$updateDetails = array('status' => $status, 'created_date' => date('Y-m-d H:i:s'));

			$result = $this->admin_model->updateDetails($id, $updateDetails, 'notifications');
			if ($result) {
				$this->session->set_flashdata('message', '<h5 class="text-success">Notification Status updated successfully...!</h5>');
			} else {
				$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
			}

			redirect('COEADMIN/notifications', 'refresh');
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function deleteNotifications($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Delete Notifications";
			$data['activeMenu'] = "notifications";

			$Notifications = $this->admin_model->getDetails('notifications', $id)->row();
			if ($Notifications->download != '') {
				$url = glob('./notifications/' . $Notifications->download);
				if ($url) {
					unlink($url[0]);
				}
			}

			$this->admin_model->delDetails('notifications', $id);

			$this->session->set_flashdata('message', '<h5 class="text-success"> Notification Details deleted successfully...!</h5>');
			redirect('/COEADMIN/notifications', 'refresh');
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function changePassword()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['mobile'] = $session_data['mobile'];
			$data['pageTitle'] = "Change Password";
			$data['activeMenu'] = "changePassword";

			$this->form_validation->set_rules('oldPassword', 'Old Password', 'required');
			$this->form_validation->set_rules('newPassword', 'New Password', 'required');
			if ($this->form_validation->run() === FALSE) {
				$data['oldPassword'] = '';
				$data['newPassword'] = '';
				$data['action'] = 'recruitment/changePassword/';
				$this->rec_template->show('recruitment/changePassword_user', $data);
			} else {
				$oldPassword = $this->input->post('oldPassword');
				$newPassword = $this->input->post('newPassword');

				if ($oldPassword == $newPassword) {
					$this->session->set_flashdata('message', '<h5 class="text-success">Old and New Password should not be same...!</h5>');
				} else {
					$updateDetails = array('password' => md5($newPassword));
					$result = $this->admin_model->recuserPassword($data['mobile'], $oldPassword, $updateDetails);
					if ($result) {
						$this->session->set_flashdata('message', '<h5 class="text-success">Password udpated successfully...!</h5>');
					} else {
						$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
					}
				}

				redirect('/recruitment/changePassword', 'refresh');
			}
		} else {
			redirect('recruitment', 'refresh');
		}
	}


	function uploadResults()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Upload Results";
			$data['activeMenu'] = "results";
			$this->coe_template->show('COE/uploadResults', $data);
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function importResults()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Upload Results";
			$data['activeMenu'] = "results";

			$result = $this->input->post('results');
			$resultsType = $this->input->post('resultsType');
			// echo "<pre>";
			if (isset($_FILES["file"]["name"])) {

				$arr_file = explode('.', $_FILES['file']['name']);
				$extension = strtolower(end($arr_file));

				if ($extension == 'xlsx') {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				}

				$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();

				$result = $this->input->post('results');
				$resultsType = $this->input->post('resultsType');

				$result_table = array(
					'results' => $result,
					'result_type' => $resultsType,
					'visibility' => '0',
					'updated_by' => 'COE',
					'updated_on' => date('Y-m-d H:i:s')
				);
				$result_id = $this->admin_model->insertDetails('results', $result_table);
				// $result_id = 0;
				// print_r($result_table);

				unset($sheetData[0][0]);
				unset($sheetData[0][1]);
				unset($sheetData[0][2]);

				$insertDetails = array();
				foreach ($sheetData[0] as $key => $value) {
					if ($value != null) {
						$row = array(
							'result_id' => $result_id,
							'subject_name' => $value,
							'subject_code' => $sheetData[1][$key]
						);
						array_push($insertDetails, $row);
					}
				}

				$this->admin_model->insertBatch('results_subjects', $insertDetails);
				$subjectsCount = count($insertDetails);
				$first_id = $this->db->insert_id();
				// $first_id = 0;
				$subjects = null;
				$marksArray = array('0' => 'id', '1' => 'USN', '2' => 'student_name');
				$alphabet = 3;
				for ($i = $first_id; $i < $first_id + $subjectsCount; $i++) {
					$subjects .= '`sub_' . $i . '_cie` varchar(20) NOT NULL,';
					$subjects .= '`sub_' . $i . '_see` varchar(20) NOT NULL,';
					$subjects .= '`sub_' . $i . '_total` varchar(20) NOT NULL,';
					$subjects .= '`sub_' . $i . '_grades` varchar(20) NOT NULL,';
					$marksArray[$alphabet++] = 'sub_' . $i . '_cie';
					$marksArray[$alphabet++] = 'sub_' . $i . '_see';
					$marksArray[$alphabet++] = 'sub_' . $i . '_total';
					$marksArray[$alphabet++] = 'sub_' . $i . '_grades';
				}

				$table_name = "results_" . $result_id;
				$query = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `usn` varchar(100) NOT NULL,
                    `student_name` varchar(100) NOT NULL,
                    " . $subjects . "
                    PRIMARY KEY (`id`)
                  ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

				$this->admin_model->createResults($query);

				unset($sheetData[0]);
				unset($sheetData[1]);
				unset($sheetData[2]);

				$finalMarks = array();
				foreach ($sheetData as $key => $value) {
					if ($key != 0 && $key != 1 && $key != 2) {
						if ($value[0] != null) {
							$rowMarks = array();
							foreach ($value as $key_marks => $value_marks) {
								if ($key_marks != 0 && array_key_exists($key_marks, $marksArray)) {
									$rowMarks[$marksArray[$key_marks]] = $value_marks;
								}
							}
							array_push($finalMarks, $rowMarks);
						}
					}
				}
				$this->admin_model->insertBatch($table_name, $finalMarks);

				// print_r($marksArray);
				// print_r($finalMarks);

				echo "<h4 class='text-center text-danger'>" . $result . " results imported successfully..!</h4>";
			} else {
				echo "Error...!";
			}
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function importResults1()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Upload Results";
			$data['activeMenu'] = "results";

			require_once APPPATH . 'third_party/PhpSpreadsheet/Spreadsheet';
			require_once APPPATH . 'third_party/PhpSpreadsheet/IOFactory';
			$this->spreadsheet = new Spreadsheet();

			$result = $this->input->post('results');
			$resultsType = $this->input->post('resultsType');
			// $dept_id = $this->input->post('dept_id');

			$result_table = array(
				'results' => $result,
				'result_type' => $resultsType,
				'visibility' => '0',
				'updated_by' => 'COE',
				'updated_on' => date('Y-m-d H:i:s')
			);

			// $result_id = $this->admin_model->insertDetails('results', $result_table);

			if (isset($_FILES["file"]["name"])) {
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				$sheet_data = $object->getActiveSheet()->toArray(null, true, true, true);
				echo "<pre>";
				print_r($sheet_data);
				die;
				unset($sheet_data[1]['A']);
				unset($sheet_data[1]['B']);
				unset($sheet_data[1]['C']);

				$insertDetails = array();
				foreach ($sheet_data[1] as $key => $value) {
					if ($value != null) {
						$row = array(
							'result_id' => $result_id,
							'subject_name' => $value,
							'subject_code' => $sheet_data[2][$key]
						);
						array_push($insertDetails, $row);
					}
				}
				$this->admin_model->insertBatch('results_subjects', $insertDetails);
				$subjectsCount = count($insertDetails);
				$first_id = $this->db->insert_id();
				$subjects = null;
				$marksArray = array('B' => 'USN', 'C' => 'student_name');
				$alphabet = 'D';
				for ($i = $first_id; $i < $first_id + $subjectsCount; $i++) {
					$subjects .= '`sub_' . $i . '_cie` varchar(20) NOT NULL,';
					$subjects .= '`sub_' . $i . '_see` varchar(20) NOT NULL,';
					$subjects .= '`sub_' . $i . '_total` varchar(20) NOT NULL,';
					$subjects .= '`sub_' . $i . '_grades` varchar(20) NOT NULL,';
					$marksArray[$alphabet++] = 'sub_' . $i . '_cie';
					$marksArray[$alphabet++] = 'sub_' . $i . '_see';
					$marksArray[$alphabet++] = 'sub_' . $i . '_total';
					$marksArray[$alphabet++] = 'sub_' . $i . '_grades';
				}

				// print_r($marksArray);

				$table_name = "results_" . $result_id;
				$query = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `usn` varchar(100) NOT NULL,
                    `student_name` varchar(100) NOT NULL,
                    " . $subjects . "
                    PRIMARY KEY (`id`)
                  ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

				$this->admin_model->createResults($query);

				$finalMarks = array();
				foreach ($sheet_data as $key => $value) {
					if ($key != '1' && $key != '2' && $key != '3') {
						if ($value['B'] != null) {
							$rowMarks = array();
							foreach ($value as $key_marks => $value_marks) {
								if ($key_marks != "A" && array_key_exists($key_marks, $marksArray)) {
									$rowMarks[$marksArray[$key_marks]] = $value_marks;
								}
							}
							array_push($finalMarks, $rowMarks);
						}
					}
				}
				$this->admin_model->insertBatch($table_name, $finalMarks);
				// print_r($finalMarks);
				echo "<h4 class='text-center text-danger'>" . $result . " results imported successfully..!</h4>";
			}
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function deptDetails($field, $id = false)
	{
		$return = array();
		if (!$id) {
			$departmentsList = $this->admin_model->getDetails('departments', $id)->result();
			foreach ($departmentsList as $departmentsList1) {
				if ($field == 'department_name')
					$return[$departmentsList1->id] = $departmentsList1->department_name;
				if ($field == 'short_name')
					$return[$departmentsList1->id] = $departmentsList1->short_name;
			}
			return $return;
		} else {
			$departmentsList = $this->admin_model->getDetails('departments', $id)->row();
			if ($field == 'department_name')
				$return = $departmentsList->department_name;
			if ($field == 'short_name')
				$return = $departmentsList->short_name;

			return $return;
		}
	}

	function results()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Results";
			$data['activeMenu'] = "results";

			$Results = $this->admin_model->getResults()->result();

			if ($Results != null) {
				$table_setup = array('table_open' => '<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">');
				$this->table->set_template($table_setup);
				$this->table->set_heading(
					array('data' => 'S.No', 'width' => '5%'),
					// array('data' => 'Year', 'width' => '5%'),
					array('data' => 'Results', 'width' => '65%'),
					// array('data' => 'Department', 'width' => '25%'),
					array('data' => 'Status', 'width' => '15%'),
					array('data' => 'Action', 'width' => '15%')
				);
				$i = 1;
				// $Results = array_reverse($Notifications);
				foreach ($Results as $Results1) {

					if ($Results1->result_type == '1') {
						$clr = 'text-dark';
					}
					if ($Results1->result_type == '2') {
						$clr = 'text-blue';
					}
					if ($Results1->result_type == '3') {
						$clr = 'text-yellow';
					}

					$this->table->add_row(
						$i++,
						// $Results1->year,
						'<span class=' . $clr . '>' . $Results1->results . '</span>',
						// $this->deptDetails('department_name',$Results1->dept_id),
						($Results1->visibility) ? anchor('COEADMIN/statusResults/' . $Results1->id . '/' . $Results1->visibility, 'Published', 'class="badge badge-success"') : anchor('COEADMIN/statusResults/' . $Results1->id . '/' . $Results1->visibility, 'Un-published', 'class="badge badge-danger"'),
						anchor('COEADMIN/viewResults/' . $Results1->id, 'View', 'class="btn btn-sm btn-outline-primary"') . '&nbsp;' .
							anchor('COEADMIN/deleteResults/' . $Results1->id, 'Delete', 'class="btn btn-sm btn-outline-danger"')
					);
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['table'] = '<div class="text-center mb-5 mt-5 pb-5 pt-5"> <h2> No details found..! </h2> </div>';
			}
			$this->session->set_flashdata('message', null);
			$this->coe_template->show('COE/Results', $data);
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function statusResults($result_id, $visibility)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Results";
			$data['activeMenu'] = "results";

			// ($visibility) ? $visibility = '0' : $visibility = '1';
			$msg = null;
			if ($visibility) {
				$visibility = '0';
				$msg = '<h5 class="text-danger"> Results disabled successfully..! </h5>';
			} else {
				$visibility = '1';
				$msg = '<h5 class="text-success"> Results enabled successfully...! </h5>';
			}

			$updateDetails = array('visibility' => $visibility);
			// print_r($updateDetails); die;
			$result = $this->admin_model->updateDetails($result_id, $updateDetails, 'results');

			if ($result) {
				$this->session->set_flashdata('message', $msg);
			} else {
				$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
			}

			redirect('COEADMIN/results', 'refresh');
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	function viewResults($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Results";
			$data['activeMenu'] = "results";

			$data['Results'] = $this->admin_model->getDetails('results', $id)->row();
			$data['Subjects'] = $this->admin_model->getDetailsbyfield($id, 'result_id', 'results_subjects')->result();
			$table = 'results_' . $id;
			$data['Marks'] = $this->admin_model->getDetails($table, false)->result();

			// echo "<pre>";
			// print_r($Subjects);

			$this->coe_template->show('COE/ResultsView', $data);
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	public function deleteResults($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Results";
			$data['activeMenu'] = "results";

			$this->admin_model->delDetails('results', $id);
			$this->admin_model->delDetailsbyfield('results_subjects', 'result_id', $id);

			$table = 'results_' . $id;
			$this->admin_model->dropTable($table);

			$this->session->set_flashdata('message', '<h5 class="text-danger">Results deleted successfully.!</h5>');
			redirect('COEADMIN/results', 'refresh');
		} else {
			redirect('COEADMIN', 'refresh');
		}
	}

	public function file_check($str)
	{
		$allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
			$mime = get_mime_by_extension($_FILES['file']['name']);
			$fileAr = explode('.', $_FILES['file']['name']);
			$ext = end($fileAr);
			if (($ext == 'csv') && in_array($mime, $allowed_mime_types)) {
				return true;
			} else {
				$this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
				return false;
			}
		} else {
			$this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
			return false;
		}
	}


	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('recruitment', 'refresh');
	}
	function generate_unique_id()
	{
		$id = uniqid("", TRUE);
		$id = str_replace(".", "-", $id);
		return $id . "-" . rand(10000000, 99999999);
	}
	public function confirm_email()
	{


		$token = $this->input->get("token", true);
		$data["user"] = $this->Email_model->get_user_by_token($token);

		if (empty($data["user"])) {
			redirect('recruitment/index');
		}
		if ($data["user"]->email_verified == 1) {
			redirect('recruitment/index');
		}

		if ($this->Email_model->verify_email($data["user"])) {
			$data["msg"] = "success";
		} else {
			$data["msg"] = "error";
		}

		$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
		$data['action'] = 'recruitment';

		$this->rec_template->show('recruitment/login', $data);
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

		if (! $this->upload->do_upload('image')) {
			$error = array('error' => $this->upload->display_errors());
			//  echo json_encode($error);
			redirect('recruitment/profile', 'refresh');
		} else {
			$data = $this->upload->data();
			$success = $data['file_name'];
			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['id'];
			if (!empty($success)) {
				$data = array(
					'profile_pic' => $success
				);
				$this->db->where('id', $id);
				$this->db->update('recruitment_users', $data);
			}
			json_encode($success);
			redirect('recruitment/profile', 'refresh');
		}
	}
	function forgot()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
			$data['action'] = 'recruitment/';

			$this->rec_template->show('recruitment/forgot', $data);
		} else {
			$email = $this->input->post('email');
			//get user
			$user = $this->Email_model->get_user_by_email($email);

			if (empty($user)) {
				$data["msg"] = "error";
			} else {
				$this->Email_model->send_email_reset_password($user->email);
				$data["msg"] = "success";
			}

			$this->rec_template->show('recruitment/forgot', $data);
		}
	}

	function updatePersonal()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Personal";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
			$this->form_validation->set_rules('father_name', 'Father Name', 'required');
			$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
			$this->form_validation->set_rules('father_occupation', 'Fathers Occupation', 'required');
			$this->form_validation->set_rules('place_of_birth', 'Place of Birth', 'required');
			$this->form_validation->set_rules('address', 'Address for Correspondence', 'required');
			$this->form_validation->set_rules('religion', 'Religion', 'required');
			$this->form_validation->set_rules('reservation_category', 'Reservation Category', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updatePersonal/';

				$data['details'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();

				$this->rec_template->show('recruitment/update_personal', $data);
			} else {

				$updateDetails = array(
					'mobile' => $this->input->post('mobile'),
					'father_name' => $this->input->post('father_name'),
					'date_of_birth' => $this->input->post('date_of_birth'),
					'father_occupation' => $this->input->post('father_occupation'),
					'place_of_birth' => $this->input->post('place_of_birth'),
					'address' => $this->input->post('address'),
					'religion' => $this->input->post('religion'),
					'reservation_category' => $this->input->post('reservation_category')
				);

				$result = $this->admin_model->updateDetails($data['id'], $updateDetails, 'recruitment_users');


				if ($result) {
					if ($this->input->post('menu_flag') != '') {
						$this->Email_model->update_menu_flag($data['id'], '1');
					}
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/profile', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}



	function manageAffiliations()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Affiliations";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('name', 'Name of the Professional Body ', 'required');
			$this->form_validation->set_rules('grade', 'Grade of Membership', 'required');
			$this->form_validation->set_rules('number', 'Number of Membership', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/manageAffiliations';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_affiliations')->result();

				$this->rec_template->show('recruitment/manage_affiliations', $data);
			} else {

				$insertDetails = array(
					'user_id' => $data['id'],
					'name' => $this->input->post('name'),
					'grade' => $this->input->post('grade'),
					'number' => $this->input->post('number'),
					'year' => $this->input->post('year'),
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('recruitment_affiliations', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageAffiliations', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updateAffiliations($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Affiliations";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('name', 'Name of the Professional Body ', 'required');
			$this->form_validation->set_rules('grade', 'Grade of Membership', 'required');
			$this->form_validation->set_rules('number', 'Number of Membership', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateAffiliations/' . $id;

				$data['details'] = $this->admin_model->getDetails('recruitment_affiliations', $id)->row();

				$this->rec_template->show('recruitment/update_affiliations', $data);
			} else {

				$updateDetails = array(
					'name' => $this->input->post('name'),
					'grade' => $this->input->post('grade'),
					'number' => $this->input->post('number'),
					'year' => $this->input->post('year')
				);

				$result = $this->admin_model->updateDetails($id, $updateDetails, 'recruitment_affiliations');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageAffiliations', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deleteAffiliations($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Affiliations";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('recruitment_affiliations', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/manageAffiliations', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}


	function manageReferences()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage References";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('number', 'Contact Number', 'required');
			$this->form_validation->set_rules('position', 'Occupation or Position', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/manageReferences';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_references')->result();

				$this->rec_template->show('recruitment/manage_references', $data);
			} else {

				$insertDetails = array(
					'user_id' => $data['id'],
					'name' => $this->input->post('name'),

					'number' => $this->input->post('number'),
					'position' => $this->input->post('position'),
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('recruitment_references', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageReferences', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updateReferences($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage References";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('number', 'Contact Number', 'required');
			$this->form_validation->set_rules('position', 'Occupation or Position', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateReferences/' . $id;

				$data['details'] = $this->admin_model->getDetails('recruitment_references', $id)->row();

				$this->rec_template->show('recruitment/update_references', $data);
			} else {

				$updateDetails = array(
					'name' => $this->input->post('name'),

					'number' => $this->input->post('number'),
					'position' => $this->input->post('position')
				);

				$result = $this->admin_model->updateDetails($id, $updateDetails, 'recruitment_references');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageReferences', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deleteReferences($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage References";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('recruitment_references', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/manageReferences', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function manageLanguages()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Languages";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('name', 'Language Name', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/manageLanguages';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_languages')->result();

				$this->rec_template->show('recruitment/manage_languages', $data);
			} else {

				$insertDetails = array(
					'user_id'    => $data['id'],
					'name'       => $this->input->post('name'),
					'reading'    => $this->input->post('reading') ? 1 : 0,
					'writ'       => $this->input->post('writ') ? 1 : 0,
					'speak'      => $this->input->post('speak') ? 1 : 0,
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('recruitment_languages', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageLanguages', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updateLanguages($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Languages";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('name', 'Language Name', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateLanguages/' . $id;

				$data['details'] = $this->admin_model->getDetails('recruitment_languages', $id)->row();

				$this->rec_template->show('recruitment/update_languages', $data);
			} else {

				$updateDetails = array(
					'name' => $this->input->post('name'),
					'writ' => $this->input->post('writ'),
					'reading' => $this->input->post('reading'),
					'speak' => $this->input->post('speak')
				);

				$result = $this->admin_model->updateDetails($id, $updateDetails, 'recruitment_languages');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageLanguages', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deleteLanguages($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Languages";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('recruitment_languages', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/manageLanguages', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}


	function manageDocuments()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Documents";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('type', 'Type', 'required');
			//         $this->form_validation->set_rules('file', 'Document', 'required');


			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/manageDocuments';

				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_documents')->result();

				$this->rec_template->show('recruitment/manage_documents', $data);
			} else {

				$file = $this->admin_model->upload_document();

				$insertDetails = array(
					'user_id' => $data['id'],
					'title' => $this->input->post('title'),

					'type' => $this->input->post('type'),
					'file' => $file,
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('recruitment_documents', $insertDetails);

				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageDocuments', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function updateDocuments($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['pageTitle'] = "Manage Documents";
			$data['activeMenu'] = "dashboard";

			$this->form_validation->set_rules('type', 'Type', 'required');



			if ($this->form_validation->run() == FALSE) {
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateDocuments/' . $id;

				$data['details'] = $this->admin_model->getDetails('recruitment_documents', $id)->row();

				$this->rec_template->show('recruitment/update_documents', $data);
			} else {
				$file = $this->admin_model->upload_document();
				if ($file != null) {
					$updateDetails = array(
						'title' => $this->input->post('title'),

						'type' => $this->input->post('type'),
						'file' => $file
					);
				} else {
					$updateDetails = array(
						'title' => $this->input->post('title'),

						'type' => $this->input->post('type')
					);
				}
				$result = $this->admin_model->updateDetails($id, $updateDetails, 'recruitment_documents');

				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/manageDocuments', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	function deleteDocuments($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];

			$data['pageTitle'] = "Manage Documents";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('recruitment_documents', $id);

			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/manageDocuments', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	function print()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			$data['details'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();

			$data['education'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_education_details')->result();
			$data['research'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_research_exp_details')->result();
			$data['publications'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_publications_details')->result();
			$data['teaching'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_teaching_experience_details')->result();
			$data['industrial'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'faculty_industrial_experience')->result();
			$data['affiliations'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_affiliations')->result();
			$data['references'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_references')->result();
			$data['documents'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_documents')->result();
			$data['langs'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'recruitment_languages')->result();
			$data['projects'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'sponsored_projects')->result();
			$data['consultancy'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'consultancy_undertaken')->result();
			$data['membership'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'professional_membership')->result();
			$data['seminars'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'seminars_workshops_courses')->result();


			if ($data['details']->post_of == "Non-Teaching") {
				$this->rec_template->show('recruitment/print-non', $data);
			} elseif ($data['details']->post_of == "Librarian") {
				$this->rec_template->show('recruitment/print-lib', $data);
			} else {
				$this->rec_template->show('recruitment/print', $data);
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}


	function changePassword1()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Change Password";
			$data['activeMenu'] = "changePassword";

			$this->form_validation->set_rules('oldPassword', 'Old Password', 'required');
			$this->form_validation->set_rules('newPassword', 'New Password', 'required');
			if ($this->form_validation->run() === FALSE) {
				$data['Details'] = $this->admin_model->getDetailsbyfield($data['email'], 'email', 'recruitment_users')->row();
				$data['oldPassword'] = '';
				$data['newPassword'] = '';
				$data['action'] = 'recruitment/changePassword/';
				$this->rec_template->show('recruitment/changePassword', $data);
			} else {
				$oldPassword = $this->input->post('oldPassword');
				$newPassword = $this->input->post('newPassword');

				if ($oldPassword == $newPassword) {
					$this->session->set_flashdata('message', '<h5 class="text-success">Old and New Password should not be same...!</h5>');
				} else {
					$updateDetails = array('password' => md5($newPassword));
					$result = $this->admin_model->adminPassword($data['email'], $oldPassword, $updateDetails);

					// var_dump($this->db->last_query());
					// die();
					if ($result) {
						$this->session->set_flashdata('message', '<h5 class="text-success">Password udpated successfully...!</h5>');
					} else {
						$this->session->set_flashdata('message', '<h5 class="text-danger">Oops something went wrong please try again.!</h5>');
					}
				}

				redirect('recruitment/changePassword', 'refresh');
			}
		} else {
			redirect('recruitment/profile', 'refresh');
		}
	}


	private function checkLogin()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			return $data;
		} else {
			redirect('recruitment/profile', 'refresh');
		}
	}

	public function manageProjects()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			$data['pageTitle'] = "Manage Sponsored Projects";
			$data['activeMenu'] = "dashboard";

			// Validation rules
			$this->form_validation->set_rules('sponsoring_agency', 'Sponsoring Agency', 'required');
			$this->form_validation->set_rules('title_of_project', 'Title of Project', 'required');
			$this->form_validation->set_rules('amount_of_grant', 'Amount of Grant', 'required');
			$this->form_validation->set_rules('period', 'Period', 'required');
			$this->form_validation->set_rules('co_investigators', 'Co-investigators', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Fetch the details if validation fails
				$data['pageTitle'] = "Dr.AIT :: Recruitment Portal";
				$data['action'] = 'recruitment/manageProjects';

				// Get the sponsored project details
				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'sponsored_projects')->result();

				// Load the view
				$this->rec_template->show('recruitment/manage_projects', $data);
			} else {
				// Prepare data for insertion
				$insertDetails = array(
					'user_id' => $data['id'],
					'sponsoring_agency' => $this->input->post('sponsoring_agency'),
					'title_of_project' => $this->input->post('title_of_project'),
					'amount_of_grant' => $this->input->post('amount_of_grant'),
					'period' => $this->input->post('period'),
					'co_investigators' => $this->input->post('co_investigators'),
					'created_at' => date('Y-m-d H:i:s')
				);

				// Insert data into database
				$result = $this->admin_model->insertDetails('sponsored_projects', $insertDetails);

				// Set flash data based on result
				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect to manage projects page
				redirect('recruitment/manageProjects', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	// Function to update sponsored project
	public function updateProject($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Manage Sponsored Projects";
			$data['activeMenu'] = "dashboard";

			// Validation rules
			$this->form_validation->set_rules('sponsoring_agency', 'Sponsoring Agency', 'required');
			$this->form_validation->set_rules('title_of_project', 'Title of Project', 'required');
			$this->form_validation->set_rules('amount_of_grant', 'Amount of Grant', 'required');
			$this->form_validation->set_rules('period', 'Period', 'required');
			$this->form_validation->set_rules('co_investigators', 'Co-investigators', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Fetch details for the project that is being updated
				$data['pageTitle'] = "Dr.AIT:: Recruitment Portal";
				$data['action'] = 'recruitment/updateProject/' . $id;
				$data['details'] = $this->admin_model->getDetails('sponsored_projects', $id)->row();

				// Load the view for updating the project
				$this->rec_template->show('recruitment/update_project', $data);
			} else {
				// Prepare data for update
				$updateDetails = array(
					'sponsoring_agency' => $this->input->post('sponsoring_agency'),
					'title_of_project' => $this->input->post('title_of_project'),
					'amount_of_grant' => $this->input->post('amount_of_grant'),
					'period' => $this->input->post('period'),
					'co_investigators' => $this->input->post('co_investigators')
				);

				// Update the project in the database
				$result = $this->admin_model->updateDetails($id, $updateDetails, 'sponsored_projects');

				// Set flash data based on result
				if ($result) {
					$this->session->set_flashdata('message', 'Details are updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect to manage projects page
				redirect('recruitment/manageProjects', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	// Function to delete sponsored project
	public function deleteProject($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Manage Sponsored Projects";
			$data['activeMenu'] = "dashboard";

			// Delete the project from the database
			$this->admin_model->delDetails('sponsored_projects', $id);

			// Set flash data based on result
			$this->session->set_flashdata('message', 'Details are deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			// Redirect to manage projects page
			redirect('recruitment/manageProjects', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}


	public function manageConsultancies()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			$data['pageTitle'] = "Manage Consultancy Projects";
			$data['activeMenu'] = "dashboard";

			// Validation rules
			$this->form_validation->set_rules('organization', 'Organization', 'required');
			$this->form_validation->set_rules('title_of_project', 'Title of Project', 'required');
			$this->form_validation->set_rules('amount_of_grant', 'Amount of Grant', 'required');
			$this->form_validation->set_rules('period', 'Period', 'required');
			$this->form_validation->set_rules('co_investigators', 'Co-investigators', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Fetch consultancy details if validation fails
				$data['action'] = 'recruitment/manageConsultancies';

				// Get the consultancy project details
				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'consultancy_undertaken')->result();

				// Load the view
				$this->rec_template->show('recruitment/manage_consultancies', $data);
			} else {
				// Prepare data for insertion
				$insertDetails = array(
					'user_id' => $data['id'],
					'organization' => $this->input->post('organization'),
					'title_of_project' => $this->input->post('title_of_project'),
					'amount_of_grant' => $this->input->post('amount_of_grant'),
					'period' => $this->input->post('period'),
					'co_investigators' => $this->input->post('co_investigators'),
					'created_at' => date('Y-m-d H:i:s')
				);

				// Insert data into database
				$result = $this->admin_model->insertDetails('consultancy_undertaken', $insertDetails);

				// Set flash data based on result
				if ($result) {
					$this->session->set_flashdata('message', 'Consultancy details inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect to manage consultancies page
				redirect('recruitment/manageConsultancies', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function updateConsultancy($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Update Consultancy Project";
			$data['activeMenu'] = "dashboard";

			// Validation rules
			$this->form_validation->set_rules('organization', 'Organization', 'required');
			$this->form_validation->set_rules('title_of_project', 'Title of Project', 'required');
			$this->form_validation->set_rules('amount_of_grant', 'Amount of Grant', 'required');
			$this->form_validation->set_rules('period', 'Period', 'required');
			$this->form_validation->set_rules('co_investigators', 'Co-investigators', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Fetch details for the consultancy project being updated
				$data['action'] = 'recruitment/updateConsultancy/' . $id;
				$data['details'] = $this->admin_model->getDetails('consultancy_undertaken', $id)->row();

				// Load the view for updating the consultancy project
				$this->rec_template->show('recruitment/update_consultancy', $data);
			} else {
				// Prepare data for update
				$updateDetails = array(
					'organization' => $this->input->post('organization'),
					'title_of_project' => $this->input->post('title_of_project'),
					'amount_of_grant' => $this->input->post('amount_of_grant'),
					'period' => $this->input->post('period'),
					'co_investigators' => $this->input->post('co_investigators')
				);

				// Update the consultancy project in the database
				$result = $this->admin_model->updateDetails($id, $updateDetails, 'consultancy_undertaken');

				// Set flash data based on result
				if ($result) {
					$this->session->set_flashdata('message', 'Consultancy details updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect to manage consultancies page
				redirect('recruitment/manageConsultancies', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function deleteConsultancy($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Manage Consultancy Projects";
			$data['activeMenu'] = "dashboard";

			// Delete the consultancy project from the database
			$this->admin_model->delDetails('consultancy_undertaken', $id);

			// Set flash data based on result
			$this->session->set_flashdata('message', 'Consultancy details deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			// Redirect to manage consultancies page
			redirect('recruitment/manageConsultancies', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function manageProfessionalMemberships()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			$data['pageTitle'] = "Manage Professional Memberships";
			$data['activeMenu'] = "dashboard";

			// Validation rules
			$this->form_validation->set_rules('professional_organization', 'Professional Organization', 'required');
			$this->form_validation->set_rules('year_of_selection', 'Year of Selection', 'required');
			$this->form_validation->set_rules('grade_of_membership', 'Grade of Membership', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Fetch the details if validation fails
				$data['pageTitle'] = "Dr.AIT :: Recruitment Portal";
				$data['action'] = 'recruitment/manageProfessionalMemberships';

				// Get the professional membership details
				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'professional_membership')->result();

				// Load the view
				$this->rec_template->show('recruitment/manage_professional_memberships', $data);
			} else {
				// Prepare data for insertion
				$insertDetails = array(
					'user_id' => $data['id'],
					'professional_organization' => $this->input->post('professional_organization'),
					'year_of_selection' => $this->input->post('year_of_selection'),
					'grade_of_membership' => $this->input->post('grade_of_membership'),
					'created_at' => date('Y-m-d H:i:s')
				);

				// Insert data into the database
				$result = $this->admin_model->insertDetails('professional_membership', $insertDetails);

				// Set flash data based on the result
				if ($result) {
					$this->session->set_flashdata('message', 'Details are inserted successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect to manage professional memberships page
				redirect('recruitment/manageProfessionalMemberships', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function updateProfessionalMembership($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Update Professional Membership";
			$data['activeMenu'] = "dashboard";

			// Validation rules
			$this->form_validation->set_rules('professional_organization', 'Professional Organization', 'required');
			$this->form_validation->set_rules('year_of_selection', 'Year of Selection', 'required');
			$this->form_validation->set_rules('grade_of_membership', 'Grade of Membership', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Fetch details for the record that is being updated
				$data['action'] = 'recruitment/updateProfessionalMembership/' . $id;
				$data['details'] = $this->admin_model->getDetails('professional_membership', $id)->row();

				// Load the view for updating the record
				$this->rec_template->show('recruitment/update_professional_membership', $data);
			} else {
				// Prepare data for update
				$updateDetails = array(
					'professional_organization' => $this->input->post('professional_organization'),
					'year_of_selection' => $this->input->post('year_of_selection'),
					'grade_of_membership' => $this->input->post('grade_of_membership')
				);

				// Update the record in the database
				$result = $this->admin_model->updateDetails($id, $updateDetails, 'professional_membership');

				// Set flash data based on result
				if ($result) {
					$this->session->set_flashdata('message', 'Details updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops..!! Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect to manage professional memberships page
				redirect('recruitment/manageProfessionalMemberships', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function deleteProfessionalMembership($id)
	{
		if ($this->session->userdata('logged_in')) {
			// Delete the record from the database
			$this->admin_model->delDetails('professional_membership', $id);

			// Set flash data based on result
			$this->session->set_flashdata('message', 'Details deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			// Redirect to manage professional memberships page
			redirect('recruitment/manageProfessionalMemberships', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function manageSeminarsWorkshopsCourses()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			$data['pageTitle'] = "Manage Seminars/Workshops/Courses";
			$data['activeMenu'] = "dashboard";

			// Validation rules for form input
			$this->form_validation->set_rules('title_of_project', 'Title of Seminar/Workshop/Course', 'required');
			$this->form_validation->set_rules('organised_conducted', 'Organised/Conducted By', 'required');
			$this->form_validation->set_rules('from_date', 'From Date', 'required');
			$this->form_validation->set_rules('to_date', 'To Date', 'required');

			if ($this->form_validation->run() == FALSE) {
				// If validation fails, load the manage view with any existing records
				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'seminars_workshops_courses')->result();
				$data['action'] = 'recruitment/manageSeminarsWorkshopsCourses';
				$this->rec_template->show('recruitment/manage_seminars_workshops_courses', $data);
			} else {
				// If validation passes, insert the new seminar/workshop/course data into the database
				$insertDetails = array(
					'user_id' => $data['id'],
					'title_of_project' => $this->input->post('title_of_project'),
					'organised_conducted' => $this->input->post('organised_conducted'),
					'from_date' => $this->input->post('from_date'),
					'to_date' => $this->input->post('to_date'),
					'total_days' => $this->input->post('total_days'),
					'created_at' => date('Y-m-d H:i:s')
				);

				// Insert into the database
				$result = $this->admin_model->insertDetails('seminars_workshops_courses', $insertDetails);

				// Set a flash message based on the result
				if ($result) {
					$this->session->set_flashdata('message', 'Seminar/Workshop/Course added successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect back to the manage page
				redirect('recruitment/manageSeminarsWorkshopsCourses', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function updateSeminarsWorkshopsCourses($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			$data['pageTitle'] = "Update Seminar/Workshop/Course";
			$data['activeMenu'] = "dashboard";

			// Validation rules
			$this->form_validation->set_rules('title_of_project', 'Title of Seminar/Workshop/Course', 'required');
			$this->form_validation->set_rules('organised_conducted', 'Organised/Conducted By', 'required');
			$this->form_validation->set_rules('from_date', 'From Date', 'required');
			$this->form_validation->set_rules('to_date', 'To Date', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Fetch existing record for editing
				$data['action'] = 'recruitment/updateSeminarsWorkshopsCourses/' . $id;
				$data['details'] = $this->admin_model->getDetails('seminars_workshops_courses', $id)->row();
				$this->rec_template->show('recruitment/update_seminar_workshop_course', $data);
			} else {
				// Prepare data for updating
				$updateDetails = array(
					'title_of_project' => $this->input->post('title_of_project'),
					'organised_conducted' => $this->input->post('organised_conducted'),
					'from_date' => $this->input->post('from_date'),
					'to_date' => $this->input->post('to_date'),
					'total_days' => $this->input->post('total_days')
				);

				// Update the record in the database
				$result = $this->admin_model->updateDetails($id, $updateDetails, 'seminars_workshops_courses');

				// Set a flash message based on the result
				if ($result) {
					$this->session->set_flashdata('message', 'Seminar/Workshop/Course updated successfully..!!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Something went wrong. Please try again later..!!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect to the manage seminars/workshops/courses page
				redirect('recruitment/manageSeminarsWorkshopsCourses', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function deleteSeminarsWorkshopsCourses($id)
	{
		if ($this->session->userdata('logged_in')) {
			// Delete the record from the database
			$this->admin_model->delDetails('seminars_workshops_courses', $id);

			// Set a flash message based on the result
			$this->session->set_flashdata('message', 'Seminar/Workshop/Course deleted successfully..!!');
			$this->session->set_flashdata('status', 'alert-success');

			// Redirect back to the manage seminars/workshops/courses page
			redirect('recruitment/manageSeminarsWorkshopsCourses', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}

	public function updateAcademicAndProfessionalInfo()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['user_id'] = $session_data['id'];
			$data['pageTitle'] = "Update Academic and Professional Info";

			// Fetch the existing details
			$data['details'] = $this->admin_model->getacaDetails('academic_and_professional_info', $id)->row();

			// Validation rules
			$this->form_validation->set_rules('additional_information', 'Additional Information', 'required');
			$this->form_validation->set_rules('award_recognition_title', 'Award Recognition Title', 'required');
			$this->form_validation->set_rules('project_titles_award_recognition', 'Project Title for Award Recognition', 'required');
			$this->form_validation->set_rules('other_professional_experience_title', 'Professional Experience Title', 'required');
			$this->form_validation->set_rules('agree_to_minimum_salary', 'Agree to Minimum Salary', 'required');

			if ($this->form_validation->run() == FALSE) {
				// If validation fails, load the form with current data
				$this->rec_template->show('recruitment/update_affiliation', $data);
			} else {
				// Prepare data for update
				$updateDetails = array(
					'additional_information' => $this->input->post('additional_information'),
					'in_service_personnel' => $this->input->post('in_service_personnel') ? 1 : 0,
					'organization_forwarded' => $this->input->post('organization_forwarded') ? 1 : 0,
					'award_recognition_title' => $this->input->post('award_recognition_title'),
					'project_titles_award_recognition' => $this->input->post('project_titles_award_recognition'),
					'other_professional_experience_title' => $this->input->post('other_professional_experience_title'),
					'agree_to_minimum_salary' => $this->input->post('agree_to_minimum_salary') ? 1 : 0,
					'updated_at' => date('Y-m-d H:i:s')
				);

				// Update the record in the database
				$result = $this->admin_model->updateDetails($id, $updateDetails, 'academic_and_professional_info');

				// Set flash data based on result
				if ($result) {
					$this->session->set_flashdata('message', 'Details updated successfully!');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Oops.. Something went wrong. Please try again!');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				// Redirect to a suitable page (e.g., listing or dashboard)
				redirect('recruitment/manageAcademicAndProfessionalInfo', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function apply_job()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('recruitment/timeout', 'refresh');
		}
		$session_data = $this->session->userdata('logged_in');
		$data['user_id'] = $session_data['id'];
		$user_id = $session_data['id'];
		$post_id = $this->input->post('post_id');
		$department = $this->input->post('department');
		$in_service_note = $this->input->post('in_service_note');
		$additional_info = $this->input->post('additional_info');
		$agree_terms = $this->input->post('agree_terms') ? 1 : 0;

		// Check if already applied
		$exists = $this->db->get_where('applied_jobs', [
			'user_id' => $user_id,
			'post_id' => $post_id
		])->row();

		if ($exists) {
			$this->session->set_flashdata('message', 'You have already applied for this job.');
			$this->session->set_flashdata('status', 'alert-warning');
			redirect('recruitment/applied');
		}

		// Insert into DB
		$data = [
			'user_id' => $user_id,
			'post_id' => $post_id,
			'department' => $department,
			'agree_terms' => $agree_terms,
			'additional_info' => $additional_info,
			'in_service_note' => $in_service_note
		];

		$this->db->insert('applied_jobs', $data);

		$this->session->set_flashdata('message', 'Application submitted successfully!');
		$this->session->set_flashdata('status', 'alert-success');
		redirect('recruitment/applied');
	}
	function applied()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();



			if (isset($_REQUEST['flag'])) {

				if ($_REQUEST['flag'] > $data['user_data']->menu_flag) {
					$this->Email_model->update_menu_flag($data['id'], $_REQUEST['flag']);
				}
			}
			$data['details'] = $this->admin_model->getDetails('recruitment_users', 	$data['id'])->row();
			$data['appliedList'] = $this->admin_model->applied_jobs($data['id']);


			$this->rec_template->show('recruitment/applied', $data);
		} else {
			redirect('recruitment/timeout', 'refresh');
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
			$this->db->where_in('id', $departments_str);
			$query = $this->db->get();
			$acList = $query->result();

			// $acList = $this->admin_model->getDetailsbyfield($this->input->post('type'), 'type', 'recruitment_posts')->result();
			echo "<option>- Select -</option>";
			foreach ($acList as $acList1) {
				echo "<option value='$acList1->department_name'>$acList1->department_name</option>";
			}
		} else {
			redirect('main', 'refresh');
		}
	}
	public function managePatents()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['user_data'] = $this->admin_model->getDetails('recruitment_users', $data['id'])->row();
			$data['pageTitle'] = "Manage Patents";
			$data['activeMenu'] = "dashboard";

			// Validation
			$this->form_validation->set_rules('application_number', 'Application Number', 'required');
			$this->form_validation->set_rules('title', 'Title of Patent', 'required');
			$this->form_validation->set_rules('applicants', 'Applicants', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['action'] = 'recruitment/managePatents';
				$data['details'] = $this->admin_model->getDetailsbyfield($data['id'], 'user_id', 'user_patents')->result();
				$this->rec_template->show('recruitment/manage_patents', $data);
			} else {
				$insertData = array(
					'user_id' => $data['id'],
					'application_number' => $this->input->post('application_number'),
					'title' => $this->input->post('title'),
					'applicants' => $this->input->post('applicants'),
					'status' => $this->input->post('status'),
					'filed_date' => $this->input->post('filed_date'),
					'published_date' => $this->input->post('published_date'),
					'granted_date' => $this->input->post('granted_date'),
					'created_at' => date('Y-m-d H:i:s')
				);

				$result = $this->admin_model->insertDetails('user_patents', $insertData);

				if ($result) {
					$this->session->set_flashdata('message', 'Patent details saved successfully.');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Failed to save patent details. Try again.');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/managePatents', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function updatePatent($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Update Patent";
			$data['activeMenu'] = "dashboard";

			// Validation rules
			$this->form_validation->set_rules('application_number', 'Application Number', 'required');
			$this->form_validation->set_rules('title', 'Title of Patent', 'required');
			$this->form_validation->set_rules('applicants', 'Applicants', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Load existing patent details
				$data['action'] = 'recruitment/updatePatent/' . $id;
				$data['details'] = $this->admin_model->getDetails('user_patents', $id)->row();
				$this->rec_template->show('recruitment/update_patent', $data);
			} else {
				// Prepare update array
				$updateData = array(
					'application_number' => $this->input->post('application_number'),
					'title' => $this->input->post('title'),
					'applicants' => $this->input->post('applicants'),
					'status' => $this->input->post('status'),
					'filed_date' => $this->input->post('filed_date'),
					'published_date' => $this->input->post('published_date'),
					'granted_date' => $this->input->post('granted_date')
				);

				$result = $this->admin_model->updateDetails($id, $updateData, 'user_patents');

				if ($result) {
					$this->session->set_flashdata('message', 'Patent updated successfully.');
					$this->session->set_flashdata('status', 'alert-success');
				} else {
					$this->session->set_flashdata('message', 'Failed to update patent.');
					$this->session->set_flashdata('status', 'alert-danger');
				}

				redirect('recruitment/managePatents', 'refresh');
			}
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
	public function deletePatent($id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['candidate_name'] = $session_data['candidate_name'];
			$data['email'] = $session_data['email'];
			$data['pageTitle'] = "Delete Patent";
			$data['activeMenu'] = "dashboard";

			$this->admin_model->delDetails('user_patents', $id);

			$this->session->set_flashdata('message', 'Patent deleted successfully.');
			$this->session->set_flashdata('status', 'alert-success');

			redirect('recruitment/managePatents', 'refresh');
		} else {
			redirect('recruitment/timeout', 'refresh');
		}
	}
}
