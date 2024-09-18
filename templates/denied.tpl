{{$header}}
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                    	<div class="col-sm-12 col-md-4">
                        	<h3 class="card-title text-danger">Access Denied</h3>
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
						You are not allowed access to the page ({{$smarty.server.REQUEST_URI}}).
						<p>
							You are either logged off or do not have enough access rights to view this page.
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