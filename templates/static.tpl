{{$header}}
<h1>{{$meta.title}}</h1>
<div class="static-pages" style="margin-top:0px;">
	<div id="home-topbar" style="margin-bottom:30px;margin-top:0px;">
		<div id="homeicon">
			<a href="{{#server_url#}}" style="width:70px;">Homepage</a>
		</div>
		<ul>
			<li><span>{{$meta.title}}</span></li>
		</ul>			
	</div>
	<h2>{{$object.displayname}}</h2>
	<div style="text-align: justify;">{{$object.contents}}</div>
	<div class="cf"></div>
</div>
{{$footer}}