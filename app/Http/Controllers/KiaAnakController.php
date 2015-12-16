<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class KiaAnakController extends Controller
{
   

  public function createkiaanak1($key){
      $begin = '2015-01';
      //set query group by
      if(\Auth::check() && \Auth::user()->username === 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::check() && \Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
            $desa = 'kartu_ibu_registration.dusun';
      }
        

        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kiaanak1/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kiaanak1/KIAanak1def.json -x " . public_path(). "/".\Auth::user()->username."/kiaanak1/kiaanak1.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kiaanak1/querylist.json";
       


       if($key == 'January'){
            $prev = '2015-00';
            $month = '2015-01';
       }
       elseif($key == 'February'){
            $prev = '2015-01';
            $month = '2015-02';
       }
       elseif($key == 'March'){
            $prev = '2015-02';
            $month = '2015-03';
       }
       elseif($key == 'April'){
            $prev = '2015-03';
            $month = '2015-04';
       }
       elseif($key == 'May'){
            $prev = '2015-04';
            $month = '2015-05';
       }
       elseif($key == 'June'){
            $prev = '2015-05';
            $month = '".$month."';
       }
       elseif($key == 'July'){
            $prev = '".$month."';
            $month = '2015-07';
       }
       elseif($key == 'August'){
            $prev = '2015-07';
            $month = '2015-08';
       }
       elseif($key == 'September'){
            $prev = '2015-08';
            $month = '2015-09';
       }
       elseif($key == 'October'){
            $prev = '2015-09';
            $month = '2015-10';
       }
       elseif ($key == 'November') {
            $prev = '2015-10';
            $month = '2015-11';
       }
       elseif ($key == 'December') {
           $prev = '2015-11';
            $month = '2015-12';
       }
       else{
        //nothing to do here
       }

        $arr = array(
                                        array(
                                            "query" => "SELECT dusun from kartu_ibu_registration where userID='".\Auth::user()->username."' group by dusun",
                                             "control" => "desa",
                                            "value" => "desa"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan ) as KN1_laki_bulan_lalu FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_neonatal_period.kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'laki' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN1_laki_bulan_lalu"
                                              
                                        ),
                    array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan ) as KN1_laki_bulan_ini FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_neonatal_period.kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'laki' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN1_laki_bulan_ini"
                                              
                                        ),
                    array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan ) as KN1_perempuan_bulan_lalu FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_neonatal_period.kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'perempuan' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN1_perempuan_bulan_lalu"
                                              
                                        ),
                    array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan ) as KN1_perempuan_bulan_ini FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_neonatal_period.kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'perempuan' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN1_perempuan_bulan_ini"
                                              
                                        ),
                    array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalKeduaharike3sd7TanggalKunjungan ) as KN3_laki_bulan_lalu FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_neonatal_period.kunjunganNeonatalKeduaharike3sd7TanggalKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'laki' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN3_laki_bulan_lalu"
                                              
                                        ),
                    array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalKeduaharike3sd7TanggalKunjungan ) as KN3_laki_bulan_ini FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_neonatal_period.kunjunganNeonatalKeduaharike3sd7TanggalKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'laki' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN3_laki_bulan_ini"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalKeduaharike3sd7TanggalKunjungan ) as KN3_perempuan_bulan_lalu FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_neonatal_period.kunjunganNeonatalKeduaharike3sd7TanggalKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'perempuan' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN3_perempuan_bulan_lalu"
                                              
                                        ),
                    array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalKeduaharike3sd7TanggalKunjungan ) as KN3_perempuan_bulan_ini FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_neonatal_period.kunjunganNeonatalKeduaharike3sd7TanggalKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'perempuan' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN3_perempuan_bulan_ini"
                                              
                                        ),
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kiaanak1/kiaanak1.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsanak1-'.$month.'.xlsx');
                                   
    }

    public function createkiaanak2($key){
      $begin = '2015-01';
      //set query group by
      if(\Auth::check() && \Auth::user()->username === 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::check() && \Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
           $desa = 'kartu_ibu_registration.dusun';
      }
        

        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kiaanak2/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kiaanak2/KIAanak2def.json -x " . public_path(). "/".\Auth::user()->username."/kiaanak2/kiaanak2.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kiaanak2/querylist.json";
       


       if($key == 'January'){
            $prev = '2015-00';
            $month = '2015-01';
       }
       elseif($key == 'February'){
            $prev = '2015-01';
            $month = '2015-02';
       }
       elseif($key == 'March'){
            $prev = '2015-02';
            $month = '2015-03';
       }
       elseif($key == 'April'){
            $prev = '2015-03';
            $month = '2015-04';
       }
       elseif($key == 'May'){
            $prev = '2015-04';
            $month = '2015-05';
       }
       elseif($key == 'June'){
            $prev = '2015-05';
            $month = '".$month."';
       }
       elseif($key == 'July'){
            $prev = '".$month."';
            $month = '2015-07';
       }
       elseif($key == 'August'){
            $prev = '2015-07';
            $month = '2015-08';
       }
       elseif($key == 'September'){
            $prev = '2015-08';
            $month = '2015-09';
       }
       elseif($key == 'October'){
            $prev = '2015-09';
            $month = '2015-10';
       }
       elseif ($key == 'November') {
            $prev = '2015-10';
            $month = '2015-11';
       }
       elseif ($key == 'December') {
           $prev = '2015-11';
            $month = '2015-12';
       }
       else{
        //nothing to do here
       }

        $arr = array(
                                        array(
                                            "query" => "SELECT dusun from kartu_ibu_registration where userID='".\Auth::user()->username."' group by dusun",
                                             "control" => "desa",
                                            "value" => "desa"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " AS desa, COUNT( kohort_bayi_neonatal_period.komplikasi ) AS komplikasi_bulan_lalu FROM kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childId INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.komplikasi !=  '-' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "komplikasi_bulan_lalu"
                                              
                                        ),
                    array(
                                            "query" => "SELECT " . $desa . " AS desa, COUNT( kohort_bayi_neonatal_period.komplikasi ) AS komplikasi_bulan_ini FROM kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childId INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.komplikasi !=  '-' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "komplikasi_bulan_ini"
                                              
                                        ),
                    array(
                                           "query" => "SELECT " . $desa . " AS desa, COUNT( kohort_bayi_neonatal_period.komplikasi ) AS komplikasi_tertangani_bulan_lalu FROM kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childId INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.komplikasi !=  '-' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "komplikasi_tertangani_bulan_lalu"
                                              
                                        ),
                    array(
                                            "query" => "SELECT " . $desa . " AS desa, COUNT( kohort_bayi_neonatal_period.komplikasi ) AS komplikasi_tertangani_bulan_ini FROM kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childId INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.komplikasi !=  '-' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "komplikasi_tertangani_bulan_ini"
                                              
                                        ),
                    
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kiaanak2/kiaanak2.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsanak2-'.$month.'.xlsx');
                                   
    }

    public function createkiaanak3($key){
      $begin = '2015-01';
      //set query group by
      if(\Auth::user()->username == 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
           $desa = 'kartu_ibu_registration.dusun';
      }
        

        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kiaanak3/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kiaanak3/KIAanak3def.json -x " . public_path(). "/".\Auth::user()->username."/kiaanak3/kiaanak3.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kiaanak3/querylist.json";
       


       if($key == 'January'){
            $prev = '2015-00';
            $month = '2015-01';
       }elseif($key == 'February'){
            $prev = '2015-01';
            $month = '2015-02';
       }
       elseif($key == 'March'){
            $prev = '2015-02';
            $month = '2015-03';
       }
       elseif($key == 'April'){
            $prev = '2015-03';
            $month = '2015-04';
       }
       elseif($key == 'May'){
            $prev = '2015-04';
            $month = '2015-05';
       }
       elseif($key == 'June'){
            $prev = '2015-05';
            $month = '".$month."';
       }
       elseif($key == 'July'){
            $prev = '".$month."';
            $month = '2015-07';
       }
       elseif($key == 'August'){
            $prev = '2015-07';
            $month = '2015-08';
       }
       elseif($key == 'September'){
            $prev = '2015-08';
            $month = '2015-09';
       }
       elseif($key == 'October'){
            $prev = '2015-09';
            $month = '2015-10';
       }
       elseif ($key == 'November') {
            $prev = '2015-10';
            $month = '2015-11';
       }
       elseif ($key == 'December') {
           $prev = '2015-11';
            $month = '2015-12';
       }
       else{
        //nothing to do here
       }

        $arr = array(
                                        array(
                                            "query" => "SELECT dusun from kartu_ibu_registration where userID='".\Auth::user()->username."' group by dusun",
                                             "control" => "desa",
                                            "value" => "desa"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan1_bulan_lalu FROM kohort_bayi_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kohort_bayi_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( kohort_bayi_kunjungan.tanggalKunjunganBayiPerbulan, kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) as date FROM kohort_bayi_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= 60 AND kohort_bayi_kunjungan.submissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan1_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan1_bulan_ini FROM kohort_bayi_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kohort_bayi_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( kohort_bayi_kunjungan.tanggalKunjunganBayiPerbulan, kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) as date FROM kohort_bayi_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= 60 AND kohort_bayi_kunjungan.submissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan1_bulan_ini"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", COUNT( * ) kunjungan4_bulan_lalu FROM  kohort_bayi_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_kunjungan.tanggalKunjunganBayiPerbulan IN (( SELECT COUNT( * ) FROM  kohort_bayi_kunjungan GROUP BY childid)) >=3 AND kohort_bayi_kunjungan.submissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' GROUP BY " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan4_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", COUNT( * ) kunjungan4_bulan_ini FROM  kohort_bayi_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_kunjungan.tanggalKunjunganBayiPerbulan IN (( SELECT COUNT( * ) FROM  kohort_bayi_kunjungan GROUP BY childid)) >=3 AND kohort_bayi_kunjungan.submissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' GROUP BY " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan4_bulan_ini"
                                              
                                        ),
                                        
                    
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kiaanak3/kiaanak3.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsanak3-'.$month.'.xlsx');
                                   
    }

    public function createkiaanak4($key){
      $begin = '2015-01';
      //set query group by
      if(\Auth::user()->username == 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
           $desa = 'kartu_ibu_registration.dusun';
      }
        

        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kiaanak4/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kiaanak4/KIAanak4def.json -x " . public_path(). "/".\Auth::user()->username."/kiaanak4/kiaanak4.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kiaanak4/querylist.json";
       


       if($key == 'January'){
            $prev = '2015-00';
            $month = '2015-01';
       }elseif($key == 'February'){
            $prev = '2015-01';
            $month = '2015-02';
       }
       elseif($key == 'March'){
            $prev = '2015-02';
            $month = '2015-03';
       }
       elseif($key == 'April'){
            $prev = '2015-03';
            $month = '2015-04';
       }
       elseif($key == 'May'){
            $prev = '2015-04';
            $month = '2015-05';
       }
       elseif($key == 'June'){
            $prev = '2015-05';
            $month = '".$month."';
       }
       elseif($key == 'July'){
            $prev = '".$month."';
            $month = '2015-07';
       }
       elseif($key == 'August'){
            $prev = '2015-07';
            $month = '2015-08';
       }
       elseif($key == 'September'){
            $prev = '2015-08';
            $month = '2015-09';
       }
       elseif($key == 'October'){
            $prev = '2015-09';
            $month = '2015-10';
       }
       elseif ($key == 'November') {
            $prev = '2015-10';
            $month = '2015-11';
       }
       elseif ($key == 'December') {
           $prev = '2015-11';
            $month = '2015-12';
       }
       else{
        //nothing to do here
       }

        $arr = array(
                                        array(
                                            "query" => "SELECT dusun from kartu_ibu_registration where userID='".\Auth::user()->username."' group by dusun",
                                             "control" => "desa",
                                            "value" => "desa"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_lalu1 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '12' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '23' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') <=2 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu1"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_lalu2 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '24' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '35' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') <=2 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu2"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_lalu3 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '36' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '48' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') <=2 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu3"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_lalu4 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '49' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '60' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') <=2 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu4"
                                              
                                        ),
                                       array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_ini1 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '12' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '23' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') <=2 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini1"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_ini2 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '24' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '35' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') <=2 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini2"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_ini3 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '36' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '48' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') <=2 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini3"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_ini4 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '49' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '60' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') <=2 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini4"
                                              
                                        ),
                                        
                    
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kiaanak4/kiaanak4.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsanak4-'.$month.'.xlsx');
                                   
    }

    public function createkiaanak5($key){
      $begin = '2015-01';
      //set query group by
      if(\Auth::user()->username == 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
           $desa = 'kartu_ibu_registration.dusun';
      }
        
       
        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kiaanak5/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kiaanak5/KIAanak5def.json -x " . public_path(). "/".\Auth::user()->username."/kiaanak5/kiaanak5.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kiaanak5/querylist.json";
       


       if($key == 'January'){
            $prev = '2015-00';
            $month = '2015-01';
       }elseif($key == 'February'){
            $prev = '2015-01';
            $month = '2015-02';
       }
       elseif($key == 'March'){
            $prev = '2015-02';
            $month = '2015-03';
       }
       elseif($key == 'April'){
            $prev = '2015-03';
            $month = '2015-04';
       }
       elseif($key == 'May'){
            $prev = '2015-04';
            $month = '2015-05';
       }
       elseif($key == 'June'){
            $prev = '2015-05';
            $month = '".$month."';
       }
       elseif($key == 'July'){
            $prev = '".$month."';
            $month = '2015-07';
       }
       elseif($key == 'August'){
            $prev = '2015-07';
            $month = '2015-08';
       }
       elseif($key == 'September'){
            $prev = '2015-08';
            $month = '2015-09';
       }
       elseif($key == 'October'){
            $prev = '2015-09';
            $month = '2015-10';
       }
       elseif ($key == 'November') {
            $prev = '2015-10';
            $month = '2015-11';
       }
       elseif ($key == 'December') {
           $prev = '2015-11';
            $month = '2015-12';
       }
       else{
        //nothing to do here
       }

        $arr = array(
                                        array(
                                            "query" => "SELECT dusun from kartu_ibu_registration where userID='".\Auth::user()->username."' group by dusun",
                                             "control" => "desa",
                                            "value" => "desa"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_lalu1 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '12' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '23' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') >=8 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu1"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_lalu2 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '24' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '35' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') >=8 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu2"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_lalu3 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '36' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '48' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') >=8 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu3"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_lalu4 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '49' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '60' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') >=8 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $begin . "-01' AND  '" . $prev . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu4"
                                              
                                        ),
                                       array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_ini1 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '12' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '23' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') >=8 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini1"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_ini2 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '24' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '35' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') >=8 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini2"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_ini3 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '36' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '48' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') >=8 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini3"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as kunjungan_bulan_ini4 FROM kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) >= '49' or  kohort_bayi_balita_kunjungan.tanggalKunjunganBayiPerbulan IN ((SELECT DATEDIFF( " . date("Y-m-d") . ",kartu_pnc_dokumentasi_persalinan.tanggallahiranak ) AS DATE FROM kohort_bayi_balita_kunjungan INNER JOIN kartu_pnc_dokumentasi_persalinan ON kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid)) <= '60' AND kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan IN (select count(*) from kohort_bayi_balita_kunjungan inner join kartu_pnc_dokumentasi_persalinan on kohort_bayi_balita_kunjungan.childid = kartu_pnc_dokumentasi_persalinan.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid where kohort_bayi_balita_kunjungan.beratBadanBayiSetiapKunjunganBayiPerbulan !='') >=8 AND kohort_bayi_balita_kunjungan.clientVersionSubmissionDate BETWEEN  '" . $month . "-01' AND  '" . $month . "-31' group by " . $desa . " ",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini4"
                                              
                                        ),
                                        
                    
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kiaanak5/kiaanak5.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsanak5-'.$month.'.xlsx');
                                   
    }






}