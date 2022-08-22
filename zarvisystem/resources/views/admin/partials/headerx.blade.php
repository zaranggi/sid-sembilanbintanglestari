<!-- Main navbar -->

<div class="navbar navbar-expand-md navbar-dark  navbar-static" xmlns="http://www.w3.org/1999/html">

		<div class="navbar-brand">
                <a href="home">
				<img width="165px" src="{{ asset('images/indomaret.png') }}" alt=""></a>

		</div>



		<div class="d-md-none" >

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">

				<i class="icon-tree5"></i>

			</button>

			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">

				<i class="icon-paragraph-justify3"></i>

			</button>

		</div>



		<div class="collapse navbar-collapse" id="navbar-mobile">

			<ul class="navbar-nav">

				<li class="nav-item">

					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">

						<i class="icon-paragraph-justify3"></i>

					</a>

				</li>

			</ul>



			<span class="navbar-text ml-md-3">

				<span class="badge badge-mark border-orange-300 mr-2"></span>

				Hallo, {{ Auth::user()->name }}!

			</span>



			<ul class="navbar-nav ml-md-auto">

				<li class="nav-item">
					  <a  class="navbar-nav-link" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                                        
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>

							<i class="icon-switch2 text-warning"></i>
                          <span class="ml-2 text-warning">Logout</span>

	  				</a>

				</li>

			</ul>

		</div>

	</div>

	<!-- /main navbar -->
