<?php
require_once ('Model.php');
class Discount extends Model
{
    public function  __construct(){
        parent::__construct("discount"); ///////////to establish the db connection form the parent
    }
}