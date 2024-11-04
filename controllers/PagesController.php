<?php

class PagesController
{
public function aboutUs(){
    require 'views/pages/about.view.php';
}

public function showterms(){
    require 'views/pages/termsOfService.view.php';
}

public function delivery(){
    require 'views/pages/deliveryRate.php';
}
}