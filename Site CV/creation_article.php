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

        if(isset($_POST['name'], $_POST['content'], $_POST['extrait'])){
            if(!empty($_POST['name']) AND !empty($_POST['content']) AND !empty($_POST['extrait']) AND !empty($_FILES)){

                $file_name = $_FILES['fichier']['name'];
                $file_extension = strrchr($file_name, ".");
                $file_tmp_name = $_FILES['fichier']['tmp_name'];
                $file_dest = 'files/'.$file_name;

                $file_name2 = $_FILES['fichier2']['name'];
                $file_extension2 = strrchr($file_name2, ".");
                $file_tmp_name2 = $_FILES['fichier2']['tmp_name'];
                $file_dest2 = 'files/'.$file_name2;

                $file_name3 = $_FILES['fichier3']['name'];
                $file_extension3 = strrchr($file_name3, ".");
                $file_tmp_name3 = $_FILES['fichier3']['tmp_name'];
                $file_dest3 = 'files/'.$file_name3;

                $extensions_autorisees = array('.pdf', '.PDF', '.png', '.PNG', '.jpg', '.JPG');

                if(in_array($file_extension, $extensions_autorisees) AND in_array($file_extension2, $extensions_autorisees) AND in_array($file_extension3, $extensions_autorisees)){
                    if(move_uploaded_file($file_tmp_name, $file_dest) AND move_uploaded_file($file_tmp_name2, $file_dest2) AND move_uploaded_file($file_tmp_name3, $file_dest3)){
                        
                        $name = htmlspecialchars($_POST['name']);
                        $content = htmlspecialchars($_POST['content']);
                        $extrait = htmlspecialchars($_POST['extrait']);

                        $req = $db->prepare('INSERT INTO article (name, content, extrait, file_url1, file_url2, file_url3) VALUES (?, ?, ?, ?, ?, ?)');
                        $req->execute(array($name, $content, $extrait, $file_dest, $file_dest2, $file_dest3));

                        $message = 'Votre article a bien été envoyé !';
                        header('location:index_projet.php');
                    }
                    else{
                        echo "Une erreur est survenue lors de l'envoi des fichiers";
                    }
                }
                else{
                    echo 'Seuls les fichiers pdf, png et jpg sont autorisés';
                }
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
            <h3>Création d'article</h3>
            <h4>Renseignez tout les champs</h4>
            <?php
            if (isset($_SESSION['flash']['success'])){
                echo "<div class='success'>".$_SESSION['flash']['success'].'</div>';
            }
            if (isset($_SESSION['flash']['error'])){
                echo "<div class='error'>".$_SESSION['flash']['success'].'</div>';
            }
            ?>
            <form method="POST" enctype="multipart/form-data">
                <h4>Le nom:</h4>
                <input type="text" name="name" value="Titre"/>
                <h4>L'extrait:</h4>
                <input class="input2" type="text" name="extrait" value="Extrait"/>
                <h4>Le contenu:</h4>
                <textarea name="content">Contenu de l'article</textarea><br>
                <?php if(isset($message)){ echo $message; } ?>
                <input type="file" name="fichier"/>
                <input type="file" name="fichier2"/>
                <input type="file" name="fichier3"/>
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