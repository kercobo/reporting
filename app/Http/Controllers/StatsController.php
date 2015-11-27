<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
class StatsController extends BaseController
{

    public function getIndex()
    {
        return View('stats');
    }

    public function getAPI()
    {
        $days = Input::get('days', 7);

        $range = \Carbon\Carbon::now()->subDays($days);

        $stats = DB::table('analytics.kartu_anc_registration')
            ->join('analytics.kartu_ibu_registration', 'analytics.kartu_ibu_registration.kiid', '=', 'analytics.kartu_anc_registration.kiid')
             ->whereBetween('analytics.kartu_anc_registration.submissiondate', ['2015-11-01', '2015-11-31'])
//            ->where('analytics.kartu_anc_registration.submissiondate', '>=', $range)
            ->groupBy('analytics.kartu_ibu_registration.desa')
            ->get([
                DB::raw('analytics.kartu_ibu_registration.desa as date'),
                DB::raw('COUNT(*) as jumlah')
            ]);

        return $stats;
    }
}