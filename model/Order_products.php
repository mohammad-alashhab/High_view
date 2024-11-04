<?php
require_once ('Model.php');
class Order_products extends Model
{
    public function  __construct(){
        parent::__construct("order_products"); ///////////to establish the db connection form the parent
    }



}