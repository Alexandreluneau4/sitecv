<?php

    session_start();
    header('location:index_contact.php');
    $_SESSION = array();
    session_destroy();

?>