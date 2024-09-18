{{if $meta_data.fullpage}}
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
{{/if}}
					<div class="col-12 border-bottom mb-3">
						<h3 class="card-title text-danger">{{if $object_row.id}}Edit{{else}}Add New{{/if}} {{$meta_data.singular}}</h3>
					</div>
					<div class="col-md-8">
						{{if $meta_data.prefix}}{{$meta_data.prefix}}{{/if}}
						<form class="form-horizontal" name="form" id="frmEdit_{{$smarty.request.object_type}}" action="{{#server_url#}}manager/{{$smarty.request.object_type}}?mode=edit" method="post" enctype="multipart/form-data"{{if !$smarty.request.ajax}} onsubmit="javascript: return validateForm(this);"{{/if}}>
							<input type="hidden" name="ajax" value="{{if $smarty.request.ajax}}true{{/if}}" />
							<input type="hidden" name="popup" value="{{if $smarty.request.popup}}true{{/if}}" />
							<input type="hidden" name="id" value="{{$smarty.request.id}}" />
							<input type="hidden" name="ts" value="{{$smarty.now}}" />
							{{if $smarty.request.custom}}<input type="hidden" name="custom" value="{{$smarty.request.custom}}" />{{/if}}
							{{foreach from=$object_fields key=myId item=i}}
							{{if $smarty.request.object_type eq 'templates' and $myId eq 'tags'}}
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label">Global Tags</label>
									<div class="col-sm-9">site_name, site_tagline, site_url, site_email, site_logo</div>
								</div>
							{{/if}}
							{{if $i.edit}}
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label {{if $i.validation|strstr:'required'}}required{{/if}}">{{$i.displayname}}</label>
									<div class="col-sm-9">
									{{$i.prefix}}
									{{if $i.input eq 'file' or $i.input eq 'image'}}
                                            <input type="file" name="{{$myId}}" id="{{$myId}}" validation="{{if !$object_row.$myId}}{{$i.validation}}{{/if}}" {{if $i.title}}title="{{$i.title}}"{{/if}} value="{{#server_url#}}{{$object_row.$myId}}">
                                        <script>
											$(document).ready(function() {
												$("#{{$myId}}").fileinput({
											        theme: 'fas',
											        allowedFileExtensions: ['mp4', 'wav', 'mp3'],
											        overwriteInitial: true,
											        maxFilesNum: 10,
											        showUploadStats: false,
									        		uploadIcon: false,
									        		showUpload: false,
											        //allowedFileTypes: ['image', 'video', 'flash'],
											        slugCallback: function (filename) {
											            return filename.replace('(', '_').replace(']', '_');
											        },
		        									initialPreviewAsData: true,
											        initialPreview: ('{{$object_row.$myId}}'?["{{#server_url#}}{{$object_row.$myId}}"]:new Array()),
											        initialPreviewConfig: ('{{$object_row.$myId}}'?[{type: "{{if $i.filetype eq 'video'}}video{{else}}image{{/if}}" ,caption: "{{$object_row.$myId|basename}}", filetype: "{{if $i.filetype eq 'video'}}video/mp4{{/if}}", width: "120px", key: 1}]:new Array()),
											    });
											});
										</script>
										{{if !$object_row.$myId}}{{if $i.validation|strstr:'required'}}<div id="{{$myId}}_err">You must upload a file</div>{{/if}}{{/if}}
									{{elseif $i.input eq 'textarea' or $i.input eq 'cms'}}
										<textarea class="form-control" name="{{$myId}}" id="{{$myId}}" validation="{{$i.validation}}" {{if $i.rows}}rows="{{$i.rows}}"{{/if}} {{if $i.cols}}cols="{{$i.cols}}"{{/if}} {{if $i.title}}title="{{$i.title}}"{{/if}}>{{$object_row.$myId}}</textarea>
										<div class="info" id="{{$myId}}_length"></div>
										{{if $i.input eq 'cms'}}
										<input type="hidden" name="tagged[]" value="{{$myId}}" />
											{{assign var="cmsfound" value="{$cmsfound},{$myId}"}}
										{{/if}}
									{{elseif $i.input eq 'checkbox' and $i.type eq 'csv'}}
										{{if $i.resize_array eq 1}}
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="{{$myId}}" id="{{$myId}}" click="javascript:return test1();">
                                            <label class="custom-control-label" for="{{$myId}}"></label>
                                        </div>
										{{/if}}
										{{assign var="selected_csv" value=","|explode:$object_row.$myId}}
										{{foreach from=$i.options key=ok item=ov}}
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="{{$myId}}[]" id="cb_{{$ok}}" value="{{$ok}}" {{if $ok|in_array:$selected_csv}}checked{{/if}} validation="{{$i.validation}}">
                                            <label class="custom-control-label" for="cb_{{$ok}}">{{$ov}}</label>
                                        </div>
										{{foreachelse}}
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="{{$myId}}" id="{{$myId}}" value="1" {{if $object_row.$myId}}checked{{/if}}>
                                            <label class="custom-control-label" for="{{$myId}}">{{$i.label}}</label>
                                        </div>
										{{/foreach}}
									{{elseif $i.input eq 'checkbox'}}
									{{if $i.resize_array eq 1}}
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="{{$myId}}" id="{{$myId}}" click="javascript:return test1();">
                                            <label class="custom-control-label" for="{{$myId}}"></label>
                                        </div>
										{{/if}}
										{{foreach from=$i.options key=ok item=ov}}
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="{{$ok}}" id="cb_{{$ok}}" value="1" {{if $object_row.$ok}}checked{{/if}}>
                                            <label class="custom-control-label" for="cb_{{$ok}}">{{$ov}}</label>
                                        </div>
										{{foreachelse}}
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="{{$myId}}" id="{{$myId}}" value="1" {{if $object_row.$myId}}checked{{/if}}>
                                            <label class="custom-control-label" for="{{$myId}}">{{$i.label}}</label>
                                        </div>
										{{/foreach}}
									{{elseif $i.input eq 'radio'}}
										{{foreach from=$i.options key=ok item=ov}}
										<div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="{{$myId}}" id="rb_{{$ok}}" value="{{$ok}}" {{if $object_row.$myId eq $ok}}checked{{/if}}>
                                            <label class="custom-control-label" for="rb_{{$ok}}">{{$ov}}</label>
                                        </div>
										{{/foreach}}
									{{elseif $i.input eq 'month'}}
										<select name="{{$myId}}" id="{{$myId}}" class="form-control">
											<option value="">Choose {{$i.displayname}}</option>
											{{include file="include/months.tpl"}}
										</select>
										<script type="text/javascript">selectValue("{{$myId}}", "{{$object_row.$myId}}");</script>
									{{elseif $i.input eq 'select'}}
										{{if $i.set_autocomplete eq '1'}}
											<input type="text" class="form-control" spellcheck="false" name="{{$myId}}" id="{{$myId}}" maxlength="128" />
			<script type="text/javascript">
				var object_id=0;
				$("#{{$i.name}}").autocomplete(base + "manager?mode=auto&table={{$i.fr_table}}&field={{$i.fr_field}}",
					{
						minChars:0,
						formatItem: function(row)
						{
							return row[0];
						},
						scroll: false,
				    	scrollHeight: 335,
					}
					)
					.result(function(data, value)
					{
						$('#{{$i.name}}').val(value[0]);
						 object_id = value[1];
				//		_loadFields(value[1]);
					}
					);
			</script>
										{{else}}
											<select class="form-control" name="{{$myId}}" id="{{$myId}}" validation="{{$i.validation}}" {{if $myId eq 'fr_table'}}onclick="javascript:_loadFields(this.value);"{{/if}} {{if $i.title}}title="{{$i.title}}"{{/if}}>
												<option value="">Choose {{$i.displayname}}</option>
											{{foreach from=$i.options key=ok item=ov name=foo}}
												<option value="{{if $ok neq $smarty.foreach.foo.index or $i.assoc}}{{$ok}}{{else}}{{$ov}}{{/if}}">{{$ov}}</option>
											{{/foreach}}
											</select>
											<script type="text/javascript">selectValue("{{$myId}}", "{{$object_row.$myId}}");</script>
										{{/if}}
									{{elseif $i.input eq 'password'}}
										<input type="password" class="form-control" spellcheck="false" name="{{$myId}}" id="{{$myId}}" value="" validation="{{if !$smarty.request.id}}{{$i.validation}}{{/if}}" />
									{{else}}
										<input type="text" class="form-control" maxlength="{{if $i.maxlength}}{{$i.maxlength}}{{else}}128{{/if}}" spellcheck="false" name="{{$myId}}" id="{{$myId}}" value="{{$object_row.$myId}}" validation="{{$i.validation}}" {{if $i.title}}title="{{$i.title}}"{{/if}} />
										{{if $i.input eq 'date'}}
			<script type="text/javascript">
				$(document).ready(function(){
					$("#{{$myId}}").css('width', '100px').datepicker({
						{{if $i.range eq 'past'}}
						minDate:'-20Y',
						maxDate:'+0d'
						{{elseif $i.range eq 'future'}}
						minDate:'+0d',
						maxDate:'+20Y'
						{{/if}}
					});
				});
			</script>
									{{elseif $i.input eq 'time'}}
			<script type="text/javascript">
				$(document).ready(function(){
					$("#{{$myId}}").css('width', '100px').timepicker({
						showSecond: false,
						ampm: false,
						timeFormat:'hh:mm'
					});
				});
			</script>
									{{elseif $i.input eq 'datetime'}}
			<script type="text/javascript">
				$(document).ready(function(){
					$("#{{$myId}}").css('width', '100px').datepicker({
						{{if $i.range eq 'past'}}
						minDate:'-20Y',
						maxDate:'+0d',
						{{elseif $i.range eq 'future'}}
						minDate:'+0d',
						maxDate:'+20Y',
						{{/if}}
						showSecond: false,
						ampm: false,
						timeFormat:'hh:mm'
					});
				});
			</script>
										{{/if}}
									{{/if}}
									{{$i.suffix}}
									{{if $i.help}}<div class="alert-info">{{$i.help}}</div>{{/if}}
									</div>
								</div>
							{{elseif $object_row.$myId}}
								<div class="form-group row">
									<label class="col-sm-3 text-right control-label col-form-label">{{$i.displayname}}</label>
									<div class="col-sm-9">
										{{$object_row.$myId}}
									</div>
									{{if $i.help}}<td>{{$i.help}}</td>{{/if}}
								</div>
							{{/if}}
						{{/foreach}}
							<div class="form-group row">
								<div class="col-sm-12 col-md-6">
									<h3 class="text-danger">Images </h3>
								</div>
							</div>
							<div id="newImgs" class="hide">
								<input type="hidden" name="imgpath[]" value="" />
								{{section name="i" loop=$images}}
								<input type="hidden" name="imgpath[{{$images[i].id}}]" value="{{$images[i].imgpath}}" data-orginal="{{$images[i].imgpath|basename}}" data-init="init-{{$smarty.section.i.index|intval}}" />
								{{/section}}
							</div>
							<div class="form-group row">
								<div class="col-12">
									<div class="file-loading">
									    <input id="input-700" name="imgpath" type="file" multiple>
									</div>
									<script>
										var initialPreviewIMgs = new Array();
										var initialPreviewConfigImgs = new Array();
										{{section name="i" loop=$images}}
										initialPreviewIMgs.push(base + "{{$images[i].imgpath}}");
										initialPreviewConfigImgs.push({caption: "{{$images[i].imgpath|basename}}", size: 329892, width: "120px", key: {{$smarty.section.i.index|intval}}});
										{{/section}}
									</script> 
									<script>
									function appendImages(filename, original){
										var item = $('div#newImgs input:eq(0)').clone();
										item.val(filename);
										item.attr('data-original', original);
										$('div#newImgs').append(item);
									}
									$(document).ready(function() {
										
										$("#input-700").fileinput({
									        theme: 'fas',
									        uploadUrl: base + 'inc/ajax.php?mode=img',
									        allowedFileExtensions: ['jpg', 'png', 'gif'],
									        overwriteInitial: false,
									        maxFileSize: 1000,
									        maxFilesNum: 10,
									        //allowedFileTypes: ['image', 'video', 'flash'],
									        slugCallback: function (filename) {
									            return filename.replace('(', '_').replace(']', '_');
									        },
        									initialPreviewAsData: true,
									        initialPreview: initialPreviewIMgs,
									        initialPreviewConfig: initialPreviewConfigImgs,
									    });
									    
										$('#input-700').on('fileuploaded', function(event, data, previewId, index) {
										    var form = data.form, files = data.files, extra = data.extra, 
										    response = data.response, reader = data.reader;
										    
										    appendImages(response.imgpath, response.original);
										});
										
										$('#input-700').on('fileremoved', function(event, id, index) {
											if($('div#newImgs input[data-original="' + id.replace('thumb-input-700-', "") + '"]').length > 0)
											{
										    	$('div#newImgs input[data-original="' + id.replace('thumb-input-700-', "") + '"]').remove();
										    }
										    else if($('div#newImgs input[data-init="' + index + '"]').length > 0)
											{
										    	$('div#newImgs input[data-init="' + index + '"]').remove();
										    }
										});
										$('#input-700').on('fileclear', function(event) {
										    $('div#newImgs input').not(':first').remove();
										});
									});
									</script>
								</div>
							</div>
							<div class="border-top">
								<div class="card-body">
									<input type="submit" class="icons save btn btn-primary" name="mysubmit" value="Save" />
									<input type="button" class="icons discard btn btn-danger" name="discard" value="Go Back" onclick="javascript:{{if $meta_data.fullpage}}window.location = '{{#server_url#}}manager/{{$smarty.request.object_type}}';{{elseif $smarty.request.ajax}}toggleEdit('{{$smarty.request.object_type}}', 0, true);{{else}}window.parent.Shadowbox.close();{{/if}}" />
								</div>
							</div>
						</form>
						{{if $meta_data.suffix}}{{$meta_data.suffix}}{{/if}}
					</div>
{{if $meta_data.fullpage}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{/if}}