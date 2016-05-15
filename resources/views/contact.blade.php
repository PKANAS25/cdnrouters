@extends('master')  
@section('content')
<!-- ================Formavalidation.io========================= -->
	<link rel="stylesheet" href="dist/css/formValidation.css"/>

    
   <!-- <script type="text/javascript" src="/dist/bootstrap/js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="dist/js/formValidation.js"></script>
    <script type="text/javascript" src="dist/js/framework/bootstrap.js"></script>
<!-- ==================================================================================== -->    
<script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<!-- Start Map -->
    <div id="map" data-position-latitude="11.1839421" data-position-longitude="75.8308296"></div>
    <script>
      (function($) {
        $.fn.CustomMap = function(options) {

          var posLatitude = $('#map').data('position-latitude'),
            posLongitude = $('#map').data('position-longitude');

          var settings = $.extend({
            home: {
              latitude: posLatitude,
              longitude: posLongitude
            },
            text: '<div class="map-popup"><h4>CDN Routers | The Distribution Company </h4></div>',
            icon_url: $('#map').data('marker-img'),
            zoom: 15
          }, options);

          var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);

          return this.each(function() {
            var element = $(this);

            var options = {
              zoom: settings.zoom,
              center: coords,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              mapTypeControl: false,
              scaleControl: false,
              streetViewControl: false,
              panControl: true,
              disableDefaultUI: true,
              zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT
              },
              overviewMapControl: true,
            };

            var map = new google.maps.Map(element[0], options);

            var icon = {
              url: settings.icon_url,
              origin: new google.maps.Point(0, 0)
            };

            var marker = new google.maps.Marker({
              position: coords,
              map: map,
              icon: icon,
              draggable: false
            });

            var info = new google.maps.InfoWindow({
              content: settings.text
            });

            google.maps.event.addListener(marker, 'click', function() {
              info.open(map, marker);
            });

            var styles = [{
              "featureType": "landscape",
              "stylers": [{
                "saturation": -100
              }, {
                "lightness": 65
              }, {
                "visibility": "on"
              }]
            }, {
              "featureType": "poi",
              "stylers": [{
                "saturation": -100
              }, {
                "lightness": 51
              }, {
                "visibility": "simplified"
              }]
            }, {
              "featureType": "road.highway",
              "stylers": [{
                "saturation": -100
              }, {
                "visibility": "simplified"
              }]
            }, {
              "featureType": "road.arterial",
              "stylers": [{
                "saturation": -100
              }, {
                "lightness": 30
              }, {
                "visibility": "on"
              }]
            }, {
              "featureType": "road.local",
              "stylers": [{
                "saturation": -100
              }, {
                "lightness": 40
              }, {
                "visibility": "on"
              }]
            }, {
              "featureType": "transit",
              "stylers": [{
                "saturation": -100
              }, {
                "visibility": "simplified"
              }]
            }, {
              "featureType": "administrative.province",
              "stylers": [{
                "visibility": "on"
              }]
            }, {
              "featureType": "water",
              "elementType": "labels",
              "stylers": [{
                "visibility": "on"
              }, {
                "lightness": -25
              }, {
                "saturation": -100
              }]
            }, {
              "featureType": "water",
              "elementType": "geometry",
              "stylers": [{
                "hue": "#ffff00"
              }, {
                "lightness": -25
              }, {
                "saturation": -97
              }]
            }];

            map.setOptions({
              styles: styles
            });
          });

        };
      }(jQuery));

      jQuery(document).ready(function() {
        jQuery('#map').CustomMap();
      });
    </script>
    <!-- End Map -->
    
     <div id="content">
      <div class="container">
		 
        
        <div class="row">

          <div class="col-md-8">

            <!-- Classic Heading -->
            <h4 class="classic-title"><span>Write to Us</span></h4>

            <!-- Start Contact Form -->


            <form name="contact-form"  id="contact-form" class="contact-form"  method="post" autocomplete="OFF" data-fv-framework="bootstrap"   data-fv-icon-invalid="glyphicon glyphicon-remove"  data-fv-icon-validating="glyphicon glyphicon-refresh">
            {!! csrf_field() !!}
            @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
			@endforeach
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}   
			</div>
				@endif
              <div class="form-group">
                <div class="controls">
                  <input type="text"   placeholder="Name" name="name" data-fv-notempty="true"  data-fv-message="Please enter your name">
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <input type="email" class="email" placeholder="Email" name="email" data-fv-notempty="true" data-fv-message="Please enter a valid email">
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <input type="text"   placeholder="Mobile" name="mobile" data-fv-notempty="true" data-fv-message="Please enter your phone number">
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <input type="text"  placeholder="Subject" name="subject" data-fv-notempty="true" data-fv-message="Please enter a subject">
                </div>
              </div>

              <div class="form-group">

                <div class="controls">
                  <textarea rows="7"  placeholder="Message" name="message" data-fv-notempty="true" data-fv-message="Please enter your message"></textarea>
                </div>
              </div>
              <button type="submit" id="something" class="btn-system btn-large">Send</button>
              <div id="success" style="color:#34495e;"></div>
            </form>
            <!-- End Contact Form -->

          </div>

          <div class="col-md-4">

            <!-- Classic Heading -->
            <h4 class="classic-title"><span>Information</span></h4>

            <!-- Some Info -->
            <p><strong>Countrywide Distribution Network Routers</strong></p>

            <!-- Divider -->
            <div class="hr1" style="margin-bottom:10px;"></div>

            <!-- Info - Icons List -->
            <ul class="icons-list">
              <li><i class="fa fa-globe">  </i> <strong>Address:</strong> Cheruvannur - Calicut, Panamanna - Palakkad</li>
              <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> info@cdnrouters.com</li>
              <li><i class="fa fa-mobile"></i> <strong>Phone:</strong> +91 9846 166 222</li>
            </ul>

            <!-- Divider -->
            <div class="hr1" style="margin-bottom:15px;"></div>

            <!-- Classic Heading -->
            <h4 class="classic-title"><span>Working Hours</span></h4>

            <!-- Info - List -->
            <ul class="list-unstyled">
              <li><strong>Monday - Saturday</strong> - 9am to 6pm</li>
              <li><strong>Sunday</strong> - Closed</li>
            </ul>

          </div>

        </div>
          
		 
    
</div>
</div>
<script>
 $(document).ready(function() {
           
	$('#contact-form').formValidation({
              fields: {
                    mobile: {
                        validators: {
                            notEmpty: {},
                            digits: {},
                            phone: {
                                country: 'IN'
                            }
                        }
                    }
                }
            });
});
 </script>
@endsection