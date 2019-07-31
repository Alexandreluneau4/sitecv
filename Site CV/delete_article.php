<?php 

session_start();

require_once 'database.php';

if (isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
    if (isset($_GET['id'])){
        $req = $db->query('SELECT * FROM article WHERE id = '.$_GET['id']);
            $article = $req->fetch();
            if ($article) {
                $req = $db->query('DELETE FROM article WHERE id = '.$_GET['id']);
                header('location:index_projet.php');
            }
            else{
                header('location:index_projet.php');
            }
    }
}
else{
    header('location:index_projet.php');
}

?>