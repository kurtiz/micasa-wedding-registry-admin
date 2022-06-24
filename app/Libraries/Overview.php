<?php
namespace App\Libraries;

class Overview {
    function overview($today, $month)
    {
        $quantity = 0;
        $amount = 0;
        $results = false;

        if ($today) {
            foreach ($today as $key => $x) {
                $quantity += (float)$x["quantity"];
                $amount += (float)$x["amount"];
            }
            $results['today_quantity'] = $quantity;
            $results['today_amount'] = $amount;
        }else{
            $results['today_quantity'] = $quantity;
            $results['today_amount'] = $amount;
        }

        $quantity = 0;
        $amount = 0;
        if ($month) {
            foreach ($month as $key => $x) {
                $quantity += (float)$x["quantity"];
                $amount += (float)$x["amount"];
            }
            $results['month_quantity'] = $quantity;
            $results['month_amount'] = $amount;
        }else{
            $results['month_quantity'] = $quantity;
            $results['month_amount'] = $amount;
        }

        return $results;
    }
}