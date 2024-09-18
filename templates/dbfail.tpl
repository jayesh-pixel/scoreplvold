{{$header}}
<h1>{{$meta.title}}</h1>
<h2>Critical Error</h2>
<div class="fail">
	There was an error processing your request {{$smarty.server.REQUEST_URI}} at {{#sitename_caps#}}
	<p>
		Please look for the links and menu on our <a href="{{#server_url#}}">home page</a>.
		<br />
		You can also send an email to <a href="mailto:{{#from#}}">{{#from#}}</a>.
	</p>
	<a href="{{if $smarty.server.HTTP_REFERER}}{{$smarty.server.HTTP_REFERER}}{{else}}{{#server_url#}}{{/if}}">Go Back</a>
</div>
{{$footer}}