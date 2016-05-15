<div class="navbar navbar-default navbar-top">
        <div class="container">
          <div class="navbar-header">
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            <!-- End Toggle Nav Link For Mobiles -->
            <a class="navbar-brand" ><img alt="" src="images/logo2.png"></a>
          </div>
          <div class="navbar-collapse collapse">
            
            <!-- Start Navigation List -->
            <ul class="nav navbar-nav navbar-right">
              <li><a @if($pager=='home') class="active" @endif href="home">Home</a></li>
              <li><a @if($pager=='about') class="active" @endif href="about">About</a></li>
              <li><a @if($pager=='products') class="active" @endif href="products">Products</a></li>
              <li><a @if($pager=='careers') class="active" @endif href="careers">Careers</a></li>
              <li><a @if($pager=='contact') class="active" @endif href="contact">Contact</a></li>
            </ul>
            <!-- End Navigation List -->
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="wpb-mobile-menu">
          	  <li><a @if($pager=='home') class="active" @endif href="home">Home</a></li>
              <li><a @if($pager=='about') class="active" @endif href="about">About</a></li>
              <li><a @if($pager=='products') class="active" @endif href="products">Products</a></li>
              <li><a @if($pager=='careers') class="active" @endif href="careers">Careers</a></li>
              <li><a @if($pager=='contact') class="active" @endif href="contact">Contact</a></li>
        </ul>
        <!-- Mobile Menu End -->

      </div>