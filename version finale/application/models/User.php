<?php


class User extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function login()
    {
        $query = $this->db->get_where('utilisateur', array('email' =>  $this->input->post('email')));
        return $query->row();
    }

    public function get_user($id)
    {
        $query = $this->db->get_where('utilisateur', array('id' =>  $id));
        return $query->row();
    }

    public function get_autocomplete($search_user) {
        $this->db->select('nom');
        $this->db->select('prenom');
        $this->db->select('id');
        $this->db->like('nom', $search_user);
        $this->db->like('prenom', $search_user);
        return $this->db->get('utilisateur', 10);
    }

    public function set_user()
    {
        $data = array(
            'nom'       =>  $this->input->post('lastname'),
            'prenom'    =>  $this->input->post('firstname'),
            'mdp'       =>  $this->input->post('password'),
            'email'     =>  $this->input->post('email'),
            'fonction'  =>  $this->input->post('fonction'),
            'avatar'    =>  $this->input->post('avatar'),
            'is_admin'  =>  $this->input->post('type')
        );
        return $this->db->insert('utilisateur', $data);
    }

    public function update_user($id)
    {
        $data = array(
            'nom'       =>  $this->input->post('lastname'),
            'prenom'    =>  $this->input->post('firstname'),
            'mdp'       =>  $this->input->post('password'),
            'email'     =>  $this->input->post('email'),
            'fonction'  =>  $this->input->post('fonction'),
            'avatar'    =>  $this->input->post('avatar'),
            'is_admin'  =>  $this->input->post('type')
        );
        return $this->db->update('utilisateur', $data, array('id' => $id));
    }

    public function delete_user($id)
    {
        return $this->db->delete('utilisateur', array('id' => $id));
    }

    public function set_avatar($link, $id)
    {
        $data = array(
            'avatar'    =>  $link
        );
        return $this->db->update('utilisateur', $data, array('id' => $id));
    }

}