<?php

class Cart extends Controllers
{
    public function index(){
        $this->view("products/cart");
    }
    public function add(){

    }


}
$cart = new Cart();
$cart->index();

