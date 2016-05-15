<link href="/hr_assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
<div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <div data-scrollbar="true" data-height="100%">
                <!-- begin sidebar user -->
                <ul class="nav">
                    <li class="nav-profile">
                         
                        <div class="info">
                           
                             {!! Auth::user()->name; !!} 
                            <small></small>
                        </div>
                    </li>
                </ul>
                <!-- end sidebar user -->
                <!-- begin sidebar nav -->
                <ul class="nav">
                    <li class="nav-header">Navigation</li>
<!-- **************************************************************************************************************************************** -->                    
                    <li @if(session('title') == 'Home') class="active" @endif><a href="/hrm/home"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
<!-- ***********************************************************Payments***************************************************************************** -->                   
                      
                    <li class="has-sub @if(session('title') == 'Clients')   active @endif">
                        <a href="javascript:;">
                             <b class="caret pull-right"></b>
                            <i class="fa fa-institution alias"></i> 
                            <span>Clients</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="\hrm\clients">List of Clients</a></li>
                            <li @if(session('subtitle') == 'addClient') class="active" @endif><a href="\hrm\clients\add">Add Client</a></li>
                            <li><a href="email_inbox_v2.html">Search <i class="fa fa-binoculars text-theme m-l-5"></i></a></li>
                            <li><a href="email_compose.html">Contacts <i class="fa fa-binoculars text-theme m-l-5"></i></a></li>
                            <li><a href="email_detail.html">Industries</a></li> 
                            
                        </ul>
                    </li>
 <!-- **********************************************************Administrator****************************************************************************** -->                    
                    @if( Auth::user()->hasRole('user_add') || Auth::user()->hasRole('Superman'))
                    <li class="has-sub @if(session('title') == 'Administrator')   active @endif" >
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="ion-star"></i>
                            <span>Administrator</span>
                        </a>
                        <ul class="sub-menu">
                            @if(Auth::user()->hasRole('user_add'))
                            <li @if(session('subtitle') == 'users') class="active" @endif><a href="/hrm/users">Users</a></li> 
                            <li @if(session('subtitle') == 'register') class="active" @endif><a href="/hrm/users/register">Add Users</a></li>@endif
                            @if(Auth::user()->hasRole('Superman'))
                            <li @if(session('subtitle') == 'Roles') class="active" @endif><a href="/hrm/roles">Roles</a></li>
                            <li @if(session('subtitle') == 'addRoles') class="active" @endif><a href="/hrm/roles/create">Add Roles</a></li>@endif
                             
                        </ul>
                    </li>
                    @endif
 <!-- **********************************************************Administrator****************************************************************************** -->     
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-database"></i>
                            <span>Assets  </span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="extra_timeline.html">Assets Store</a></li>
                            <li><a href="extra_coming_soon.html">Add Item</a></li>
                            <li><a href="extra_search_results.html">Branch Assets</a></li>
                            <li><a href="extra_invoice.html">Rooms</a></li>
                             
                        </ul>
                    </li>
                     
                     
                     
                     
                    <!-- begin sidebar minify button -->
                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                    <!-- end sidebar minify button -->
                </ul>
                <!-- end sidebar nav -->
            </div>
            <!-- end sidebar scrollbar -->
        </div>
        <div class="sidebar-bg"></div>