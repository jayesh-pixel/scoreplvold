{{$header}}
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="text-danger">Terms And Conditions</h3>
					<div class="card-body">
						<div class="alert alert-info">
						{{$pageContent.terms|@nl2br}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{$footer}}