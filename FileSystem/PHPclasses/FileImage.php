<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileImage
 *
 * @author pascal
 */
class FileImage extends File {
    public function __construct($path,$id,$virtualName,$source,$project,$type,$mime,$date){
        parent::__construct($path, $id, $virtualName, $source, $project, $type,$mime,$date);
        $this->_img='img/image.gif';
        
    }
}
