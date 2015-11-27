@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('section')
           
         
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane3'))
                        
                                <div align="center">
                                    <p>
                                        <strong>anak</strong>
                                        <span class="pull-right text-muted">Loading</span>
                                    </p>
                                   
                                        <div style="width:400px;">
                                        @include('widgets.progress', array('animated'=> true, 'class'=>'success', 'value'=>'100'))
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                   
                                </div>
                            
                <!-- /.col-lg-4 -->
            
@stop
