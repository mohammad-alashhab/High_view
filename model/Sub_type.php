<?php
require_once ('Model.php');
class Sub_type extends Model
{
    public function  __construct(){
        parent::__construct("subtype"); ///////////to establish the db connection form the parent
    }
}