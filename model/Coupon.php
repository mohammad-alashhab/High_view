<?php
require_once ('Model.php');
class Coupon extends Model
{
    public function  __construct(){
        parent::__construct("coupon"); ///////////to establish the db connection form the parent
    }


    public function couponValid ($code)
    {
        $stmt =$this->pdo->prepare("select * from coupon where `promocode` = :code and NOW() <`expiry_date` ");
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $coupon = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a coupon was found
        if ($coupon) {
            return $coupon; // Return the coupon details
        } else {
            return false; // No valid coupon found
        }

    }
    public function getCoupon($code){
        $stmt =$this->pdo->prepare("select `percentage` from coupon where `promocode` = :code");
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $coupon = $stmt->fetch(PDO::FETCH_ASSOC);
        return $coupon;
    }

}