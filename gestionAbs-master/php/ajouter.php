<?php
    session_start();
    if ($_SESSION['connecte'] == true && $_SESSION['role'] == 'admin') {

        require '../layout/header.php';
        require_once ('../classes/Etudiant.php');

        if (isset($_POST['ajouter']))
        {
            $nom  = htmlentities(Strtoupper(trim($nom)));
            $prenom = htmlentities(Strtoupper(trim($prenom)));
            $formation = htmlentities(trim($mail));
        }
        if(empty($nom))
        {
            $valid = false;
            $er_nom = ("Veuillez entrer un nom");
        }       

        if(empty($prenom))
        {
            $valid = false;
            $er_prenom = ("Veuillez entrer un prénom");
        }       

        if(empty($formation))
        {
            $valid = false;
            $er_mail = "Veuillez sélectionner une formation";
        }

        if($valid)
        {
            $DB->insert("INSERT INTO etudiant (nom, prenom, formation) VALUES (?, ?, ?)", array($nom, $prenom, $formation));
            header('Location: admin.php');
            exit;
        }
    }
?>