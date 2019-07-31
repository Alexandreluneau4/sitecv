<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

session_start() 

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Titre</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../style_cv.css" />
    </head>
    
    <body>
        <?php

        require_once '../database.php';

        ?>
        <header class="container-fluid">
            <nav class="navbar navbar-default navbar-fixed-top row">
                <a href="../index_menu.html" class="col-md-8">
                    <img src=image/picto_menu.png class="logomenu" alt="menu">
                </a>
                <a href="login.php" class="col-md-1">
                    <img src=image/picto_contact.png class="logo1" alt="contact">
                </a>
                <a href="login2.php" class="col-md-1">
                    <img src=image/picto_moon.png class="logo" alt="mode nuit">
                </a>
            </nav>
        </header>

        <div class="container-fluid pt-5 pl-5">
            <div class="row pl-5">
            <div class="col-md-6">

            <h2>Se connecter</h2>
            <?php

            if (isset($_POST) AND !empty($_POST)){
                if (!empty(htmlspecialchars($_POST['username'])) AND !empty(htmlspecialchars($_POST['password']))){
                    $req = $db->prepare('SELECT * FROM user WHERE username = :username AND password = :password');

                    $req->execute([
                        'username' => $_POST['username'],
                        'password' => $_POST['password'],
                    ]);

                    $user = $req->fetchObject();

                    if ($user){
                        $_SESSION['admin'] = $_POST['username'];
                        header('location:index_contact.php');
                    }
                    else{
                        $error = '<p>Identifiants incorrect</p>';
                    }
                }
                else{
                    $error = '<p>Veuillez remplir tous les champs</p>';
                }
            }

            if (isset($error)){
                echo '<div class="error">'. $error .'</div>';
            }
            
            ?>
            <form action="login.php" method="POST">
                <input type="text" name="username"/>
                <input type="password" name="password"/>
                <button>Se connecter</button>
            </form>
            </div>
            <div class="col-md-6 divr">
                <h2>Comment me contacter:</h2>
                <p><br>Numéro de téléphone : 0760470412<br>
                Mail : alexandre.luneau@edu.devinci.fr<br>
                Adresse postale : 20bis rue dailly Saint-Cloud 92210 France</p>
            </div>
            </div>
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