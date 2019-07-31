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
        <link rel="stylesheet" href="style_single_article2.css" />
    </head>
    
    <body>
        <?php

        require_once 'database.php';
        require_once 'function.php';

        $article = getArticle($db,1, $_GET['id']);

        ?>  
            <header class="container-fluid">
                    <nav class="navbar navbar-default navbar-fixed-top row">
                        <a href="index_menu2.html" class="col-md-8">
                            <img src=image/picto_menu2.png class="logomenu" alt="menu">
                        </a>
                        <a href="admin/login2.php" class="col-md-1">
                            <img src=image/picto_contact2.png class="logo1" alt="contact">
                        </a>
                        <a href="single_article.php" class="col-md-1">
                            <img src=image/picto_moon2.png class="logo" alt="">
                        </a>
                    </nav>
                </header>
        <div class="container-fluid pt-5 pb-5">
            <div class="row">
                <?php

                /*echo $_GET['id'];*/

                ?>
                <h1><?= $article->name ?></h1>
            </div>
            <div class="row ml-4">
                <img src=<?= $article->file_url1 ?> class="carreblanc m-5" alt="">
                <img src=<?= $article->file_url2 ?> class="carreblanc m-5" alt="">
                <img src=<?= $article->file_url3 ?> class="carreblanc m-5" alt="">
            </div>
            <div class="row">
                <p class="m-5"><?= $article->content ?></p>
            </div>
            <?php if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])): ?>
            <a href="delete_article.php?id=<?= $article->id ?>">
                <img src=image/delete.png class="buttonadmin" alt="delete">
            </a>
            <a href="modify_article.php?id=<?= $article->id ?>">
                <img src=image/modify.png class="buttonadmin" alt="modify">
            </a>
            <?php endif ?>
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