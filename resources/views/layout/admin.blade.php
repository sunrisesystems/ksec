<?php 
$currentController  = Lib::currentController();
$currentAction      = Lib::currentAction();
$currentCA          = $currentController ."_".$currentAction;
//echo $currentController." ".$currentAction; 
?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{!! csrf_token() !!}" />
    <title>Kotak Securities - SQ</title>
	
	<link href='//fonts.googleapis.com/css?family=Raleway:300,400,600,700,800' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
	
	
	<!-- Bootstrap -->
	{!! HTML::style('css/bootstrap.css') !!}
	{!! HTML::style('css/jquery.alerts.css') !!}
    {!! HTML::style('css/jquery-ui.css') !!}
	{!! HTML::style('css/admins/animate.css') !!}
	{!! HTML::style('css/admins/font-awesome.css') !!}
	<!-- custom style sheet -->
    {!! HTML::style('css/admins/style.css') !!}
    {!! HTML::style('css/admins/jquery.datetimepicker.css') !!}
	
	{!! HTML::script('js/admins/jquery-1.11.1.min.js') !!}	
	{!! HTML::script('js/admins/jquery-ui.min.js') !!}
	{!! HTML::script('js/bootstrap.js') !!}
	{!! HTML::script('js/admins/jquery.metisMenu.js') !!}
	{!! HTML::script('js/admins/lib_functions.js') !!}
	{!! HTML::script('js/admins/jquery.slimscroll.js') !!}	
    {!! HTML::script('js/admins/jquery.alerts.js') !!}
	{!! HTML::script('js/admins/bootstrap-filestyle.min.js') !!}
    {!! HTML::script('js/admins/jquery-migrate-1.2.1.js')!!}
    {!! HTML::script('js/admins/jquery.datetimepicker.full.js')!!}
    {!! HTML::script('js/admins/jquery.dynotable.js')!!}
    
    <script type="text/javascript">
    function doCancel(url) {
        window.location.href = url;
    }

    $.ajaxSetup({
    	headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
	});
    var base_url = '{!! Request::root() !!}';
    $(document).ready(function(){
    	$("#message").delay(800).fadeOut(10000);
    	$(".validationAlert .error .validationError .alert-danger,.alert-success").delay(800).fadeOut(10000);
    });
    jQuery.fn.ForceNumericOnly =
    function () {
        return this.each(function () {
            $(this).keydown(function (e) {
                var key = e.charCode || e.keyCode || 0;
                // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                return (
                        key == 8 ||
                        key == 13 ||
                        key == 9 ||
                        key == 45 ||
                        key == 46 ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105) ||
                        key == 189 ||
                        key == 173 ||key == 37 ||key == 39 ||
                        key == 109 ||
                        key == 190 ||
                        key == 110
                    );
            });
        });
    };
 

    </script>
	{!! HTML::script('js/admins/main.js') !!}
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body <?php if($currentCA == 'admin_login') { ?> class="login-page" <?php } ?> class="pace-done fixed-sidebar fixed-nav">
	<div class="busy" id="background-loader">
		<div id="preloader">
		</div>
	</div>
	<div id="wrapper">
	<?php if($currentCA != 'admin_login' && $currentCA != 'admin_forgotpassword') { ?>      

			<!-- sidebar -->
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
					<section class="logo-wrapper">
						<div class="logo-brand">
							<a class="navbar-brand" href="javascript::void(0)">KSEC</a>
						</div>
					</section>
					<ul class="nav metismenu" id="side-menu">
					
						<li <?php if($currentCA == 'employee_index' || $currentCA == 'employee_create' || $currentCA == 'employee_edit' || $currentCA == 'employee_resetpassword' || $currentCA == 'role_index' || $currentCA == 'role_create' || $currentCA == 'role_edit') { ?> class="active dropdown" <?php } else {?> class="dropdown" <?php }?>>
							<a href=""><i class="icon-left fa fa-user"></i> System <i class="fa fa-angle-right"></i></a>
							<ul class="nav nav-second-level ">
												
								<li <?php if($currentCA == 'employee_index' || $currentCA == 'employee_create' || $currentCA == 'employee_edit' || $currentCA == 'employee_resetpassword') { ?> class="active" <?php } ?>>
									<a href="{!! route('employees.index') !!}">Employees</a>
								</li>
														
								<li <?php if($currentCA == 'role_index' || $currentCA == 'role_create' || $currentCA == 'role_edit') { ?> class="active" <?php } ?>>
									<a href="{!! route('roles.index') !!}">Role</a>
								</li>
								
							</ul>
						</li>
					

                       <li <?php if($currentCA == 'product_index' || $currentCA == 'product_create' || $currentCA == 'product_edit' || $currentCA == 'productcategory_index' || $currentCA == 'productcategory_create' || $currentCA == 'productcategory_edit' || $currentCA == 'productsubcategory_index' || $currentCA == 'productsubcategory_create' || $currentCA == 'productsubcategory_edit' || $currentCA == 'offers_index' || $currentCA == 'offers_create' || $currentCA == 'offers_edit' || $currentCA == 'search_index' || $currentCA == 'search_create' || $currentCA == 'search_edit') { ?> class="active" <?php } ?>>
							<a href="javascript::void(0)" ><i class="icon-left fa fa-th-large"></i> Product <i class="fa fa-angle-right"></i></a>						
							<ul class="nav nav-second-level ">
													
								<li <?php if($currentCA == 'product_index' || $currentCA == 'product_create' || $currentCA == 'product_edit') { ?> class="active" <?php } ?>>
									<a href="{!! route('products.index') !!}">Products</a>
								</li>
								
								<li <?php if($currentCA == 'productcategory_index' || $currentCA == 'productcategory_create' || $currentCA == 'productcategory_edit') { ?> class="active" <?php } ?>>
									<a href="{!! route('product-category.index') !!}">Category</a>
								</li>

								<li <?php if($currentCA == 'productsubcategory_index' || $currentCA == 'productsubcategory_create' || $currentCA == 'productsubcategory_edit') { ?> class="active" <?php } ?>>
									<a href="{!! route('product-subcategory.index') !!}">Subcategory</a>
								</li>

								<li <?php if($currentCA == 'offers_index' || $currentCA == 'offers_create' || $currentCA == 'offers_edit') { ?> class="active" <?php } ?>>
									<a href="{!! route('offers.index') !!}">Offers</a>
								</li>

								<li <?php if($currentCA == 'search_index' || $currentCA == 'search_create' || $currentCA == 'search_edit') { ?> class="active" <?php } ?>>
									<a href="{!! route('voice.create') !!}">Voice</a>
								</li>
							
							</ul>						
						</li> 
                   
						@if (Lib::checkMenuAccess('drawing') || Lib::checkMenuAccess('mold') || Lib::checkMenuAccess('machinemodel') || Lib::checkMenuAccess('machine') || Lib::checkMenuAccess('downtime') || Lib::checkMenuAccess('defect') || Lib::checkMenuAccess('planning') || Lib::checkMenuAccess('hourlyentry') || Lib::checkMenuAccess('dailyentry'))
                       <!-- <li >
							<a href="javascript:void(0)" >
								<i class="icon-left fa fa-industry"></i> Production <i class="fa fa-angle-right"></i>
							</a>
							<ul class="nav nav-second-level ">
								@if (Lib::checkMenuAccess('drawing') || Lib::checkMenuAccess('mold') || Lib::checkMenuAccess('machinemodel') || Lib::checkMenuAccess('machine') || Lib::checkMenuAccess('downtime') || Lib::checkMenuAccess('defect'))
								<li > 
									<a href="#" >Masters <i class="fa fa-angle-right"></i></a>
									<ul class="nav nav-third-level ">
										
									</ul>
								</li>
								@endif								
							</ul>
							 <ul class="nav nav-second-level ">
							 	@if(Lib::checkMenuAccess('planning') || Lib::checkMenuAccess('hourlyentry') || Lib::checkMenuAccess('dailyentry'))
								<li > 
									<a href="javascript:void(0)" >Transactions <i class="fa fa-angle-right"></i></a>
									<ul class="nav nav-third-level ">
										@if (Lib::checkMenuAccess('planning'))
										<li >
											<a href="{!!URL::to('planning')!!}">Planning</a>
										</li>
										@endif
										@if (Lib::checkMenuAccess('hourlyentry'))
										<li >
											<a href="{!!URL::to('hourlyEntry')!!}">Hourly Entry</a>
										</li>
										@endif
										@if (Lib::checkMenuAccess('dailyentry'))
										<li >
											<a href="{!!URL::to('dailyEntry')!!}">Daily Entry</a>
										</li>
										@endif
									</ul>
								</li>
								@endif								
							</ul> 
						</li> -->
						@endif
						@if (Lib::checkMenuAccess('product') || Lib::checkMenuAccess('item') || Lib::checkMenuAccess('packingmatrix') || Lib::checkMenuAccess('invert') || Lib::checkMenuAccess('rejection'))
						<!--<li >
							<a href="javascript:void(0)" >
								<i class="icon-left glyphicon glyphicon-inbox"></i> Inventory <i class="fa fa-angle-right"></i>
							</a>
							<ul class="nav nav-second-level ">
								@if (Lib::checkMenuAccess('product') || Lib::checkMenuAccess('item'))
								
								@endif								
							</ul>
							<ul class="nav nav-second-level ">
								@if(Lib::checkMenuAccess('packingmatrix'))
								
								@endif								
							</ul>
							<ul class="nav nav-second-level ">
								@if(Lib::checkMenuAccess('invert') || Lib::checkMenuAccess('rejection'))
								<li > 
									<a href="lavascript:void(0)" >Transaction <i class="fa fa-angle-right"></i></a>
									<ul class="nav nav-third-level ">
										
									</ul>
								</li>
								@endif								
							</ul>
						</li> -->
						@endif
						@if (Lib::checkMenuAccess('report'))
						<!--<li >
							<a href="javascript:void(0)" >
								<i class="icon-left glyphicon glyphicon-inbox"></i> Reports <i class="fa fa-angle-right"></i>
							</a>
							<ul class="nav nav-second-level ">
								
							</ul>
						</li> -->
						@endif
						<!--<li>
							<a href="#"><i class="icon-left glyphicon glyphicon-tasks"></i> Costing </a>
						</li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->   
			</nav><!-- /.navbar-static-side -->
		<?php } ?>
		<div id="page-wrapper" class="gray-bg">
		<?php if($currentCA != 'admin_login' && $currentCA != 'admin_forgotpassword') { ?>
			<div class="container-fluid">
			<div class="row border-bottom">
			<nav style="margin-bottom: 0" role="navigation" class="navbar navbar-static-top">
				<div class="top-links">
					<div class="navbar-header">
						<a href="javascript:void(0)" class="navbar-minimalize btn btn-red ">
							<i class="fa fa-bars"></i> 
						</a>						
					</div>
					<div class="welcomeWrapper center-content">
						<span class="m-r-sm text-muted welcome-message">Welcome {{@Sentinel::getUser()->emp_name .' '.@Sentinel::getUser()->last_name }} | Type: {!! Session::get('userRole')!!} | Last Login: {!! Lib::convertDateFormat("Y-m-d H:i:s",@Sentinel::getUser()->last_login,"d-m-Y h:i A")!!}</span></span>
					</div>
					<ul class="nav navbar-top-links setting-links navbar-right">
						<!--<li>
							<span class="m-r-sm text-muted welcome-message">Welcome {{@Sentinel::getUser()->first_name .' '.@Sentinel::getUser()->last_name }}</span>
						</li>-->						
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="javascript::void(0)">
								<i class="fa fa-gear fa-fw"></i> Settings <i class="fa fa-caret-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-user">    
								                   
								<li>
									<a href="{!!URL::to('admin/logout')!!}"><i class="fa fa-sign-out"></i> Log Out</a> 
								</li>
							</ul>
							<!-- /.dropdown-user -->
						</li>
					</ul>
				</div><!-- top links -->
				</nav>
			</div><!-- row header -->
			</div>
			<?php } ?>
			<div id="maincontent"> @yield('content') </div>
			<?php if($currentCA != 'admin_login' && $currentCA != 'admin_forgotpassword') { ?>
			<div class="footer fixed">
				<p>
					<!-- <strong>Copyright</strong> <a href="">Sunpet</a> &copy; 2015  -->
				</p>
			</div><!-- footer -->
			<?php } ?>
		</div>
		<!-- /#page-wrapper -->
	</div>
    <!-- /#wrapper -->
</body>
</html>
