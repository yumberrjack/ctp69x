<?php

    $obj->email = $_COOKIE['email'];
    $obj->fname = $_COOKIE['fname'];
    $obj->order = $_COOKIE['order'];
    
    $json = json_encode($obj);
    
    echo $json;

?>