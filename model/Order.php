<?php
require_once ('Model.php');
class Order extends Model
{
    public function  __construct(){
        parent::__construct("orders"); ///////////to establish the db connection form the parent
    }
}