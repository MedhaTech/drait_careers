<?php defined('BASEPATH') or exit('No direct script access allowed');



class Email_model extends CI_Model
{


    public function send_email($to, $data, $type)
    {
        $this->load->library('email');

        $email_config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'erpoffice@bmsce.ac.in',
            'smtp_pass' => 'Bmsce@1946!',
            'mailtype'  => 'html',
            'wordwrap'  => TRUE ,
            'starttls'  => true,
            'newline'   => "\r\n"
        );

        $this->load->library('email', $email_config);
        //Email content
  
        $this->email->set_header('Content-Type', 'text/html');
        $this->email->to($to);
        $this->email->from('erpoffice@bmsce.ac.in', 'BMSCE');

        if ($type == "activation") {
            $this->email->subject('BMSCE - Account Activation');
            $htmlContent = $this->load->view('mail/activation', $data, true);
        } elseif ($type == "success") {
              $this->email->subject('BMSCE - Account Activated');
            $htmlContent = $this->load->view('mail/success', $data, true);
        } elseif ($type == "forgot") {
              $this->email->subject('BMSCE - Forgot Password');
            $htmlContent = $this->load->view('mail/forgot', $data, true);
        }
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();
        $errors = $this->email->print_debugger();
      
    }
     public function get_user_by_token($token)
    {
        $sql = "SELECT * FROM recruitment_users WHERE recruitment_users.token = ?";
        $query = $this->db->query($sql, array($token));
        return $query->row();
    }
        public function verify_email($user)
    {
       
        if (!empty($user)) {
            $data = array(
                'email_verified' => '1'
            );
            $this->db->where('id', $user->id);
            return $this->db->update('recruitment_users', $data);
            
        }
        return false;
    }
        public function get_user_by_email($email)
    {
        $sql = "SELECT * FROM recruitment_users WHERE recruitment_users.email = ?";
        $query = $this->db->query($sql, array($email));
        return $query->row();
    }
    
    
    public function upload_files() {
  // Check if user has uploaded any file
  if (!empty($_FILES['files']['name'][0])) {

    // Set upload path
    $upload_path = './uploads/documents/';

    // Initialize an empty array to store the file names
    $file_names = array();

    // Loop through each file and upload it to the server
    for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

      // Generate unique file name to avoid overwriting files with the same name
      $uniq_file_name = uniqid() . '_' . $_FILES['files']['name'][$i];

      // Set file upload destination
      $destination = $upload_path . $uniq_file_name;

      // Upload file to the server
      if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $destination)) {
        // Add file name to array
        $file_names[] = $uniq_file_name;
      }
    }

    // Save file names to JSON array
    $json_array = json_encode($file_names);
    // Do something with $json_array
  }
}

        public function update_menu_flag($user,$flag)
    {
       
        if (!empty($user)) {
            $data = array(
                'menu_flag' => $flag
            );
            $this->db->where('id', $user);
            $this->db->update('recruitment_users', $data);
            return true;
        }
        return false;
    }

    
}
