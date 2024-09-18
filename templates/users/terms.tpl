{{$header}}
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{#server_url#}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Terms And Conditions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<form method="post" action="{{#server_url#}}inc/users/terms.php" class="form-horizontal" id="frmTerms" name="frmTerms">
	<div class="container-fluid" id="divAppTerms">
		<div class="row">
			<div class="col-12">
				<div class="card">
	                <div class="card-body">
	                	<div class="row">
	                    	<div class="col-12">
	                        	<h3 class="card-title text-danger">Terms And Conditions</h3>
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
	                	<div class="row">
	                		<div class="col-md-8">
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label required">Terms And Conditions</label>
									<div class="col-sm-9">
										<textarea name="app_terms" id="app_terms" class="form-control" style="min-height: 300px;">{{$appTerms.terms}}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label required">&nbsp;</label>
									<div class="col-sm-9">
										<div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="vendor_specific" id="vendor_specific" class="custom-control-input" value="1" {{if $appTerms.vendor_specific gt 0}}checked="checked"{{/if}}>
                                            <label class="custom-control-label" for="vendor_specific">Vendor Specific Terms And Conditions</label>
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="divVendorsTerms">
		<div class="row">
			<div class="col-12">
				<div class="card">
	                <div class="card-body">
	                	<div class="row">
	                    	<div class="col-12">
	                        	<h3 class="card-title text-danger">Vendor's Terms And Conditions</h3>
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
	                	<div class="row">
	                		<div class="col-md-8">
	                			<div class="form-group row {{if !$appTerms.vendor_specific}}hide{{/if}}">
									<label class="col-sm-3 control-label col-form-label required">Select Vendor</label>
									<div class="col-sm-9">
										<select name="vendor" id="vendor" class="form-control">
										<option value="">Select Vendor</option>
										{{section name="v" loop=$vendors}}
											<option value="{{$vendors[v].id}}">{{$vendors[v].name}}</option>
										{{/section}}
										</select>
									</div>
								</div>
								<div class="form-group row {{if $appTerms.vendor_specific}}hide{{/if}}">
									<label class="col-sm-3 control-label col-form-label required">Terms And Conditions</label>
									<div class="col-sm-9">
										<textarea name="vendor_terms" id="vendor_terms" class="form-control" style="min-height: 300px;">{{$vTerms.terms}}</textarea>
									</div>
								</div>
								<div class="border-top">
									<div class="card-body">
										<input type="submit" class="icons save btn btn-primary" value="Update" name="mysubmit">
										<input type="button" class="icons discard btn btn-danger" name="discard" value="Go Back" onclick="javascript:redirect(base);">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	$('#divVendorsTerms select#vendor').bind('change', function(){
		$('#divVendorsTerms textarea#vendor_terms').parents('div.form-group:eq(0)').addClass('hide');
		$('#divVendorsTerms textarea#vendor_terms').val('');
		if($(this).val() > 0)
		{
			$.ajax({
				url: base + 'inc/ajax.php?mode=terms',
				type: 'post',
				data: {id: $(this).val(), ajax: true},
				success: function(response){ 
					$('#divVendorsTerms textarea#vendor_terms').val(response);
					$('#divVendorsTerms textarea#vendor_terms').parents('div.form-group:eq(0)').removeClass('hide');
				}
			});
			
		}
	}).trigger('change');
	
	$('#vendor_specific').bind('change', function(){
		$('#divVendorsTerms select#vendor').parents('div.form-group:eq(0)').addClass('hide');
		$('#divVendorsTerms textarea#vendor_terms').parents('div.form-group:eq(0)').removeClass('hide');
		if($(this).is(':checked'))
		{
			$('#divVendorsTerms textarea#vendor_terms').val('');
			$('#divVendorsTerms select#vendor').parents('div.form-group:eq(0)').removeClass('hide');
			$('#divVendorsTerms textarea#vendor_terms').parents('div.form-group:eq(0)').addClass('hide');
		}
		else{
			$.ajax({
				url: base + 'inc/ajax.php?mode=terms',
				type: 'post',
				data: {id: $(this).val(), vendor_specific: 1, ajax: true},
				success: function(response){ 
					$('#divVendorsTerms textarea#vendor_terms').val(response);
					$('#divVendorsTerms textarea#vendor_terms').parents('div.form-group:eq(0)').removeClass('hide');
				}
			});
		}
	}).trigger('change');;
</script>
{{$footer}}