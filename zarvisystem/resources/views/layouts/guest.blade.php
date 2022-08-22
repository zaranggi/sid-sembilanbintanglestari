<!DOCTYPE html>
<html lang="en">
 
<head>
	<meta charset="utf-8" />
	<title>SID | Login Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	 <!-- </body></html> -->
</head>
<body class="pace-top">
	<!-- begin #page-loader 
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade show">
		<!-- begin login -->
		<div class="login login-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(img/gallery/3.jpg)"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>SID</b> Admin Page</h4>
					<p>
						Silahkan melakukan login dengan menggunakan Username dan Password yang telah terdaftar.
					</p>
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
				<!-- begin login-header -->
				<div class="login-header">
					<div class="brand">
						<span class="logo"></span> <b>SID</b> Admin Page
						<small>Sistem Informasi Developer</small>
					</div>
					<div class="icon">
						<i class="fa fa-sign-in-alt"></i>
					</div>
				</div>
				<!-- end login-header -->
				<!-- begin login-content -->
				<div class="login-content">
				 <form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
                        {{ csrf_field() }}
						<div class="form-group m-b-15">
							<input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required  autofocus>
 
							@error('username')					
								<span class="invalid-feedback" role="alert">					
									<strong>{{ $message }}</strong>					
								</span>					
							@enderror 
							
						</div>
						<div class="form-group m-b-15">
						 <input id="password" type="password" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
						</div>
						 
						<div class="login-buttons">
							<button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
						</div>
						 
						<hr />
						<p class="text-center text-grey-darker mb-0">
							&copy; All Right Reserved 2020
						</p>
					</form>
				</div>
				<!-- end login-content -->
			</div>
			<!-- end right-container -->
		</div>
		<!-- end login -->

		 
	</div>
	<!-- end page container -->
	
 
</body>
 
</html>
