<!DOCTYPE html><?php session_start() ?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Titre</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style_projet.css" />
    </head>

    <body>
        <?php

            require_once 'database.php';

        ?>
        <header class="container-fluid">
            <nav class="navbar navbar-default navbar-fixed-top row">
                <a href="index_menu.html" class="col-md-8">
                    <img src=image/picto_menu.png class="logomenu" alt="menu">
                </a>
                <a href="admin/index_contact.php" class="col-md-1">
                    <img src=image/picto_contact.png class="logo1" alt="contact">
                </a>
                <a href="index_projet2.php" class="col-md-1">
                    <img src=image/picto_moon.png class="logo" alt="mode nuit">
                </a>
            </nav>
        </header>
        <main class="mb-5">
            <?php

                $req = $db->query('SELECT * FROM article');

                $article = $req->fetchAll();
            
            ?>
            
            <div class="row ml-5 mt-5 mr-5">

                <?php foreach ($article as $article): ?>

                        <div class="col-1 p-0 pl-5 mb-5">
                                <img src=<?= $article['file_url1'] ?> class="carreblanc" alt="miniature">
                        </div>
                        <div class="col-3 p-0">
                                <h2 class="petit"><?= $article['name'] ?></h2>
                                <h2 class="petit"><?= $article['extrait'] ?></h2>
                                <a href="single_article.php?id=<?= $article['id'] ?>">
                                    <button class="grd">Voir plus</button>
                                </a>
                        </div>

                <?php endforeach ?>
                <?php if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])): ?>
                <a href="creation_article.php">
                    <img src=image/creation.png class="buttonadmin" alt="add">
                </a>
                <?php endif ?>

            </div>
        </main>
    </body>
    <footer>
        <div class="container-fluid footer">
            <div class="col-12">
                <p class="fin">Copyright 2019 Alexandre Luneau. All rights reserved.</p>
            </div>
        </div>
    </footer>
</html>