<?php
 function dd($args){
     echo '<pre>';
     var_dump($args);
    echo '</pre>';
    die();
 }

 function  show($stuff){ ////////////////we usually pass the post and get global variables to te show function
     echo '<pre>';
     print_r($stuff);
     echo '</pre>';
 }

