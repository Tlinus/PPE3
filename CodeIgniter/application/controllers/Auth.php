<?php


class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->model('user');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    public function login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('error', 'wrong information try again');
            redirect('');
        }
        else
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->user->login();
            if($email == $result->email && $password == $result->mdp)
            {
                $sessiondata = array(
                    'id'        =>  $result->id,
                    'email'     =>  $email,
                    'type'      =>  $result->is_admin,
                    'loginuser' =>  true,
                    'name'      =>  $result->nom
                );
                $this->session->set_userdata('logged_in', $sessiondata);
                if($result->is_admin == 0)
                {
                    redirect('user');
                }
                if($result->is_admin == 1)
                {
                    redirect('chef');
                }
                if($result->is_admin == 2)
                {
                    redirect('admin');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'wrong information try again');
                redirect('');
            }

        }
    }

    function logout()
    {
        $this->session->set_flashdata('success', 'you have been logout');
        redirect('');
        $this->session->unset_userdata('logged_in');
        session_destroy();
    }

    function access()
    {
        if($this->session->userdata('logged_in', 'type') === "O")
        {
            $this->load->view('templates/header');
            $this->load->view('pages/user');
            $this->load->view('templates/footer');
        }
        else if ($this->session->userdata('logged_in', 'type') == 1)
        {
            $this->load->view('templates/header');
            $this->load->view('pages/chef');
            $this->load->view('templates/footer');
        }
        else if ($this->session->userdata('logged_in', 'type') == 2)
        {
            $this->load->view('templates/header');
            $this->load->view('pages/admin');
            $this->load->view('templates/footer');
        }
        else {
            $this->load->view('templates/header');
            $this->load->view('login');
            $this->load->view('templates/footer');
        }
    }

}