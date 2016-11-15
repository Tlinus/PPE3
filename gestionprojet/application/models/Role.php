<?php


class Role extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_role($id_project = false, $id_user = false)
    {
        if ($id_user == false && $id_project)
        {
            $this->db->select('*');
            $this->db->from('role');
            $this->db->join('utilisateur', 'utilisateur.id = role.id_utilisateur');
            $this->db->where(array('id_projet' => $id_project));
            $query = $this->db->get();
            return $query->result();
        }
        if ($id_project == false && $id_user)
        {
            $this->db->select('*');
            $this->db->from('role');
            $this->db->join('projet', 'projet.id = role.id_projet');
            $this->db->where(array('id_utilisateur' => $id_user));
            $query = $this->db->get();
            return $query->result();
        }
    }

    public function get_id_project($id)
    {
        $this->db->select('id_projet');
        $this->db->from('role');
        $this->db->where(array('id_utilisateur' => $id));
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_role($id, $project = false)
    {
        if($project == false)
        {
            return $this->db->delete('role', array('id_utilisateur' => $id));
        }
        return $this->db->delete('role', array('id_projet' => $id));
    }

    public function set_role($id, $id_project, $fonction)
    {
        $data = array(
            'id_utilisateur'        =>  $id,
            'id_projet'             =>  $id_project,
            'fonction_attribue'     =>  $fonction
        );
        return $this->db->insert('role', $data);
    }

}