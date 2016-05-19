@extends('formsMaster') 

@section('urlTitles')
<?php session(['title' => 'Clients']);
session(['subtitle' => '']); ?>
@endsection


@section('content')
 
<div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li><a href="javascript:;">Call</a></li>
                <li class="active"><a href="javascript:;">Add</a></li>
                 
            </ol> 
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">{{ $client->name }} <small> New Call</small></h1>
            <!-- end page-header -->
            <!-- begin row -->
             <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                
                                
                            </div>
                            <h4 class="panel-title">Add new call to {{ $client->name }}</h4>
                        </div>
                        <div class="panel-body">

                            <i class="fa fa-arrow-left"></i> <a href="{!! action('ClientsController@profile', base64_encode($client->id)) !!}">Back to company profile </a>
                             
                            <form name="eForm" id="eForm"  method="POST" autocomplete="OFF" class="form-horizontal form-bordered"  enctype="multipart/form-data"  data-fv-framework="bootstrap"  data-fv-message="Required Field"  data-fv-icon-invalid="glyphicon glyphicon-remove"  data-fv-icon-validating="glyphicon glyphicon-refresh">

                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach

                                

                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                                <fieldset>
                                    
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Contact Person :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="form-control" id="contact_person_id" name="contact_person_id"  >
                                            <option value="">Please choose</option> 
                                            @foreach($contacts as $contact)
                                            <option value="{!! $contact->id !!}">{!! $contact->name !!}</option>
                                            @endforeach
                                        </select> 
                                        or 
                                      <input class="form-control" type="text" id="contact_person" name="contact_person" value="{{ old('name') }}" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" for="name">Call Time:</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" id="name"   name="name" data-fv-notempty="true"   value="{{ old('name') }}" />
                                    </div>
                                </div>

                                
 
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Call Importance :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="form-control"  name="importance" data-fv-notempty="true">
                                            <option value="1">Important</option> 
                                            <option value="2">Casual</option> 
                                            <option value="3">Rejection</option> 
                                        </select> 

                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" for="Notes">Call Details :</label>
                                    <div class="col-md-6 col-sm-6">
                                       <textarea class="form-control" id="call_details" name="call_details" rows="3" data-fv-notempty="true"  >{{ old('call_details') }}</textarea>
                                    </div>
                                </div> 
 
 
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4"></label>
                                    <div class="col-md-6 col-sm-6">
                                        <button type="reset" class="btn btn-sm btn-error">Reset</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>



                                </fieldset>
                            </form>
 
                        </div> 
                    <!-- end panel --> 
                </div>
            <!-- end row -->
        </div>
    </div>
    <script>
        $(document).ready(function() {
            App.init(); 

 

<!-- -------------------------------------------------==================--------------------------------------------- -->

          

            $('#eForm').formValidation({
                message: 'This value is not valid',
                

        fields: {
              
                 contact_person_id: 
                 {
                    validators:
                     {
                         callback: {
                          
                            message: 'You must choose a contact or enter contact person',
                            callback: function(value, validator, $field) {
                                    var contact_person = $('#eForm').find('[name="contact_person"]').val();
                                   if(contact_person=="" && value=="")
                                    return false;
                                else return true;
                                }
                            }
                     }
                 }
     
                }
    })
            .on('keyup', '[name="contact_person"]', function(e) {
       $('#eForm').formValidation('revalidateField', 'contact_person_id');
    });
     

  });

                            
    </script>
        @endsection