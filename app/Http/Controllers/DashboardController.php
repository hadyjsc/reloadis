<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard = "Dashboard";
        return view('stisla-dashboard', compact('dashboard'));
    }

    public function product(Request $req)
    {
        $year = $req['year'] ? $req['year'] : date('Y');
        $month = $req['month'];
        $data = [];
        $monthArray = [];
        $daysArray = [];

        for ($m = 1; $m <= 12; $m++) {
            $monthArray[] = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
        }

        if ($year && $month) {
            $sql = "SELECT
                DATE(product_items.sold_at) AS sold_date,
                COUNT(product_items.id) AS total_sales,
                COALESCE(SUM(products.price), 0) AS total_price,
                COALESCE(SUM(products.fund), 0) AS total_fund
            FROM
                product_items
            JOIN
                products ON product_items.product_id = products.id
            WHERE
                YEAR(product_items.sold_at) = '".$year."' AND MONTH(product_items.sold_at) = '".$month."' AND
                products.category_id IN (1, 2, 3, 4, 5) AND
                product_items.is_sold = true
            GROUP BY
                DATE(product_items.sold_at)";

            $execute = DB::select($sql);

            $days = cal_days_in_month( 0, 05, 2023);
            for($d = 1; $d <= $days; $d++) {
                $time = mktime(12, 0, 0, $month, $d, $year);
                if (date('m', $time) == $month ) {
                    $key = array_search(date('Y-m-d', $time), array_column($execute, 'sold_date'));
                    if ($key !== false) {
                        $data[] = $execute[$key];
                    } else {
                        $data[] = [
                            'sold_at' => date('Y-m-d', $time),
                            'total_sales' => 0,
                            'total_price' => 0,
                            'total_fund' => 0
                        ];
                    }

                    $daysArray[] = date('Y-m-d', $time);
                }
            }
        }

        if ($year && !$month) {
            $sql = "
            SELECT
                MONTHNAME(DATE_ADD(DATE(CONCAT('".$year."' ,'-01-01')), INTERVAL month-1 MONTH)) AS month_name,
                COALESCE(COUNT(product_items.id), 0) AS total_sales,
                COALESCE(SUM(products.price), 0) AS total_price,
                COALESCE(SUM(products.fund), 0) AS total_fund
            FROM
                (SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
                UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS months
            LEFT JOIN
                product_items ON MONTH(product_items.sold_at) = months.month AND YEAR(product_items.sold_at) = '".$year."'
            LEFT JOIN
                products ON product_items.product_id = products.id
            WHERE
                YEAR(product_items.sold_at) = '".$year."' AND
                products.category_id IN (1, 2, 3, 4, 5) AND
                product_items.is_sold = true
            GROUP BY
                months.month";

            $execute = DB::select($sql);
            foreach ($monthArray as $key => $value) {
                $key = array_search($value, array_column($execute, 'month_name'));
                if ($key !== false) {
                    $data[] = $execute[$key];
                } else {
                    $data[] = [
                        'month_name' => $month,
                        'total_sales' => 0,
                        'total_price' => 0,
                        'total_fund' => 0
                    ];
                }
            }
        }

        return view('dashboard.product', compact(['data', 'monthArray', 'daysArray']));
    }

    public function counter()
    {
        return view('dashboard.counter');
    }
}
