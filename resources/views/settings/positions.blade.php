@extends('formsMaster')

@section('urlTitles')
<?php session(['title' => 'Settings']);
session(['subtitle' => 'designations']); ?>
@endsection

@section('content')
<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Positions</a></li>
				<li class="active"><a href="javascript:;">List</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Positions <small></small></h1>
			<!-- end page-header -->
			<!-- begin row -->
            <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                        <div class="panel-heading hidden-print">
                            
                            <h4 class="panel-title">List</h4>
                        </div>
                        
                        <div class="panel-body">

                        <form class="form-inline hidden-print" name="eForm" id="eForm"  method="post" autocomplete="OFF">
                         @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                             <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
                                 <div class="form-group m-r-10">
                                    <label class="control-label col-md-4 col-sm-4" for="name">Position Name:</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" id="name"   name="name" data-fv-notempty="true"   value="{{ old('name') }}" />
                                    </div>
                                </div>
                                
                                 
                                <button type="submit" class="btn btn-primary m-r-5">Add new</button> 
                            </form>  
                            </div>

                             </div>
            <!-- end row -->
        </div>


			 <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                         
                        <div class="panel-body">
                             @if (session('status'))
                                    <div class="alert alert-success">
                                     {{ session('status') }} 
                                    </div>
                                @endif
                               
                             <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="nosort">#</th>
                                       
                                        <th>Industry</th>
                                         
                                    </tr>
                                </thead>
                                <tbody> 
                                     @foreach($positions As $index => $position)
                                    <tr>
                                        <td>{!! $index+1 !!}</td> 
                                        <td>{!! $position->position !!}</td> 
                                        
                                    </tr>
                                     
                                @endforeach
                                     
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div> 
                    <!-- end panel --> 
                </div>
			<!-- end row -->
		</div>
         <script>
        $(document).ready(function() {
            App.init(); 

            $('#data-table').dataTable( {
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


           

        <!-- -------------------------------------------------==================--------------------------------------------- -->

          

            $('#eForm').formValidation({
                message: 'This value is not valid',
                

                fields: {
                      
                     
            name: {
                     
                     verbose: false,
                     
                     validators: {
                     
                     notEmpty: {},
                     remote: {
                        url: '/positionAddCheck' , 

                    }
                }
            }
        }
    })
     
    // This event will be triggered when the field passes given validator
    .on('success.validator.fv', function(e, data) {
        // data.field     --> The field name
        // data.element   --> The field element
        // data.result    --> The result returned by the validator
        // data.validator --> The validator name 
         

        if (data.field === 'name'
            && data.validator === 'remote'
            && (data.result.available === false || data.result.available === 'false'))
        {

            // The userName field passes the remote validator
            data.element                    // Get the field element
                .closest('.form-group')     // Get the field parent

                // Add has-warning class
                .removeClass('has-success')
                .addClass('has-warning')

                // Show message
                .find('small[data-fv-validator="remote"][data-fv-for="name"]')
                    .show();
        }


        if (data.field === 'name'
            && data.validator === 'remote'
            && (data.result.available === true || data.result.available === 'true'))
        {
             
            // The userName field passes the remote validator
            data.element                    // Get the field element
                .closest('.form-group')     // Get the field parent

                // Add has-warning class
                .removeClass('has-warning')
                .addClass('has-success')

                // Show message
                .find('small[data-fv-validator="remote"][data-fv-for="name"]')
                    .show();
        }

    })
    // This event will be triggered when the field doesn't pass given validator
    .on('err.validator.fv', function(e, data) { 
         
        // We need to remove has-warning class
        // when the field doesn't pass any validator
         

        if (data.field === 'name') {
            data.element
                .closest('.form-group')
                .removeClass('has-warning')
                  

        }
    });

  });

                            
    </script>

                            
    </script>
        @endsection