<?php
    session_start();
    if ($_SESSION['connecte'] == true && $_SESSION['role'] == 'admin') {

        require '../layout/header.php';
        require_once ('../classes/Etudiant.php');

        extract($_POST);
        $valid = true;
        
        if (isset($_POST['ajouter']))
        {
            $nom  = htmlentities(Strtoupper(trim($nom)));
            $prenom = htmlentities(Strtoupper(trim($prenom)));
            $formation = htmlentities(trim($formation));
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
            $er_formation = "Veuillez sélectionner une formation";
        }

        if($valid)
        {
            $DB->insert("INSERT INTO etudiant (nom, prenom, formation) VALUES (?, ?, ?)", array($nom, $prenom, $formation));
            header('Location: admin.php');
            exit;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ajouter</title>
    </head>
    <body>
        <div>Inscription</div>
        <form method="post">

            <?php
                if (isset($er_nom))
                {
            ?>
                    <div><?= $er_nom ?></div>
            <?php   
                }
            ?>

            <input type="text" placeholder="Nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required>   
            
            <?php
                if (isset($er_prenom))
                {
            ?>
                    <div><?= $er_prenom ?></div>
            <?php   
                }
            ?>

            <input type="text" placeholder="Prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>" required>

            <?php
                if (isset($er_formation))
                {
            ?>
                    <div><?= $er_formation ?></div>
            <?php   
                }
            ?>
            <select id="formation" name="formation" value="<?php if(isset($formation)){ echo $formation; }?>" required>
                <option value="DUT1 TPA">DUT1 TPA</option>
                <option value="DUT1 TPB">DUT1 TPB</option>
                <option value="DUT1 TPC">DUT1 TPC</option>
                <option value="DUT1 TPD">DUT1 TPD</option>
                <option value="DUT1 TPE">DUT1 TPE</option>
                <option value="DUT2 TPA">DUT2 TPA</option>
                <option value="DUT2 TPB">DUT2 TPB</option>
                <option value="DUT2 TPC">DUT2 TPC</option>
                <option value="DUT2 S3 APP">DUT2 S3 APP</option>
                <option value="DUT2 S4 APP">DUT2 S4 APP</option>
                <option value="LP DIM APP">LP DIM APP</option>
                <option value="LP DIM FI">LP DIM FI</option>
            </select>


            <button type="submit" name="ajouter">Ajouter</button>
        </form>
    </body>