@extends('layouts.dashboard')
@section('page_heading','PWS KIA IBU')
@section('section')

  
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane3'))
                        
                        
                                <H2 align="center"> Download </H2>
                                <div align="center">
                                <?php

                                   $month = array(
                                                    'Pilih Laporan Berdasarkan bulan',
                                                    'January',
                                                    'February',
                                                    'March',
                                                    'April',
                                                    'May',
                                                    'June',
                                                    'July ',
                                                    'August',
                                                    'September',
                                                    'October',
                                                    'November',
                                                    'December',
                                                ); ?>
                                    <label>
                                    <select onChange="window.location.href=this.value">
                                    <?php foreach($month as $row): 
                                      ?>
                                      <option value="kia3/<?php echo $row; ?>" > <?php echo $row;?> </option>
                                        
                                   <?php 
                                     endforeach; ?>
                                    </select>
                                    </label>
                                </div>

       <div>
       <?php
  
?>       </div>

                <!-- /.col-lg-4 -->
            
@stop
