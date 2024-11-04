<?php
require_once ('Model.php');
class User_reviews extends Model
{
    public function  __construct(){
        parent::__construct("user_review"); ///////////to establish the db connection form the parent
    }
}