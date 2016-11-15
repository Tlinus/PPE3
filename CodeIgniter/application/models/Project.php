<?php


class Project extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_project($id)
    {
        $query = $this->db->get_where('projet',array('id' => $id));
        return $query->row();
    }

    public function set_project()
    {
        $data = array(
            'titre'     =>  $this->input->post('title'),
            'dead_line' =>  $this->input->post('deadline')
        );
        return $this->db->insert('projet', $data);
    }

    public function last_id()
    {
        return $this->db->insert_id();
    }

    public function delete_project($id)
    {
        return $this->db->delete('projet', array('id' => $id));
    }
    public function addRoot($id){
        $data2 = array(
            'id' => null,
            'virtualName' =>'root',
            'parentDirectory' => null,
            'project' => $id,
            'date' => date("Y-m-d H:i:s")

        );
        if($this->db->insert('directory',$data2)){
            return true;

        }
        else{
            return false;
        }
    }

}