<?php


namespace App\Services;


use App\User;

class DistributeCommissionService
{

    private static $instance;

    /**
     * @return mixed
     */
    public static function getInstance(): DistributeCommissionService
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function distribute(User $user)
    {

    }

}
