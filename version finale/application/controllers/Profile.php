<?php


class Profile extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        //models
        $this->load->model('role');
        $this->load->model('project');
        $this->load->model('task');
        $this->load->model('user');
    }

    public function set_avatar()
    {
        //Get User ID
        $sessiondata = $this->session->userdata('logged_in');
        $id_user = $sessiondata['id'];

        $link = $this->input->post('avatar');

        if($this->user->set_avatar($link, $id_user)){
            $this->session->set_flashdata('success', 'avatar changed');
        }
        else
        {
            $this->session->set_flashdata('error', 'sorry try again later');
        }

        if ($sessiondata['type'] == 0):
            redirect('user');
            endif;

        if ($sessiondata['type'] == 1):
            redirect('chef');
            endif;

        if ($sessiondata['type'] == 2):
            redirect('admin');
            endif;

    }
}