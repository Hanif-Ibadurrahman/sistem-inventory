<!DOCTYPE html>
<html lang="en">    
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

@include('layouts-sistem-inventory.head')

<body class="">   
<div class="wrapper ">   
    <div class="sidebar" data-color="orange">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->

    <div class="logo">
        <a href="{{url('dashboard')}}" class="simple-text logo-mini">
          P
        </a>

        <a href="{{url('dashboard')}}" class="simple-text logo-normal">
          PEMINJAMAN
        </a>
        
    </div>

    <div class="sidebar-wrapper" id="sidebar-wrapper">
        
        <ul class="nav">
            @if (Auth::check())    
              <!-- Untuk role member -->
              @role('member')    
              <li class="{{(request()->is('peminjaman')) ? 'active' : ''}}">
                  <a href="{{url('peminjaman')}}">
                        <i class="now-ui-icons design_bullet-list-67"></i>                      
                      <p>Peminjaman</p>
                  </a>
              </li>
              
              <li class="{{(request()->is('daftar-peminjaman')) ? 'active' : ''}}">
                  <a href="{{url('daftar-peminjaman')}}">                      
                        <i class="now-ui-icons files_paper"></i>                      
                      <p>Daftar Peminjaman</p>
                  </a>
              </li>
              
              <li class="{{(request()->is('user-profile')) ? 'active' : ''}}">
                  <a href="{{url('profile')}}">                      
                        <i class="now-ui-icons users_single-02"></i>                     
                      <p>User Profile</p>
                  </a>
              </li>
              
              <li class="{{(request()->is('history')) ? 'active' : ''}}">
                  <a href="{{url('history')}}">                      
                        <i class="now-ui-icons design_bullet-list-67"></i>                      
                      <p>History</p>
                  </a>
              </li>
              @endrole
              
              <!-- Untuk role admin -->
              @role('admin')
              <li class="{{(request()->is('dashboard')) ? 'active' : ''}}">
                  <a href="{{url('dashboard')}}">                    
                        <i class="now-ui-icons media-2_sound-wave"></i>                      
                      <p>Dashboard</p>
                  </a>
              </li>
              
              <li class="{{(request()->is('information')) ? 'active' : ''}}">
                  <a href="{{route('information.index')}}">                      
                        <i class="now-ui-icons files_paper"></i>                      
                      <p>Information</p>
                  </a>
              </li>
              
              <li class="{{(request()->is('user-profile')) ? 'active' : ''}}">
                  <a href="{{route('profile.show')}}">                      
                        <i class="now-ui-icons users_single-02"></i>                     
                      <p>User Profile</p>
                  </a>
              </li>

              <li class="{{(request()->is('inventory')) ? 'active' : ''}}">
                  <a href="{{route('inventory.index')}}">                      
                        <i class="now-ui-icons ui-2_settings-90"></i>                     
                      <p>Inventory</p>
                  </a>
              </li>

              <li class="{{(request()->is('setting')) ? 'active' : ''}}">
                  <a href="{{ route('setting.index') }}">                     
                        <i class="now-ui-icons loader_gear"></i>                      
                      <p>Setting</p>
                  </a>
              </li>
              
              <li class="{{(request()->is('history')) ? 'active' : ''}}">
                  <a href="{{route('peminjaman.riwayat')}}">                      
                        <i class="now-ui-icons design_bullet-list-67"></i>                      
                      <p>History</p>
                  </a>
              </li>
              @endrole
            @endif
        </ul>
    </div>
    </div>


<div class="main-panel" id="main-panel">
              <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
	<div class="container-fluid">
    <div class="navbar-wrapper">
      
			<div class="navbar-toggle">
				<button type="button" class="navbar-toggler">
					<span class="navbar-toggler-bar bar1"></span>
					<span class="navbar-toggler-bar bar2"></span>
					<span class="navbar-toggler-bar bar3"></span>
				</button>
			</div>
      
			<a class="navbar-brand" href="">List Inventory</a>
		</div>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-bar navbar-kebab"></span>
			<span class="navbar-toggler-bar navbar-kebab"></span>
			<span class="navbar-toggler-bar navbar-kebab"></span>
		</button>

	    <div class="collapse navbar-collapse justify-content-end" id="navigation">

<ul class="navbar-nav">
  <li class="nav-item">
    @role('admin')
    <a class="nav-link" href="{{route('profile.show')}}">
    @else
    <a class="nav-link" href="{{url('profile')}}">
    @endrole
      <i class="now-ui-icons users_single-02"></i>
      <p>
        <span class="d-lg-none d-md-block">Account</span>
      </p>
    </a>
  </li>
</ul>

	    </div>
	</div>
</nav>
<!-- End Navbar -->

<div class="panel-header panel-header-sm">

</div>

@include('layouts-sistem-inventory.flash')

@yield('content')

@include('layouts-sistem-inventory.footer')

