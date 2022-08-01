<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
    public function page() {
        $data['title'] = "Your title";
        $this->load->view('blogview');
        $this->load->view('templates/footer');
    }
    public function comment() {
        echo "I am There";
    }
}


?>