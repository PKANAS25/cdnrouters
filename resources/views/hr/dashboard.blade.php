@extends('hrMaster') 

@section('urlTitles')
<?php session(['title' => 'Home']);
session(['subtitle' => '']); ?>
@endsection
<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="/hr_assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
    <link href="/hr_assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="/hr_assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="/hr_assets/plugins/morris/morris.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->

@section('content')
<div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Dashboard <small>Clients and contacts</small></h1>
            <!-- end page-header -->
            
            <!-- begin row -->
            <div class="row">
                 @if (session('warning'))
                                    <div class="alert alert-danger">
                                        {{ session('warning') }}   
                                    </div>
                                @endif
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon"><i class="fa fa-money"></i></div>
                        <div class="stats-info">
                            <h4>TOTAL CLIENTS</h4>
                            <p>71,922 </p>    
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;">  <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-blue">
                        <div class="stats-icon"><i class="fa fa-link"></i></div>
                        <div class="stats-info">
                            <h4>TOTAL CONTACTS</h4>
                            <p>95,685</p>   
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;"> <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-purple">
                        <div class="stats-icon"><i class="fa fa-child"></i></div>
                        <div class="stats-info">
                            <h4>NEW CONTACTS</h4>
                            <p>76</p>    
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;"> <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-red">
                        <div class="stats-icon"><i class="fa fa-clock-o"></i></div>
                        <div class="stats-info">
                            <h4>NEW CALLS</h4>
                            <p>12</p> 
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;"> <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- end col-3 -->
            </div>
            <!-- end row -->

          <!-- begin row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="widget-chart with-sidebar bg-black">
                        <div class="widget-chart-content">
                            <h4 class="chart-title">
                                Clients Analytics
                                <small>Where do our clients come from</small>
                            </h4>
                            <div id="visitors-line-chart" class="morris-inverse" style="height: 260px;"></div>
                        </div>
                        <div class="widget-chart-sidebar bg-black-darker">
                            <div class="chart-number">
                                1,225,729
                                <small>clients</small>
                            </div>
                            <div id="visitors-donut-chart" style="height: 160px"></div>
                            <ul class="chart-legend">
                                <li><i class="fa fa-circle-o fa-fw text-success m-r-5"></i> 34.0% <span>New Clients</span></li>
                                <li><i class="fa fa-circle-o fa-fw text-primary m-r-5"></i> 56.0% <span>Return Clients</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-inverse" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Clients Origin
                            </h4>
                        </div>
                        <div id="visitors-map" class="bg-black" style="height: 181px;"></div>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-inverse text-ellipsis">
                                <span class="badge badge-success">20.95%</span>
                                1. United Arab Emirates 
                            </a> 
                            <a href="#" class="list-group-item list-group-item-inverse text-ellipsis">
                                <span class="badge badge-primary">16.12%</span>
                                2. India
                            </a>
                            <a href="#" class="list-group-item list-group-item-inverse text-ellipsis">
                                <span class="badge badge-inverse">14.99%</span>
                                3. USA
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            
            <!-- end row --></div>
        </div>
               
        @endsection