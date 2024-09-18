{{$header}}
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                    	<div class="col-sm-12 col-md-4">
                        	<h3 class="card-title text-danger">Terms And Conditions</h3>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<style>
		#cleditor_contents div{
			display: block;
			width: 100%;
			position: relative;
		}
	</style>
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
            		<div class="row" id="cleditor_contents">
						{{$settings.terms}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{$footer}}