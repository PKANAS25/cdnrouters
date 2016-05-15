@extends('master')  
@section('content')
<div id="content">
      <div class="container">
		 
       <div class="row sidebar-page">

          <!-- Page Content -->
          <div class="col-md-9 page-content">
<!-- Start Big Heading -->
            <h4 class="classic-title"><span>Products</span></h4>

            <!-- End Big Heading -->
            <!-- Toggle -->
            <div class="panel-group">

              <!-- Start Toggle 1 -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse-1">
											<i class="fa fa-angle-down control-icon"></i>
											  General Chemicals
										</a>
									</h4>
                </div>
                <div id="collapse-1" class="panel-collapse collapse in">
                  <div class="panel-body">
                  <li>Dolomite</li>
                  <li>Costic Shoda(enik sodann parayan areelalo)</li>
                  <li>Sodium meta bi sulphate</li>
                  <li>Rbd palm</li>
                  <li>SLES</li>
                  <li>DSPTPle</li>
                  <li>reprehenderit in voluptate</li> 
                  <li>velit esse cillum dolore eu fugiat</li>
                   <li>nulla pariatur.</li> 
                   <li>The point of</li> 
                  </div>
                </div>
              </div>
              <!-- End Toggle 1 -->

              <!-- Start Toggle 3 -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse-2" class="collapsed" >
											<i class="fa fa-angle-down control-icon"></i>
											 Flooring Solutions
										</a>
									</h4>
                </div>
                <div id="collapse-2" class="panel-collapse collapse">
                  <div class="panel-body"><li>weba Duis aute irure dolor in</li>
                  <li>reprehenderit in voluptate</li> 
                  <li>velit esse cillum dolore eu fugiat</li>
                   <li>nulla pariatur.</li> 
                   <li>The point of</li> 
                   <li>using Lorem Ipsum is</li> <li>that it has a </li> 
                   <li>normal distribution of letters,</li> 
                   <li>as opposed to using </li> 
                   <li>making it look like </li></div>
                </div>
              </div>
              <!-- End Toggle 2 -->

              <!-- Start Toggle 3 -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse-3" class="collapsed">
											<i class="fa fa-angle-down control-icon"></i>
											Petroleum Products
										</a>
									</h4>
                </div>
                <div id="collapse-3" class="panel-collapse collapse">
                  <div class="panel-body"><li>Dow reprehenderit in voluptate</li> 
                  <li>velit esse cillum dolore eu fugiat</li>
                   <li>nulla pariatur.</li> 
                   <li>The point of</li> 
                   <li>using Lorem Ipsum is</li> <li>that it has a </li> 
                   <li>normal distribution of letters,</li> 
                   <li>as opposed to using </li> 
                   <li>making it look like </li></div>
                </div>
              </div>
              <!-- End Toggle 3 -->
              
               <!-- Start Toggle 4 -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse-4" class="collapsed">
											<i class="fa fa-angle-down control-icon"></i>
											Fragrance & flavours
										</a>
									</h4>
                </div>
                <div id="collapse-4" class="panel-collapse collapse">
                  <div class="panel-body">
                  <li>mane nulla pariatur.</li>
                  <li>reprehenderit in voluptate</li> 
                  <li>velit esse cillum dolore eu fugiat</li>
                   <li>nulla pariatur.</li> 
                   <li>The point of</li> 
                   <li>using Lorem Ipsum is</li> <li>that it has a </li> 
                   <li>normal distribution of letters,</li> 
                   <li>as opposed to using </li> 
                   <li>making it look like </li></div>
                </div>
              </div>
              <!-- End Toggle 4 -->

            </div>
            <!-- End Toggle -->

            <!-- Divider -->
            <div class="hr5" style=" margin-top:45px; margin-bottom:40px;"></div>


             

          </div>
          <!-- End Page Content-->

          <!--Sidebar-->
          <div class="col-md-3 sidebar right-sidebar">

            <!-- Search Widget -->

            <!-- Categories Widget -->
            <div class="widget widget-categories">
              <h4>Exclusive Products <span class="head-line"></span></h4>
              <ul>
                <li>
                  <a href="#">Martinic Acid</a>
                </li>
                <li>
                  <a href="#">Gloxo Peroxide</a>
                </li>
                <li>
                  <a href="#">Ferticraton</a>
                </li>
                <li>
                  <a href="#">Repeat avoider</a>
                </li>
              </ul>
            </div>

            <!-- Popular Posts widget -->
            <div class="widget widget-popular-posts">
              <ul>
                <li>
                    <a href="#"><img src="images/basic-chemicals.jpg" alt="" /></a>
                    <div class="clearfix"></div>
                </li>
              </ul>
            </div>

            <!-- Video Widget -->
            
 

          </div>
          <!--End sidebar-->


        </div>
</div>
</div>
@endsection