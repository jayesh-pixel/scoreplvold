<style>
	.carousel-inner > .item > img, .carousel-inner > .item > a > img {
		width: 70%;
		margin: auto;
	}
</style>
<div class="modal-header">
	<h3 class="text-danger modal-title">{{$meta_data.singular}} Details</h3>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true ">&times;</span>
	</button>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="table-responsive">
							<table class="table table-striped table-bordered list">
								{{if !in_array('id', array_keys($object_fields))}}
								<tr>
									<td>ID</td>
									<td>{{$object_row.id}}</td>
								</tr>
								{{/if}}
								{{foreach from=$object_fields key=myId item=i}}
								{{if $i.details and ($i.displayname or $object_row.$myId)}}
								<tr>
									<td>{{$i.displayname}}</td>
									<td> {{if $i.input eq 'image'}} <a target="_blank" href="{{#server_url#}}{{$object_row.$myId}}"><img src="{{#server_url#}}{{$object_row.$myId}}" height="40px" /></a> {{else}}
									{{if $i.input eq 'month'}}
									{{$object_row.$myId|date_format:#format_month#}}
									{{elseif $i.input eq 'date'}}
									{{$object_row.$myId|date_format:#format_date#}}
									{{elseif $i.input eq 'datetime'}}
									{{$object_row.$myId|date_format:#format_datetime#}}
									{{elseif $i.input eq 'file' and $object_row.$myId}} <a class="download" target="_blank" href="{{#server_url#}}{{$object_row.$myId}}">{{$object_row.$myId|replace:$i.path:""}}</a> {{elseif $i.input eq 'cms' or $i.input eq 'textarea'}}
									{{$object_row.$myId|strip_tags|nl2br}}
									{{else}}
									{{$object_row.$myId}}
									{{/if}}
									{{/if}} </td>
								</tr>
								{{/if}}
								{{/foreach}}
							</table>
							{{if $videos|@count}}
							<div class="col-lg-12 p-0 m-0">
								<div class="row">
									<div class="col-sm-12 col-md-4">
										<h3 class="card-title text-danger">Video</h3>
									</div>
									<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
										 <div class="carousel-inner">
											{{section name="v" loop=$videos}}
											<div class="carousel-item {{if $smarty.section.v.index lte 0}}active{{/if}}">
												<img class="d-block w-100" src="{{#server_url#}}{{$videos[v].imgpath}}">
											</div>
											{{/section}}
										</div>
										<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
										<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
									</div>
								</div>
							</div>
							{{elseif $images|@count}}
							<div class="col-lg-12 p-0 m-0">
								<div class="row">
									<div class="col-sm-12 col-md-4">
										<h3 class="card-title text-danger">Images</h3>
									</div>
									<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
										 <div class="carousel-inner">
											{{section name="b" loop=$images}}
											<div class="carousel-item {{if $smarty.section.b.index lte 0}}active{{/if}}">
												<img class="d-block w-100" src="{{#server_url#}}{{$images[b].imgpath}}">
											</div>
											{{/section}}
										</div>
										<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
										<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
									</div>
								</div>
							</div>
							{{/if}}
							<div class="border-top">
								<div class="card-body text-right">
									<input type="button" class="icons discard btn btn-danger" name="discard" value="Close" data-dismiss="modal" aria-label="Close" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{$object_row._details}}
</div>
<script type="text/javascript">
//$("#homeBanner").carousel();
</script>