<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Admin | Dashboard</title>
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{ asset("css/default/app.min.css") }}" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	@yield('styles')
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		<!--page-sidebar-minified begin #header -->

		<div id="header" class="header navbar-default bg-teal">
			@include('admin.partials.header')
		</div>
		<!-- end #header -->

		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			@include('admin.partials.sidebar')
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->

		<!-- begin #content -->
		<div id="content" class="content">
			<!-- end page-header -->

			<!-- begin row -->
			@yield('content')
			<!-- end row -->
		</div>
		<!-- end #content -->
		 <!-- begin scroll to top btn -->
			<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->


	<!-- ================== BEGIN BASE JS ================== -->

	<!-- ================== BEGIN BASE JS ================== -->

	<script src="{{ asset('js/app.min.js')}}"></script>
	<script src="{{ asset('js/theme/default.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
	<!-- ================== END BASE JS ================== -->

	@yield('scripts')
	<script>
	$("form :input").attr("autocomplete", "off");
	</script>

	@if(Auth::user()->id_jabatan == 11 OR Auth::user()->id_jabatan == 1)
	<!--
	<script type="text/javascript">
		$(document).ready(function(){
								setInterval(function()
			   {
				   $.ajax({
					   url: "{{url('ceknotif')}}",
					   cache: false,
					   success: function(msg){
						   $("#notifku").html(msg);
					   }
				   });

			   }, 10000);


	   });

   </script>
-->
   @endif
   <script>
        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            })
            $('textarea').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            })
        });
    </script>
</body>

</html>


