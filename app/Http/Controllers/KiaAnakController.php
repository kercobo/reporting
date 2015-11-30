<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class KiaAnakController extends Controller
{
		public function createkiaanak1($key){
      
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
        $begin = '2015-01';


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
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan ) as KN1_laki_bulan_lalu FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'laki' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN1_laki_bulan_lalu"
                                              
                                        ),
										array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan ) as KN1_laki_bulan_ini FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'laki' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN1_laki_bulan_ini"
                                              
                                        ),
										array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan ) as KN1_perempuan_bulan_lalu FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'perempuan' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN1_perempuan_bulan_lalu"
                                              
                                        ),
										array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan ) as KN1_perempuan_bulan_ini FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'perempuan' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN1_perempuan_bulan_ini"
                                              
                                        ),
										array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalKeduaharike3sd7TanggalKunjungan ) as KN3_laki_bulan_lalu FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.kunjunganNeonatalKeduaharike3sd7TanggalKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'laki' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN3_laki_bulan_lalu"
                                              
                                        ),
										array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalKeduaharike3sd7TanggalKunjungan ) as KN3_laki_bulan_ini FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.kunjunganNeonatalKeduaharike3sd7TanggalKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'laki' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN3_laki_bulan_ini"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalKeduaharike3sd7TanggalKunjungan ) as KN3_perempuan_bulan_lalu FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.kunjunganNeonatalKeduaharike3sd7TanggalKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'perempuan' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$begin."-01' AND  '".$prev."-31' GROUP BY " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KN3_perempuan_bulan_lalu"
                                              
                                        ),
										array(
                                            "query" => "SELECT " . $desa . " as desa, COUNT( kunjunganNeonatalKeduaharike3sd7TanggalKunjungan ) as KN3_perempuan_bulan_ini FROM  kohort_bayi_neonatal_period INNER JOIN kartu_pnc_dokumentasi_persalinan ON kartu_pnc_dokumentasi_persalinan.childId = kohort_bayi_neonatal_period.childid INNER JOIN kartu_anc_registration ON kartu_pnc_dokumentasi_persalinan.motherid = kartu_anc_registration.motherid INNER JOIN kartu_ibu_registration ON kartu_anc_registration.kiid = kartu_ibu_registration.kiid WHERE kohort_bayi_neonatal_period.kunjunganNeonatalKeduaharike3sd7TanggalKunjungan !=  '-' AND kartu_pnc_dokumentasi_persalinan.jeniskelamin =  'perempuan' AND kohort_bayi_neonatal_period.submissionDate BETWEEN  '".$month."-01' AND  '".$month."-31' GROUP BY " . $desa . "",
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



}