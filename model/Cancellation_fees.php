<?php
require_once ('Model.php');
class Cancellation_fees extends Model
{

    public function  __construct(){
        parent::__construct("cancellation_fees"); ///////////to establish the db connection form the parent
    }
}