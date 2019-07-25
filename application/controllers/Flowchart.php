<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Flowchart extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    
    public function index()
    {
        $this->load->view('flowchart');
    }
    public function collison($n)
    {
        $a = array(
            0 => 'collison/coba',
            1 => 'collison/collision-data-example',
            2 => 'collison/collision-example',
            3 => 'collison/collision-margin-example',
            4 => 'collison/protrusion-data-example',
            5 => 'collison/protrusion-example',
            6 => 'collison/protrusion-margin-example'
        );
        $this->load->view($a[$n]);
    }
    public function connect($n)
    {
        $this->load->view('connect/'.$n);
    }
}

/* End of file Flowchart.php */
