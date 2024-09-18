{{$header}}
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                    	<div class="col-sm-12 col-md-4">
                        	<h3 class="card-title text-danger">Page Not Found</h3>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
            		<div class="row alert alert-danger">
						The page URL "{{if $smarty.server.REQUEST_URI|strstr:notfound}}{{if $smarty.server.HTTP_REFERER}}{{$smarty.server.HTTP_REFERER}}{{else}}{{#server_url#}}{{/if}}{{else}}{{$smarty.server.REQUEST_URI}}{{/if}}" not found at {{#sitename_caps#}}
						<p>
							This page does not exist or the URL is invalid.
							<br />
							Please look for the links on our <a href="{{#server_url#}}">home page</a>. You can also send an email to <a href="mailto:{{#from#}}">{{#from#}}</a>.
						</p>
						<a href="{{if $smarty.server.HTTP_REFERER}}{{$smarty.server.HTTP_REFERER}}{{else}}{{#server_url#}}{{/if}}">Go Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{$footer}}
