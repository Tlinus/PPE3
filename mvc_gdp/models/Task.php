<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 10/02/16
 * Time: 11:16
 */

namespace App\Models;
use App\Core\DB;

class Task
{

    private $_id;
    private $_name;
    private $_commentaire;
    private $_sous_tache;
    private $_sous_tache_id;
    private $_complete;

    public function __construct($_id, $_name, $_commentaire, $_sous_tache, $_sous_tache_id, $_complete)
    {

        $this->_id = $_id;
        $this->_name = $_name;
        $this->_commentaire = $_commentaire;
        $this->_sous_tache = $_sous_tache;
        $this->_sous_tache_id = $_sous_tache_id;
        $this->_complete = $_complete;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getComplete()
    {
        return $this->_complete;
    }

    /**
     * @param mixed $complete
     */
    public function setComplete($complete)
    {
        $this->_complete = $complete;
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
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->_commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->_commentaire = $commentaire;
    }

    /**
     * @return mixed
     */
    public function getSousTache()
    {
        return $this->_sous_tache;
    }

    /**
     * @param mixed $sous_tache
     */
    public function setSousTache($sous_tache)
    {
        $this->_sous_tache = $sous_tache;
    }

    /**
     * @return mixed
     */
    public function getSousTacheId()
    {
        return $this->_sous_tache_id;
    }

    /**
     * @param mixed $sous_tache_id
     */
    public function setSousTacheId($sous_tache_id)
    {
        $this->_sous_tache_id = $sous_tache_id;
    }



}