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

        $article = getArticle($db,1, $_GET['id']);

        if (!isset($_GET['id'])){
            header('location:index_acceuil.html');
        }

        if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
            header('location:index_acceuil.html');
        }

        if (isset($_POST) AND !empty($_POST)){
            if (!empty($_POST['name']) AND !empty($_POST['content']) AND !empty($_POST['extrait'])){
                $req = $db->prepare('UPDATE article SET name = :name, content = :content, extrait = :extrait WHERE id= :id');
                $req->execute([
                    'name' => $_POST['name'],
                    'content' => $_POST['content'],
                    'extrait' => $_POST['extrait'],
                    'id' => $_GET['id'],
                ]);
                $_SESSION['flash']['success'] = 'Article posté !';
                header('location:index_projet.php');
            }
            else{
                $_SESSION['flash']['error'] = 'Champs manquants';
            }
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
                    <img src=image/picto_moon.png class="logo" alt="">
                </div>
            </nav>
        </header>
        <div class="container-fluid pt-5 pb-5">
            <h3>Modifier l'article "<?= $article->name ?>"</h3>
            <h4>Laissez vide si aucun changement</h4>
            <?php
            if (isset($_SESSION['flash']['success'])){
                echo "<div class='success'>".$_SESSION['flash']['success'].'</div>';
            }
            if (isset($_SESSION['flash']['error'])){
                echo "<div class='error'>".$_SESSION['flash']['success'].'</div>';
            }
            ?>
            <form method="POST">
                <h4>Le nom:</h4>
                <input type="text" name="name" value="<?= $article->name ?>"/>
                <h4>L'extrait:</h4>
                <input class="input2" type="text" name="extrait" value="<?= $article->extrait ?>"/>
                <h4>Le contenu:</h4>
                <textarea name="content"><?= $article->content ?></textarea>
                <button>Modifier</button>
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