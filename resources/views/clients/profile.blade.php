@extends('hrMaster') 

@section('urlTitles')
<?php session(['title' => 'Clients']);
session(['subtitle' => '']); ?>
@endsection

@section('content')
<div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li><a href="javascript:;">Clients</a></li>
                <li><a href="javascript:;">Profile</a></li>
                 
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Client Profile <small> </small></h1>
            <!-- end page-header -->
            <!-- begin profile-container -->
            <div class="profile-container">
                <!-- begin profile-section -->
                <div class="profile-section">
                    <!-- begin profile-left -->
                    <div class="profile-left">
                        <!-- begin profile-image -->
                        <div class="profile-image">
                            <img src="{!! $profile_pic !!}" />
                            <i class="fa fa-user hide"></i>
                        </div>
                        <!-- end profile-image -->
                         
                        <!-- begin profile-highlight -->
                         

                        <div>
                            <div class="checkbox m-b-5 m-t-0">
                                <a href="javascript:;" class="btn btn-inverse btn-xs m-r-5"><i class="fa fa-user"></i> New Contact</a>  
                            </div> 

                            
                            <div class="checkbox m-b-5 m-t-0">
                                <a href="javascript:;" class="btn btn-warning btn-xs m-r-5"><i class="fa fa-phone"></i> New Call</a>  
                            </div> 
 
                            <div class="checkbox m-b-5 m-t-0">
                                <a href="{{action('ClientsController@edit',base64_encode($client->id))}}" class="btn btn-success btn-xs m-r-5"><i class="fa fa-edit"></i> Edit Profile</a>  
                            </div> 
                        </div>

                     
                        <!-- end profile-highlight -->
                    </div>
                    <!-- end profile-left -->
                    <!-- begin profile-right -->
                    <div class="profile-right">
                        <!-- begin profile-info -->
                        <div class="profile-info">
                            <!-- begin table -->
                            <div class="table-responsive">
                            @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}   
                                        </div>
                                    @endif
                                <table class="table table-profile table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <h4>{{ $client->name }} <small>{!! $client->industryName !!}</small></h4>
                                            </th>
                                        </tr>
                                    </thead> 

                                    <tbody>
                                        <tr class="highlight">
                                            <td class="field">Status</td>
                                            <td>{{ $client->currentStatus }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="field">BD Grade</td>
                                            <td>{{ $client->bdGrade }}</td>
                                        </tr>
                                        <tr>
                                            <td class="field">Parent Company</td>
                                            <td>
                                            @if($client->parentCompany)
                                            <a href="{{action('ClientsController@profile',base64_encode($client->parent_company))}}">{{ $client->parentCompany }}</a> 
                                            @else None 
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Description</td>
                                            <td>{{ $client->description }}</td>
                                        </tr>
                           
             
                                        <tr class="highlight">
                                            <td class="field">URL</td>
                                            <td>@if($client->url)<a target="_blank" href="{{ $client->url }}">Link</a> @else Not Available @endif</td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="field">Phone</td>
                                            <td>
                                                <i class="fa fa-mobile fa-lg m-r-5"></i> {{ $client->phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Country</td>
                                            <td>{{ $client->countryName }}</td>
                                        </tr>
                                        <tr>
                                            <td class="field">City</td>
                                            <td>@if($client->city) {{ $client->cityName }} @else Multiple Cities @endif</td>
                                        </tr>
                                        <tr>
                                            <td class="field">Address</td>
                                            <td>{{ $client->address }}</td>
                                        </tr>
                                        <tr>
                                            <td class="field">Postal Code</td>
                                            <td>{{ $client->postal_code }}</td>
                                        </tr>
                                        <tr>
                                            <td class="field">Subsidiaries</td>
                                            <td>
                                            <?php $flag=0;?>
                                            @foreach($subsidiaries AS $subsidiary)
                                            <a href="{{action('ClientsController@profile',base64_encode($subsidiary->id))}}">{{ $subsidiary->name }}</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php $flag++;?>
                                            @endforeach
                                            @if(!$flag)  None  @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="right">
                                        Added by {{ $client->addedBy }} on {{ date('d-M-Y',strtotime($client->created_at)) }} at {{ date('h:i:a',strtotime($client->created_at)) }} 
                                            </td>
                                        </tr>

                                         
                                   
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table -->
                        </div>
                        <!-- end profile-info -->
                    </div>
                    <!-- end profile-right -->
                </div>
                <!-- end profile-section -->
                 
                  </div><br>

            <!-- end profile-container --> 
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#default-tab-1" data-toggle="tab"><i class="fa fa-user"></i> Contacts</a></li>
                        <li class=""><a href="#default-tab-2" data-toggle="tab"><i class="fa fa-phone"></i> Call History</a></li>
                        <li class=""><a href="#default-tab-3" data-toggle="tab"><i class="fa fa-history"></i> Edit History</a></li> 
                        <li class=""><a href="#default-tab-4" data-toggle="tab"><i class="fa fa-trash"></i> Deleted Contacts</a></li>
                    </ul>
                    <div class="tab-content">
                        
                        
                        <div class="tab-pane fade active in" id="default-tab-1">
                         <div class="panel-body">
                         <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th class="nosort">#</th>
                                    <th>Name</th>
                                    <th>Position</th> 
                                    <th>Mobile</th> 
                                    <th>Phone</th> 
                                    <th>Notes</th> 
                                    <th>Added</th> 
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    </tr>
                                    </tbody>
                                    </table>
                            </div>
                            </div>
                      
      <!----------------------------------------------------Call History------------------------------------------------------------------------------- -->                
                      
                        <div class="tab-pane fade" id="default-tab-2">
                        <div class="panel-body">
                       <table id="data-table2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th class="nosort">#</th>
                                    <th>Name</th>
                                    <th>Position</th> 
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr><td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    </div>
                            
                        </div>
                        
              <!-----------------------------------------------------Edit History------------------------------------------------------------------------------ -->          
                        
                        <div class="tab-pane fade" id="default-tab-3">
                             
                           <div class="panel-body">  
                            <table id="data-table3" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th class="nosort">#</th>
                                    <th>Date</th> 
                                    <th>Changes</th>
                                    <th>Admin</th> 
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($changes AS $index => $change)
                                    <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ date('d-M-Y',strtotime($change->dated)) }} at {{ date('h:i:a',strtotime($change->dated)) }} </td>
                                    <td>{!! $change->changes !!}</td>
                                    <td>{{ $change->addedBy }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                             </div>
                             
                        </div>
                        
    <!------------------------------------------------------------Deleted Contacts----------------------------------------------------------------------- -->                    
                         
                      <div class="tab-pane fade" id="default-tab-4">
                            <div class="panel-body">
                             <table id="data-table4" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th class="nosort">#</th>
                                    <th>ID</th>
                                    <th>Student</th> 
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr><td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    </tr>
                                    </tbody>
                                    </table>
                        </div>
                        </div>
                      
                      
                    </div>
                     
                     
                </div>
                         
                    </div>
                    <!-- end row -->
                 
               
          
        </div>

        <script>
        $(document).ready(function() {
                                            
            $('#data-table2').dataTable( {
                "paging":   false,
                "ordering": true,
                "info":     false,
                "aaSorting": [],
                "columnDefs": [ {
                      "targets": 'nosort',
                      "bSortable": false,
                      "searchable": false
                    } ]
            } );
            

            $('#data-table3').dataTable( {
                "paging":   false,
                "ordering": true,
                "info":     false,
                "aaSorting": [],
                "columnDefs": [ {
                      "targets": 'nosort',
                      "bSortable": false,
                      "searchable": false
                    } ]
            } );

             $('#data-table4').dataTable( {
                "paging":   false,
                "ordering": true,
                "info":     false,
                "aaSorting": [],
                "columnDefs": [ {
                      "targets": 'nosort',
                      "bSortable": false,
                      "searchable": false
                    } ]
            } );

             } );

            </script>
        @endsection