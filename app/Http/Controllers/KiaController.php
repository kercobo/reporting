<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class KiaController extends Controller
{
                         
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createkia1($key){
      
      //set query group by
      if(\Auth::user()->username === 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';

      }
      if(\Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
            $desa = 'kartu_ibu_registration.dusun';
      }

        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kia1/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kia1/KIA1_def.json -x " . public_path(). "/".\Auth::user()->username."/kia1/pws1.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kia1/querylist.json";
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
            $month = '2015-06';
       }
       elseif($key == 'July'){
            $prev = '2015-06';
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
                                            "query" => "SELECT " . $desa . " as desa, count(*) as k1_bulan_lalu FROM kartu_anc_registration inner join kartu_ibu_registration on kartu_anc_registration.KiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_registration.submissiondate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "k1_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as K1_bulan FROM kartu_anc_registration inner join kartu_ibu_registration on kartu_anc_registration.KiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_registration.submissiondate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "K1_bulan"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as K4_bulan_lalu FROM kartu_anc_visit inner join kartu_ibu_registration on kartu_anc_visit.kiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit.ancKe ='4' and kartu_anc_visit.submissiondate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "k4_bulan_lalu"
                                              
                                        ),
                                         array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as K4_bulan_ini FROM kartu_anc_visit inner join kartu_ibu_registration on kartu_anc_visit.kiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit.ancKe ='4' and kartu_anc_visit.submissiondate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "k4_bulan_ini"
                                              
                                        ),
                                         array(
                                            "query" => "SELECT " . $desa . " as desa,count(*) as Resiko_bulan_lalu   FROM kartu_anc_registration inner join kartu_ibu_registration on kartu_anc_registration.KiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_registration.highRiskPregnancyProteinEnergyMalnutrition = 'yes' or kartu_anc_registration.malariaRisk = 'yes' or kartu_anc_registration.highRiskLabourTBRisk = 'yes' or kartu_anc_registration.HighRiskPregnancyTooManyChildren = 'yes' or kartu_anc_registration.HighRiskPregnancyAbortus = 'yes' or kartu_anc_registration.HighRiskLabourSectionCesareaRecord = 'yes' or kartu_anc_registration.highRiskSTIBBVs = 'yes' or kartu_anc_registration.highRiskEctopicPregnancy = 'yes' or kartu_anc_registration.otherRiskMolaHidatidosa = 'yes' or kartu_anc_registration.otherRiskCongenitalAbnormality = 'yes' or kartu_anc_registration.otherRiskEarlyWaterbreak = 'yes' or kartu_anc_registration.highRiskCardiovascularDiseaseRecord = 'yes' or kartu_anc_registration.highRiskDidneyDisorder = 'yes' or kartu_anc_registration.highRiskHeartDisorder = 'yes' or kartu_anc_registration.highRiskAsthma = 'yes' or kartu_anc_registration.highRiskTuberculosis = 'yes' or kartu_anc_registration.highRiskMalaria = 'yes' or kartu_anc_registration.highRiskHIVAIDS = 'yes' and kartu_ibu_registration.submissiondate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "Resiko_bulan_lalu"
                                              
                                        ),
                                         array(
                                            "query" => "SELECT " . $desa . " as desa,count(*) as Resiko_bulan_ini   FROM kartu_anc_registration inner join kartu_ibu_registration on kartu_anc_registration.KiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_registration.highRiskPregnancyProteinEnergyMalnutrition = 'yes' or kartu_anc_registration.malariaRisk = 'yes' or kartu_anc_registration.highRiskLabourTBRisk = 'yes' or kartu_anc_registration.HighRiskPregnancyTooManyChildren = 'yes' or kartu_anc_registration.HighRiskPregnancyAbortus = 'yes' or kartu_anc_registration.HighRiskLabourSectionCesareaRecord = 'yes' or kartu_anc_registration.highRiskSTIBBVs = 'yes' or kartu_anc_registration.highRiskEctopicPregnancy = 'yes' or kartu_anc_registration.otherRiskMolaHidatidosa = 'yes' or kartu_anc_registration.otherRiskCongenitalAbnormality = 'yes' or kartu_anc_registration.otherRiskEarlyWaterbreak = 'yes' or kartu_anc_registration.highRiskCardiovascularDiseaseRecord = 'yes' or kartu_anc_registration.highRiskDidneyDisorder = 'yes' or kartu_anc_registration.highRiskHeartDisorder = 'yes' or kartu_anc_registration.highRiskAsthma = 'yes' or kartu_anc_registration.highRiskTuberculosis = 'yes' or kartu_anc_registration.highRiskMalaria = 'yes' or kartu_anc_registration.highRiskHIVAIDS = 'yes' and kartu_ibu_registration.submissiondate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "Resiko_bulan_ini"
                                              
                                        ),
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kia1/pws1.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsibu1-'.$key.'.xlsx');
                                   
    }

    public function createkia2($key){

         if(\Auth::check() && \Auth::user()->username === 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::check() && \Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
            $desa = 'kartu_ibu_registration.dusun';
      }

          

        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kia2/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kia2/KIA2def.json -x " . public_path(). "/".\Auth::user()->username."/kia2/pws2.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kia2/querylist.json";
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
            $month = '2015-06';
       }
       elseif($key == 'July'){
            $prev = '2015-06';
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
                                            "query" => "SELECT " . $desa . ", count(*) as pelayanan_komplikasi_bulan_lalu   FROM kartu_anc_visit inner join kartu_ibu_registration on kartu_anc_visit.KiId = kartu_ibu_registration.KiId inner join kartu_anc_registration on kartu_anc_registration.kiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit.highRiskPregnancyProteinEnergyMalnutrition= 'yes' or kartu_anc_visit.highRiskPregnancyPIH= 'yes' or kartu_anc_visit.highRisklabourFetusNumber= 'yes' or kartu_anc_visit.highRiskLabourFetusSize= 'yes' or kartu_anc_visit.highRiskLabourFetusMalpresentation= 'yes' or kartu_anc_registration.riwayatKomplikasiKebidanan !='-' and kartu_anc_visit.submissionDate between '".$begin."-01' and '".$prev."-31'group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "pelayanan_komplikasi_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as pelayanan_komplikasi_bulan_ini   FROM kartu_anc_visit inner join kartu_ibu_registration on kartu_anc_visit.KiId = kartu_ibu_registration.KiId inner join kartu_anc_registration on kartu_anc_registration.kiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit.highRiskPregnancyProteinEnergyMalnutrition= 'yes' or kartu_anc_visit.highRiskPregnancyPIH= 'yes' or kartu_anc_visit.highRisklabourFetusNumber= 'yes' or kartu_anc_visit.highRiskLabourFetusSize= 'yes' or kartu_anc_visit.highRiskLabourFetusMalpresentation= 'yes' or kartu_anc_registration.riwayatKomplikasiKebidanan !='-' and kartu_anc_visit.submissionDate between '".$month."-01' and '".$month."-31'group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "pelayanan_komplikasi_bulan_ini"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as komplikasi_ditemukan_bulan_lalu   FROM kartu_anc_visit inner join kartu_ibu_registration on kartu_anc_visit.KiId = kartu_ibu_registration.KiId inner join kartu_anc_registration on kartu_anc_registration.kiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit.highRiskPregnancyProteinEnergyMalnutrition= 'yes' or kartu_anc_visit.highRiskPregnancyPIH= 'yes' or kartu_anc_visit.highRisklabourFetusNumber= 'yes' or kartu_anc_visit.highRiskLabourFetusSize= 'yes' or kartu_anc_visit.highRiskLabourFetusMalpresentation= 'yes' or kartu_anc_registration.riwayatKomplikasiKebidanan !='-' and kartu_anc_visit.submissionDate between '".$begin."-01' and '".$prev."-31'group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "komplikasi_ditemukan_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . ", count(*) as komplikasi_ditemukan_bulan_ini   FROM kartu_anc_visit inner join kartu_ibu_registration on kartu_anc_visit.KiId = kartu_ibu_registration.KiId inner join kartu_anc_registration on kartu_anc_registration.kiId = kartu_ibu_registration.KiId where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit.highRiskPregnancyProteinEnergyMalnutrition= 'yes' or kartu_anc_visit.highRiskPregnancyPIH= 'yes' or kartu_anc_visit.highRisklabourFetusNumber= 'yes' or kartu_anc_visit.highRiskLabourFetusSize= 'yes' or kartu_anc_visit.highRiskLabourFetusMalpresentation= 'yes' or kartu_anc_registration.riwayatKomplikasiKebidanan !='-' and kartu_anc_visit.submissionDate between '".$month."-01' and '".$month."-31'group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "komplikasi_ditemukan_bulan_ini"
                                              
                                        ),
                                      
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kia2/pws2.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsibu2-'.$key.'.xlsx');
                                   

    }

    public function createkia3($key){

       if(\Auth::check() && \Auth::user()->username === 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::check() && \Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
            $desa = 'kartu_ibu_registration.dusun';
      }
         $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kia3/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kia3/KIA3def.json -x " . public_path(). "/".\Auth::user()->username."/kia3/pws3.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kia3/querylist.json";
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
            $month = '2015-06';
       }
       elseif($key == 'July'){
            $prev = '2015-06';
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
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linakes_laki_bulan_lalu FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiId = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.jeniskelamin='laki' and kartu_pnc_dokumentasi_persalinan.penolong != 'dukun' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linakes_laki_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linakes_laki_bulan_ini FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiId = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.jeniskelamin='laki' and kartu_pnc_dokumentasi_persalinan.penolong != 'dukun' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linakes_laki_bulan_ini"
                                              
                                        ),
                                         array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linakes_perempuan_bulan_lalu FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiId = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.jeniskelamin='perempuan' and kartu_pnc_dokumentasi_persalinan.penolong != 'dukun' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linakes_perempuan_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linakes_perempuan_bulan_ini FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiId = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.jeniskelamin='perempuan' and kartu_pnc_dokumentasi_persalinan.penolong != 'dukun' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linakes_perempuan_bulan_ini"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linnonkes_laki_bulan_lalu FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiId = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.jeniskelamin='laki' and kartu_pnc_dokumentasi_persalinan.penolong != 'dukun' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linnonkes_laki_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linnonkes_laki_bulan_ini FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiId = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.jeniskelamin='laki' and kartu_pnc_dokumentasi_persalinan.penolong != 'dukun' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linnonkes_laki_bulan_ini"
                                              
                                        ),
                                         array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linnonkes_perempuan_bulan_lalu FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiId = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.jeniskelamin='perempuan' and kartu_pnc_dokumentasi_persalinan.penolong != 'dukun' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linnonkes_perempuan_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linnonkes_perempuan_bulan_ini FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiId = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.jeniskelamin='perempuan' and kartu_pnc_dokumentasi_persalinan.penolong != 'dukun' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linnonkes_perempuan_bulan_ini"
                                              
                                        ),
                                      
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kia3/pws3.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsibu3-'.$key.'.xlsx');

    }

    public function createkia4($key){

       if(\Auth::check() && \Auth::user()->username === 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::check() && \Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
            $desa = 'kartu_ibu_registration.dusun';
      }
        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kia4/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kia4/KIA4def.json -x " . public_path(). "/".\Auth::user()->username."/kia4/pws4.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kia4/querylist.json";
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
            $month = '2015-06';
       }
       elseif($key == 'July'){
            $prev = '2015-06';
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
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linfas_bulan_lalu FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiid = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.tempatBersalin !='-' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linfas_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as linfas_bulan_ini FROM kartu_pnc_dokumentasi_persalinan inner join kartu_anc_visit on kartu_anc_visit.motherid = kartu_pnc_dokumentasi_persalinan.motherid inner join kartu_ibu_registration on kartu_ibu_registration.kiid = kartu_anc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_dokumentasi_persalinan.tempatBersalin !='-' and kartu_pnc_dokumentasi_persalinan.submissionDate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "linfas_bulan_ini"
                                              
                                        ),
                                         array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as kunjungan_bulan_lalu FROM kartu_pnc_visit inner join kartu_ibu_registration on kartu_ibu_registration.kiid = kartu_pnc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_visit.clientVersionSubmissionDate between '".$begin."-01' and '".$prev."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_lalu"
                                              
                                        ),
                                         array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as kunjungan_bulan_ini FROM kartu_pnc_visit inner join kartu_ibu_registration on kartu_ibu_registration.kiid = kartu_pnc_visit.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_pnc_visit.clientVersionSubmissionDate between '".$month."-01' and '".$month."-31' group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "kunjungan_bulan_ini"
                                              
                                        ),
                                        
                                      
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                            shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kia4/pws4.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsibu4-'.$key.'.xlsx');

    }

    public function createkia5($key){

       if(\Auth::check() && \Auth::user()->username === 'sengkol'){
            $desa = 'kartu_ibu_registration.desa';
      }
      if(\Auth::check() && \Auth::user()->username === 'janapria'){
            $desa = 'kartu_ibu_registration.desa';
      }
      else{
            $desa = 'kartu_ibu_registration.dusun';
      }
        $python ="/usr/bin/python " . public_path(). "/reporting.py -c " . public_path(). "/".\Auth::user()->username."/kia5/querylist.json -j " . public_path(). "/".\Auth::user()->username."/kia5/KIA5def.json -x " . public_path(). "/".\Auth::user()->username."/kia5/pws5.xlsx";
        $json_query = "" . public_path(). "/".\Auth::user()->username."/kia5/querylist.json";
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
            $month = '2015-06';
       }
       elseif($key == 'July'){
            $prev = '2015-06';
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
                                            "query" => "SELECT " . $desa . " as desa, count(*) as anemia_bulan_lalu FROM kartu_anc_visit_labTest inner join kartu_ibu_registration on kartu_anc_visit_labTest.KiId = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit_labTest.laboratoriumPeriksaHbAnemia = 'positif'  and kartu_anc_visit_labTest.submissionDate between '".$begin."-01' and '".$prev."-31'group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "anemia_bulan_lalu"
                                              
                                        ),
                                        array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as anemia_bulan_ini FROM kartu_anc_visit_labTest inner join kartu_ibu_registration on kartu_anc_visit_labTest.KiId = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit_labTest.laboratoriumPeriksaHbAnemia = 'positif'  and kartu_anc_visit_labTest.submissionDate between '".$month."-01' and '".$month."-31'group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "anemia_bulan_ini"
                                              
                                        ),
                                         array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as KEK_bulan_lalu FROM kartu_anc_visit inner join kartu_ibu_registration on kartu_anc_visit.KiId = kartu_ibu_registration.kiid inner join kartu_anc_registration on kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit.highRiskPregnancyProteinEnergyMalnutrition = 'yes' or kartu_anc_registration.highRiskPregnancyProteinEnergyMalnutrition = 'yes' and kartu_anc_visit.submissionDate between '".$begin."-01' and '".$prev."-31'group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KEK_bulan_lalu"
                                              
                                        ),
                                           array(
                                            "query" => "SELECT " . $desa . " as desa, count(*) as KEK_bulan_ini FROM kartu_anc_visit inner join kartu_ibu_registration on kartu_anc_visit.KiId = kartu_ibu_registration.kiid inner join kartu_anc_registration on kartu_anc_registration.kiid = kartu_ibu_registration.kiid where kartu_ibu_registration.userid =  '".\Auth::user()->username."' and kartu_anc_visit.highRiskPregnancyProteinEnergyMalnutrition = 'yes' or kartu_anc_registration.highRiskPregnancyProteinEnergyMalnutrition = 'yes' and kartu_anc_visit.submissionDate between '".$month."-01' and '".$month."-31'group by " . $desa . "",
                                            "control" => "desa",
                                            "value" => "KEK_bulan_ini"
                                              
                                        ),
                                        
                                      
                                    );
            
                                    file_put_contents($json_query, json_encode($arr));

                                     shell_exec($python);
                                            $file= public_path(). "/".\Auth::user()->username."/kia5/pws5.xlsx";
                                            $headers = array(
                                                  'Content-Type: application/xlsx',
                                                );
                                            return response()->download($file,'pwsibu5-'.$key.'.xlsx');

    }



//end of class
}

