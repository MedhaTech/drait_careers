<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Adminrec_template {
    function show($view, $data = array())
    {
        // Get current CI Instance
        $CI = & get_instance();
 
        // Load template views
        $CI->load->view('recruitment/template/admin_header', $data);
        $CI->load->view($view, $data);
        $CI->load->view('recruitment/template/admin_footer', $data);
    }
}
 
/* End of file Template.php */