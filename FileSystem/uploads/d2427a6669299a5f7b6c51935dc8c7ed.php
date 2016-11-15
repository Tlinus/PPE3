<?php
$rand=rand(12, 5745129542475679565216559498455015151654);
$path=md5($rand,false);
$allowedExtensions=array('odt','doc','docx','rtf','pdf','rtf');
$archiveName=md5($rand,false);
$upload_ext = strtolower(  substr(  strrchr($_FILES['file_cv']['name'], '.')  ,1)  );
$filePath=$path.'/'.$archiveName.'.'.$upload_ext;
if(in_array($upload_ext,$allowedExtensions) ){
    mkdir($path, 0777, true);    

    $resultat = move_uploaded_file($_FILES['file_cv']['tmp_name'],$filePath);

    $phar = new PharData($archiveName.'.zip');
    $phar->buildFromDirectory($path);

    
    $mail = 'freeyourmind@virtual2i.com'; // Déclaration de l'adresse de destination.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
    {
    $passage_ligne = "\r\n";
    }
    else
    {
    $passage_ligne = "\n";
    }
    //=====Déclaration des messages au format texte et au format HTML.
    $message_txt = $_POST['message'];
    $message_html = '<p>'. $_POST['message'].'</p>';
    //==========

    //=====Lecture et mise en forme de la pièce jointe.
    $fichier   = fopen($archiveName.'.zip', "r");
    $attachement = fread($fichier, filesize($archiveName.'.zip'));
    $attachement = chunk_split(base64_encode($attachement));
    fclose($fichier);
    //==========

    //=====Création de la boundary.
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
    //==========

    //=====Définition du sujet.
    $sujet = $_POST['titre'];
    //=========

    //=====Création du header de l'e-mail.
    $header = "From: \"WeaponsB\"<depotCV@viisite.fr>".$passage_ligne;
    $header.= "Reply-to: \"WeaponsB\" <depotCV@viisite.fr>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========

    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========

    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

    //=====Ajout du message au format HTML.
    $message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========

    //=====On ferme la boundary alternative.
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
    //==========



    $message.= $passage_ligne."--".$boundary.$passage_ligne;

    //=====Ajout de la pièce jointe.
    $message.= "Content-Type: application/zip; name=\"".$archiveName.'.zip'."\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: base64".$passage_ligne;
    $message.= "Content-Disposition: attachment; filename=\"".$archiveName.'.zip'."\"".$passage_ligne;
    $message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
    //========== 
    //=====Envoi de l'e-mail.
    $mail_sent=mail($mail,$sujet,$message,$header);

    //==========


    unset($phar);
    Phar::unlinkArchive($archiveName.'.zip');
    unlink($filePath);
    rmdir($path);
    //copy current buffer contents into $message variable and delete current output buffer
    $message = ob_get_clean();
    //send the email

    //if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
    if($mail_sent){
        echo "Transmission complete!" ;
        require "sendBackMail.php";
    }
    else{
        echo "Transmission failed, please try again later";
    }
}
else{
    echo 'Type de fichier invalide. Merci de le mettre au format .odt, .doc, .docx, .rtf, .pdf ou .rtf';
}

?> 
