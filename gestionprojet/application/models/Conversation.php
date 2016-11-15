<?php

class Conversation extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function setConversation($idProject){
        $data = [
            'participant'=>'&',
            'id_projet'=> $idProject
        ];

        return $this->db->insert('conversation',$data);
    }

    public function getConversation($idProject){
        $q=$this->db->get_where('conversation',array('id_projet'=>$idProject));
        return $q->row();
    }

    public function getMessages($idConversation){
        $this->db->select('*');
        $this->db->from('message');
        $this->db->join('utilisateur','utilisateur.id = message.id_utilisateur');
        $this->db->where('id_conversation',$idConversation);
        $this->db->order_by('date_message','asc');
        return $this->db->get();
    }

    public function deleteConversation($idProject){
        return $this->db->delete('conversation',array('id'=>$idProject));
    }

    public function addUser($idProject,$idUser){
        $data = $this->getConversation($idProject);
        $data->participant = $data->participant.' '.$idUser.' &';
        return $this->db->update('conversation', $data, array('id' => $data->id));
    }

    public function removeUser($idProject,$idUser){
        $data = $this->getConversation($idProject);
        $data->participant = preg_replace('/(& '.$idUser.' &)/','&',$data->participant);
        return $this->db->update('conversation', $data, array('id' => $data->id));
    }

}