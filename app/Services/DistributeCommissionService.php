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
        $ancestors = $user->ancestors
            ->reverse()
            ->take(count(config('commission.plan')))
            ->values();

        $plan = config('commission.plan');

        for ($count = 0; $count < count(config('commission.plan')); $count++) {

            $incrementdCounter = $count + 1;

            $commission = (1000 * $plan[$incrementdCounter]) / 100;

            $ancestors
                ->get($count)
                ->commissions()
                ->create([
                    'from_user_id' => $user->id,
                    'level' => $incrementdCounter,
                    'amount' => $commission
                ]);

        }
    }

}
