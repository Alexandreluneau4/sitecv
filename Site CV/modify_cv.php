<?php session_start() ?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Titre</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style_single_article.css" />
    </head>
    
    <body>
        <?php

        require_once 'database.php';
        require_once 'function.php';

        if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
            header('location:index_acceuil');
        }

        if(!empty($_FILES)){
            $file_name = $_FILES['fichier']['name'];
            $file_extension = strrchr($file_name, ".");
            $file_tmp_name = $_FILES['fichier']['tmp_name'];
            $file_dest = 'files/'.$file_name;

            $extensions_autorisees = array('.jpg', '.JPG');

            if(in_array($file_extension, $extensions_autorisees)){
                if(move_uploaded_file($file_tmp_name, $file_dest)){

                    $req = $db->prepare('INSERT INTO cv (url) VALUES (?)');
                    $req->execute(array($file_dest));

                    $message = 'Votre article a bien été envoyé !';
                    header('location:index_cv.php');
                }
                else{
                    echo "Une erreur est survenue lors de l'envoi des fichiers";
                }
            }
            else{
                echo 'Seuls les fichiers pdf, png et jpg sont autorisés';
            }
        }
        else{
            $message = 'Veuillez remplir tous les champs';
        }
        
        ?>  
        <header class="container-fluid">
            <nav class="navbar navbar-default navbar-fixed-top row">
                <a href="index_menu.html" class="col-md-8">
                    <img src=image/picto_menu.png class="logomenu" alt="menu">
                </a>
                <a href="admin/index_contact.php" class="col-md-1">
                    <img src=image/picto_contact.png class="logo1" alt="contact">
                </a>
                <div class="col-md-1">
                    <img src=image/picto_moon.png class="logo" alt="mode nuit">
                </div>
            </nav>
        </header>
        <div class="container-fluid pt-5 pb-5">
            <h3>Modification du cv</h3>
            <h4>L'image doit se nommer "cv.jpg"</h4>
            <?php
            if (isset($_SESSION['flash']['success'])){
                echo "<div class='success'>".$_SESSION['flash']['success'].'</div>';
            }
            if (isset($_SESSION['flash']['error'])){
                echo "<div class='error'>".$_SESSION['flash']['success'].'</div>';
            }
            ?>
            <form method="POST" enctype="multipart/form-data">
                <?php if(isset($message)){ echo $message; } ?>
                <input type="file" name="fichier"/>
                <input type="submit" value="Envoyer les donnees">
            </form>
        </div>
        <footer>
            <div class="container-fluid footer">
                <div class="col-12">
                    <p class="fin">Copyright 2018 IIM Company. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>