</div>         
             </div>
          
        </div>
        
<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
			<li class="header-title"> Sidebar Background</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors text-center">
						<span class="badge filter badge-yellow" data-color="yellow"></span>
                        <span class="badge filter badge-blue" data-color="blue"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange active" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
        </ul>
    </div>
</div>    

<script src="{{asset('assets-sistem-inventory/js/core/jquery.min.js')}}" ></script>
<script src="{{asset('assets-sistem-inventory/js/core/popper.min.js')}}" ></script>
<script src="{{asset('assets-sistem-inventory/js/core/bootstrap.min.js')}}" ></script>
<script src="{{asset('assets-sistem-inventory/js/plugins/perfect-scrollbar.jquery.min.js')}}" ></script>
<script src="{{asset('assets-sistem-inventory/js/ie10-viewport-bug-workaround.js')}}" ></script>

<script async defer src="../../../buttons.github.io/buttons.js"></script>

<script src="{{asset('assets-sistem-inventory/js/plugins/chartjs.min.js')}}"></script>

<script src="{{asset('assets-sistem-inventory/js/timepicker.js')}}"></script>

<script src="{{asset('assets-sistem-inventory/js/plugins/bootstrap-notify.js')}}"></script>

<script src="{{asset('assets-sistem-inventory/js/now-ui-dashboard.min44ca.js?v=1.4.0')}}" type="text/javascript"></script>

<script type="text/javascript">
      $( document ).ready(function(){
        $(".simpleExample").timepicker();
      });
</script>

<script>
  $(document).ready(function(){
    $().ready(function(){
        $sidebar = $('.sidebar');
        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
        //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
        //         $('.fixed-plugin .dropdown').addClass('show');
        //     }
        //
        // }

        $('.fixed-plugin a').click(function(event){
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
            if($(this).hasClass('switch-trigger')){
                if(event.stopPropagation){
                    event.stopPropagation();
                }
                else if(window.event){
                   window.event.cancelBubble = true;
                }
            }
        });

        $('.fixed-plugin .background-color span').click(function(){
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            var new_color = $(this).data('color');

            if($sidebar.length != 0){
                $sidebar.attr('data-color',new_color);
            }

            if($full_page.length != 0){
                $full_page.attr('filter-color',new_color);
            }

            if($sidebar_responsive.length != 0){
                $sidebar_responsive.attr('data-color',new_color);
            }
        });

        $('.fixed-plugin .img-holder').click(function(){
            $full_page_background = $('.full-page-background');

            $(this).parent('li').siblings().removeClass('active');
            $(this).parent('li').addClass('active');


            var new_image = $(this).find("img").attr('src');

            if( $sidebar_img_container.length !=0 && $('.switch-sidebar-image input:checked').length != 0 ){
                $sidebar_img_container.fadeOut('fast', function(){
                   $sidebar_img_container.css('background-image','url("' + new_image + '")');
                   $sidebar_img_container.fadeIn('fast');
                });
            }

            if($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0 ) {
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                $full_page_background.fadeOut('fast', function(){
                   $full_page_background.css('background-image','url("' + new_image_full_page + '")');
                   $full_page_background.fadeIn('fast');
                });
            }

            if( $('.switch-sidebar-image input:checked').length == 0 ){
                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                $sidebar_img_container.css('background-image','url("' + new_image + '")');
                $full_page_background.css('background-image','url("' + new_image_full_page + '")');
            }

            if($sidebar_responsive.length != 0){
                $sidebar_responsive.css('background-image','url("' + new_image + '")');
            }
        });

        $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function(){
            $full_page_background = $('.full-page-background');

            $input = $(this);

            if($input.is(':checked')){
                if($sidebar_img_container.length != 0){
                    $sidebar_img_container.fadeIn('fast');
                    $sidebar.attr('data-image','#');
                }

                if($full_page_background.length != 0){
                    $full_page_background.fadeIn('fast');
                    $full_page.attr('data-image','#');
                }

                background_image = true;
            } else {
                if($sidebar_img_container.length != 0){
                    $sidebar.removeAttr('data-image');
                    $sidebar_img_container.fadeOut('fast');
                }

                if($full_page_background.length != 0){
                    $full_page.removeAttr('data-image','#');
                    $full_page_background.fadeOut('fast');
                }

                background_image = false;
            }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function(){
          var $btn = $(this);

          if(sidebar_mini_active == true){
              $('body').removeClass('sidebar-mini');
              sidebar_mini_active = false;
              nowuiDashboard.showSidebarMessage('Sidebar mini deactivated...');
          }else{
              $('body').addClass('sidebar-mini');
              sidebar_mini_active = true;
              nowuiDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function(){
              window.dispatchEvent(new Event('resize'));
          },180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function(){
              clearInterval(simulateWindowResize);
          },1000);
        });
    });
  });
</script>

</body>
</html>
