<?php

use App\Modules\MenuModel; 
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Session;

$routes = Route::current();
$routes = explode("/",$routes->uri);
$routes = $routes[0];

$umainmenu = MenuModel::mainmenu(Auth::user()->id_jabatan);
 
$aktiv =" ";
$aktiv2 =" ";

if($routes  <>"home"){
    
    if($cekmenu = Session::get('menuku')){
        //var_dump($cekmenu);
        foreach($cekmenu  as $cek ){
            $aktiv = $cek->id_main;
            $aktiv2 = $cek->id; 
        }

    } 
}
 
foreach( $umainmenu as $r_menu){ 
     $listmain[][$r_menu->id] = [

            "id" => $r_menu->id,

            "id_main" => $r_menu->id_main,

            "name_menu" => $r_menu->name_menu,

            "link" => $r_menu->link,

            "icon" => $r_menu->icon,

    ]; 

}

$usubmenu = MenuModel::submenu(Auth::user()->id_jabatan);

foreach( $usubmenu as $r_sub){
 
    $listsub[$r_sub->id_main][]= array([

            "id" => $r_sub->id,

            "id_main" => $r_sub->id_main,

            "name_menu" => $r_sub->name_menu,

            "link" => $r_sub->link,

            "icon" => $r_sub->icon,

    ]) ;

}



?>


<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								@if(Auth::user()->photo == "")
								<img class="img-fluid rounded-circle shadow-1 mb-3" src="{{ asset("img/user-12.jpg")}}">
								@else
									<img class="img-fluid rounded-circle shadow-1 mb-3" src="{{ asset('images/listuser/'.Auth::user()->photo) }}" width="80" height="80" alt="">
								@endif
							</div>
							<div class="info">
								<b class="caret pull-right"></b>{{ substr(Auth::user()->name,0,15) }}
								<small>{{ Auth::user()->nik }}</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="{{url('profile')}}"><i class="fa fa-cog"></i> Settings</a></li> 
						</ul>
					</li>
						  
					 
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					 
	
<?php
 
foreach($listmain as $a){
   foreach($a as $r){
                $id_main = $r["id"];
                ?>
                @if( empty($r["link"]) OR $r["link"] == "#") 
                    @if( $aktiv  ==  $id_main )
						<li class="has-sub active">
							<a href="{{ url($r["link"]) }}">
								<b class="caret"></b>
								<i class="fa {{ $r["icon"] }}"></i> 
								<span>{{ ucfirst($r["name_menu"]) }}</span>
							</a> 
                    @else
						<li class="has-sub">
							<a href="{{ url($r["link"]) }}">
								<b class="caret pull-right"></b>
								<i class="fa {{ $r["icon"] }}"></i> 
								<span>{{ ucfirst($r["name_menu"]) }}</span>
							</a>  
                    @endif 
                @else
                    @if( $r["link"] =="home" OR $aktiv2 ==  $id_main )
                        <li class="active">
                            <a href="{{ url($r["link"]) }}">
                                <i class="fa {{  $r["icon"] }}"></i> 
                                <span>{{ ucfirst($r["name_menu"]) }} </span> 
                            </a>
                        </li> 
                    @else
                        <li >
                            <a href="{{ url($r["link"]) }}">
                                <i class="fa {{  $r["icon"] }}"></i> 
                                <span>{{ ucfirst($r["name_menu"]) }} </span> 
                            </a>
                        </li> 
                    @endif 
					
                @endif  
       @if(array_key_exists($id_main, $listsub)) 
                <ul class="sub-menu">
           @foreach($listsub[$id_main] as $x )
               @foreach($x as $r2)
                    @if( $aktiv2  ==  $r2["id"] ) 
                      <li class="active"><a href="{{ url($r2["link"]) }}">{{ ucfirst($r2["name_menu"]) }}</a></li>   
                    @else
                        <li><a href="{{ url($r2["link"]) }}">{{ ucfirst($r2["name_menu"]) }}</a></li> 
                    @endif
               @endforeach
            @endforeach
                </ul> 
            </li>
        @endif 
<?php
   }
}
?>
					<li class="divider has-minify-btn">
                        <!-- begin sidebar minify button -->
                        <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-left"></i></a>
                        <!-- end sidebar minify button -->
					</li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
            <!-- end sidebar scrollbar --> 
            