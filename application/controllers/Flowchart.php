<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Flowchart extends CI_Controller {

    public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->view('flowchart');
    }

}

/* End of file Flowchart.php */
