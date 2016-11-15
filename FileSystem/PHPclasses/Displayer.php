<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Displayer
 *
 * @author pascal
 */
class Displayer {
    private $file;
    public function __construct(File $file){
        $this->file=$file;
    }
    public function display(){
        switch($this->file->getType()){
            case 'FileImage':
                $this->displayImage();
            break;
            case 'FileCode':
                $this->displayCode();
            break;
            case 'FileVideo':
                $this->displayVideo();
            break;
            case 'FileAudio':
                $this->displayAudio();
            break;
        }
    }

    private function displayImage(){
        echo '<img id="displayerImg" src="'.substr($this->file->getSource(),3).'"/>';
    }
    private function displayCode(){
        $code='<PRE class="prettyprint linenums=1" >';
        $code.= htmlspecialchars(file_get_contents($this->file->getSource()));
        $code.='<PRE>';
        $code.='<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang='.pathinfo($this->file->getSource(), PATHINFO_EXTENSION).'&skin=doxy""></script>';
        echo $code;
    }
    private function displayVideo(){
        $extension=pathinfo($this->file->getSource(), PATHINFO_EXTENSION);
        if($extension == 'mp4'){
            echo '<video controls><source src="'.substr($this->file->getSource(),3).'" type="video/mp4" /></video>';
        }
        else{
            echo 'This file extension is not supported';
        }
    }
    private function displayAudio(){
        $code.='<audio controls>
                    <source src="'.substr($this->file->getSource(),3).'" />
                </audio>';
        echo $code;
    }
}
