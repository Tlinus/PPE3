<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 10/02/16
 * Time: 11:24
 */

namespace App\Models;
use App\Core\DB;

class Project
{

    private $_id;
    private $_titre;
    private $_dead_line;
    private $_task_list;

    /**
     * Project constructor.
     * @param $_id
     * @param $_titre
     * @param $_dead_line
     * @param $_task_list
     */
    public function __construct($_id, $_titre, $_dead_line)
    {
        $this->_id = $_id;
        $this->_titre = $_titre;
        $this->_dead_line = $_dead_line;
        $tasks = DB::getInstance()->query('SELECT * FROM tache WHERE id_projet = ?',[$_id]);
        foreach($tasks as $task){
            $this->_task_liste []= new Task($task['id'],$task['intitule'],$task['commenntaire'],$task['is_sstache'],$task['sous_tache_id'],$task['done']);
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->_titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->_titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDeadLine()
    {
        return $this->_dead_line;
    }

    /**
     * @param mixed $dead_line
     */
    public function setDeadLine($dead_line)
    {
        $this->_dead_line = $dead_line;
    }

    /**
     * @return mixed
     */
    public function getTaskListe()
    {
        return $this->_task_list;
    }

    /**
     * @param mixed $task_list
     */
    public function setTaskListe($task_list)
    {
        $this->_task_list = $task_list;
    }

    


}