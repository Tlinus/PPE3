<?php


class Task extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_task($idProject)
    {
        $query = $this->db->get_where('tache', array('id_projet' => $idProject));
        return $query->result();
    }

    public function get_all_task_done($idProject)
    {
        $query = $this->db->get_where('tache', array('id_projet' => $idProject, 'done' => 1));
        return $query->result();
    }


    public function get_task($id = false, $idProject)
    {
        if($id == false)
        {
            $data = array(
                'id_projet'     =>  $idProject,
                'is_sstache'    =>  0
            );
            $query = $this->db->get_where('tache', $data);
            return $query->result();
        }

        $data = array(
            'id_projet'     =>  $idProject,
            'id'            =>  $id,
            'is_sstache'    =>  0
        );
            $query = $this->db->get_where('tache', $data);
            return $query->result();
    }

    public function get_mini_task($id = false, $idProject)
    {
        if($id == false)
        {
            $data = array(
                'id_projet'     =>  $idProject,
                'is_sstache'    =>  1
            );
            $query = $this->db->get_where('tache', $data);
            return $query->result();
            }

        $data = array(
            'id_projet'     =>  $idProject,
            'sous_tache_id' =>  $id,
            'is_sstache'    =>  1
        );
        $query = $this->db->get_where('tache', $data);
        return $query->result();

    }

    public function set_task($data, $mini = false)
    {
        if ($mini == false)
        {
            return $this->db->insert('tache', $data);
        }

        return $this->db->insert('tache', $data);

    }

    public function last_id()
    {
        return $this->db->insert_id();
    }

    public function update_task($data, $id)
    {
        return $this->db->update('tache', $data, array('id' => $id));
    }

    public function delete_task($id_project)
    {
        return $this->db->delete('tache', array('id_projet' => $id_project));
    }

    public function done_task($id)
    {
        $data = array(
            'done'  =>  1
        );
        return $this->db->update('tache', $data, array('id' =>  $id));
    }

}