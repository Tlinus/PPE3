<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
 // header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
 // header('Content-Disposition: attachment; filename="'.$bdd_infos['up_final'].'"'); //Nom du fichier
  //header('Content-Length: '.$bdd_infos['up_filesize']); //Taille du fichier
 
//Envoi du fichier dont le chemin est passé en paramètre
 // readfile($bdd_infos['up_filename']);
/**
 * Description of Downloader
 *
 * @author pascal
 */
class Downloader {
    
    public static function setDownload($uploadlink,$fileSize,$uploadName,$type){
        
        header('Content-Type: application/'.pathinfo($uploadName, PATHINFO_EXTENSION).'');
        header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
        header('Content-Type: '.$type);
        header('Content-Disposition: attachment; filename='.$uploadName); //Nom du fichier
        header('Content-Length:'.$fileSize); //Taille du fichier_
        return readfile($uploadlink);
       
    }
}

