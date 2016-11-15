<?php


class Search extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        //models
        $this->load->model('user');

        $sessiondata = $this->session->userdata('logged_in');
        if( ! $sessiondata['loginuser'] OR  ! $sessiondata['type'] == 2 OR ! $sessiondata['type'] == 1)
        {
            redirect('');
        }
    }

    function get_user($id)
    {
        echo json_encode($this->user->get_user($id));
    }

    public function autocomplete()
    {
        $sessiondata = $this->session->userdata('logged_in');
        $search_user = $this->input->post('searchUser');
        $query = $this->user->get_autocomplete($search_user);

        foreach ($query->result() as $row):

            if ($sessiondata['type'] == 2)
            {
                echo '<p><a id="'. $row->id .'" onclick="getUser(this.id)" data-toggle="modal" data-target="#editUser" href="">
                     '.$row->nom. ' ' . $row->prenom. '
                     </a></p><hr>';
            }
            if ($sessiondata['type'] == 1)
            {
                echo '<p><a id="'. $row->id .'" class="addUser" onclick="addUser(this.id)" data-toggle="modal" data-target="#seeUser" href="">
                     '.$row->nom. ' ' . $row->prenom.
                     '</a></p><hr>';
            }
        endforeach;

    }

}