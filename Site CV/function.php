<?php

function getArticle($db, $nb = null, $id = null){
    if ($nb AND !$id){
        $req = $db->query('SELECT * FROM article LIMIT'.$nb);
        $articles = $req->fetchAll();
    }
    elseif ($id){
        $req = $db->query('SELECT * FROM article WHERE id ='.$id);
        $articles = $req->fetchObject();
    }
    else{
        $req = $db->query('SELECT * FROM article');
        $articles = $req->fetchAll();
    }
    return $articles;
}
