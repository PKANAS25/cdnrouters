@extends('master')  
@section('content')
<link rel="stylesheet" type="text/css" href="js/msgbox/jquery.msgbox.css" />
<script type="text/javascript" src="js/msgbox/jquery.msgbox.min.js"></script>
<div id="content">
      <div class="container">
		 
         <div class="row sidebar-page">

          <!-- Page Content -->
          <div class="col-md-9 page-content">

            <!-- Start Recent Posts Carousel -->
            <div class="latest-posts">

              <!-- Classic Heading -->
              <h4 class="classic-title"><span>Current job openings</span></h4>

               
              
              <div class="hr1" style="margin-bottom:30px;"></div>
              
              <div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="1">

                <!-- Post 1 -->
                <div class="post-row item">
                 
                  <h3 class="post-title"><a href="#">Sales Manager</a></h3>
                  <div class="post-content">
                    <p align="justify">Establishes sales objectives by forecasting and developing annual sales quotas for regions and territories; projecting expected sales volume and profit for existing and new products.Determines annual unit and gross-profit plans by implementing marketing strategies; analyzing trends and results.Maintains sales volume, product mix, and selling price by keeping current with supply and demand, changing trends, economic indicators, and competitors.</p>
<button type="button" class="btn btn-success btn-sm" onclick='$.msgbox("Send your Resume to <strong>cdnrouters@gmail.com</strong>.<br>Subject: <strong>Sales Manager</strong>", {type: "info"});'>Apply Now</button>
                  </div>
                </div> 

              </div>
              
              <div class="hr1" style="margin-bottom:30px;"></div>
              
              <div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="1">

                <!-- Post 1 -->
                <div class="post-row item">
                 
                  <h3 class="post-title"><a href="#">Logistics Co-ordinator</a></h3>
                  <div class="post-content">
                    <p align="justify">The Logistics Coordinator must be able to work as part of a team in a fast paced and pressured environment, communicating effectively with both colleagues and clients and following verbal and written instructions.You must be able to efficiently solve problems relating to sales, finance and transportation of goods in locations both national and overseas.Reviews expediting schedules on all customer orders. Obtains and forwards information to planning and sales teams.</p>
<button type="button" class="btn btn-success btn-sm" onclick='$.msgbox("Send your Resume to <strong>cdnrouters@gmail.com</strong>.<br>Subject: <strong>Logistics Co-ordinator</strong>", {type: "info"});'>Apply Now</button>
                  </div>
                </div> 

              </div>
              
              <div class="hr1" style="margin-bottom:30px;"></div>
              
              <div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="1">

                <!-- Post 1 -->
                <div class="post-row item">
                  
                  <h3 class="post-title"><a href="#">Analytical Chemist</a></h3>
                  <div class="post-content">
                    <p align="justify">Analysing samples from various sources to provide information on compounds or quantities of compounds present.Interpreting data and adhering to strict guidelines on documentation when recording data.Using a range of analytical techniques, instrumentation and software.Developing techniques for the analysis of drug products and chemicals</p>
                    <button type="button" class="btn btn-success btn-sm" onclick='$.msgbox("Send your Resume to <strong>cdnrouters@gmail.com</strong>.<br>Subject: <strong>Analytical Chemist</strong>", {type: "info"});'>Apply Now</button> 
                  </div>
                </div> 

              </div>
              
              <div class="hr1" style="margin-bottom:30px;"></div>
              
              
              
            </div>
            <!-- End Recent Posts Carousel -->

            <!-- Divider -->
            

             
 

          </div>
          <!-- End Page Content-->


          <!--Sidebar-->
          <div class="col-md-3 sidebar right-sidebar">

            <!-- Search Widget -->
            <div class="widget widget-search">
              <form action="#">
                <input type="search" placeholder="Job search..." />
                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>

            <!-- Categories Widget -->
            <div class="widget widget-categories">
              <h4>Departments <span class="head-line"></span></h4>
              <ul>
                <li>
                  <a href="#">Human Resource</a>
                </li>
                <li>
                  <a href="#">Sales & Marketing</a>
                </li>
                <li>
                  <a href="#">Research & Development</a>
                </li>
                <li>
                  <a href="#">Information Technology</a>
                </li>
                 <li>
                  <a href="#">Logistics</a>
                </li>
              </ul>
            </div>
 
             <div class="widget widget-popular-posts">
              
              <ul>
                <li>
                  
                    <a href="#"><img  src="images/hr-pic.jpg" alt="" /></a>
                   
                   
                  <div class="clearfix"></div>
                </li>
                 
              </ul>
            </div>

          </div>
          <!--End sidebar-->


        </div>
		 
    
</div>
</div>

@endsection