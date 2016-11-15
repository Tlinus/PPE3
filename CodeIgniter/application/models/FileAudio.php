<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileAudio
 *
 * @author pascal
 */


class FileAudio extends File{
    public function __construct($path,$id,$virtualName,$source,$project,$type,$mime,$date){
        parent::__construct($path, $id, $virtualName, $source, $project, $type,$mime,$date);
        $this->_img=url_base('/assets/img/page_sound.gif');
        
    }
}
