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
        return View('indexs');
    }

    public function getAPI()
    {
        $days = Input::get('days', 7);

        $range = \Carbon\Carbon::now()->subDays($days);

        if(\Auth::user()->username == 'sengkol'){

        $stats = DB::table('analytics.kartu_anc_registration')
            ->join('analytics.kartu_ibu_registration', 'analytics.kartu_ibu_registration.kiid', '=', 'analytics.kartu_anc_registration.kiid')
             ->whereBetween('analytics.kartu_anc_registration.submissiondate', ['2015-11-01', '2015-11-31'])
           //  ->where('analytics.kartu_anc_registration.userId', )
//            ->where('analytics.kartu_anc_registration.submissiondate', '>=', $range)
            ->groupBy('analytics.kartu_ibu_registration.desa')
            ->get([
                DB::raw('analytics.kartu_ibu_registration.desa as dusun'),
                DB::raw('COUNT(*) as jumlah')
            ]);

        return $stats;
        }
        
        if(\Auth::user()->username == 'janapria'){

        $stats = DB::table('analytics.kartu_anc_registration')
            ->join('analytics.kartu_ibu_registration', 'analytics.kartu_ibu_registration.kiid', '=', 'analytics.kartu_anc_registration.kiid')
             ->whereBetween('analytics.kartu_anc_registration.submissiondate', ['2015-11-01', '2015-11-31'])
           //  ->where('analytics.kartu_anc_registration.puskesmas', 'janapria')
//            ->where('analytics.kartu_anc_registration.submissiondate', '>=', $range)
            ->groupBy('analytics.kartu_ibu_registration.desa')
            ->get([
                DB::raw('analytics.kartu_ibu_registration.desa as dusun'),
                DB::raw('COUNT(*) as jumlah')
            ]);

        return $stats;
        }

        else{

        $stats = DB::table('analytics.kartu_anc_registration')
            ->join('analytics.kartu_ibu_registration', 'analytics.kartu_ibu_registration.kiid', '=', 'analytics.kartu_anc_registration.kiid')
             ->whereBetween('analytics.kartu_anc_registration.submissiondate', ['2015-11-01', '2015-11-31'])
             ->where('analytics.kartu_anc_registration.userId','=', \Auth::user()->username)
            ->groupBy('analytics.kartu_ibu_registration.dusun')
            ->get([
                DB::raw('analytics.kartu_ibu_registration.dusun as dusun'),
                DB::raw('COUNT(*) as jumlah')
            ]);

        return $stats;
        }
    }

        public function getAPIK4()
        {
        $days = Input::get('days', 7);

        $range = \Carbon\Carbon::now()->subDays($days);

        if(\Auth::user()->username == 'sengkol'){

        $stats = DB::table('analytics.kartu_anc_visit')
            ->join('analytics.kartu_ibu_registration', 'analytics.kartu_ibu_registration.kiid', '=', 'analytics.kartu_anc_visit.kiid')
             ->where('analytics.kartu_anc_visit.ancKe', '4')
             ->whereBetween('analytics.kartu_anc_visit.submissiondate', ['2015-11-01', '2015-11-31'])
            ->groupBy('analytics.kartu_ibu_registration.desa')
            ->get([
                DB::raw('analytics.kartu_ibu_registration.desa as dusun'),
                DB::raw('COUNT(*) as jumlah')
            ]);

        return $stats;
        }
        
        if(\Auth::user()->username == 'janapria'){

        $stats = DB::table('analytics.kartu_anc_visit')
          ->join('analytics.kartu_ibu_registration', 'analytics.kartu_ibu_registration.kiid', '=', 'analytics.kartu_anc_visit.kiid')
             >where('analytics.kartu_anc_visit.ancKe', '4')
             ->whereBetween('analytics.kartu_anc_visit.submissiondate', ['2015-11-01', '2015-11-31'])
            ->groupBy('analytics.kartu_ibu_registration.desa')
            ->get([
                DB::raw('analytics.kartu_ibu_registration.desa as dusun'),
                DB::raw('COUNT(*) as jumlah')
            ]);

        return $stats;
        }

        else{

        $stats = DB::table('analytics.kartu_anc_visit')
           ->join('analytics.kartu_ibu_registration', 'analytics.kartu_ibu_registration.kiid', '=', 'analytics.kartu_anc_visit.kiid')
            ->where('analytics.kartu_ibu_registration.userId', \Auth::user()->username)
            ->where('analytics.kartu_anc_visit.ancKe', '4')
            ->whereBetween('analytics.kartu_anc_visit.submissiondate', ['2015-11-01', '2015-11-31'])
            ->groupBy('analytics.kartu_ibu_registration.dusun')
            ->get([
                DB::raw('analytics.kartu_ibu_registration.dusun as dusun'),
                DB::raw('COUNT(*) as jumlah')
            ]);

        return $stats;
        }
    }
}