<?php

namespace App\Utility;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\DB;

class Utility {

    /**
     * Get Breadcrumbs
     * @return string
     */
    public static function getBreadcrumbs()
    {
        return Breadcrumbs::render() . '<hr class="hr-md hr-breadcrumb">';
    }

    /**
     * Generate order ID
     * @return string
     */
    public static function generateOrderId()
    {
        $length = 10;
        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
    }

    /**
     * Get current marketplace results count shown in page out of total
     * @param $items
     * @return string
     */
    public static function getMarketplaceResultsCount($items)
    {
        if (!empty(app('request')->input())) {
            $title = app('request')->input('title');
            $priceFrom = app('request')->input('price_from');
            $priceTo = app('request')->input('price_to');

            return count($items) . (count($items) == 1 ? ' result' : ' results') . ' shown out of ' . DB::table('marketplace')
                    ->when($title, function ($query, $title) {
                        $query->where('title', 'like', '%' . $title . '%');
                    })
                    ->when($priceFrom, function ($query, $priceFrom) {
                        $query->where('price', '>=', $priceFrom);
                    })
                    ->when($priceTo, function ($query, $priceTo) {
                        $query->where('price', '<=', $priceTo);
                    })
                    ->count() .
                ' total';
        } else {
            return count($items) . (count($items) == 1 ? ' result' : ' results') . ' shown out of ' . DB::table('marketplace')->count() . ' total';
        }
    }
}
