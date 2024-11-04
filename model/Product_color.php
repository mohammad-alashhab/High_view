<?php
require_once ('Model.php');
class Product_color extends Model
{
    public function  __construct(){
        parent::__construct("product_color"); ///////////to establish the db connection form the parent
    }
}