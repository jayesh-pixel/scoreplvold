{{if !$smarty.request.ajax}}
{{$header}}
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{#server_url#}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$meta_data.plural}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
{{if $smarty.request.mode eq 'list'}}
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                    	<div class="col-sm-12 col-md-4">
                        	<h3 class="card-title text-danger">{{$meta_data.plural}}</h3>
                        </div>
                        <div class="col-sm-12 col-md-8 text-right">
                        	{{if $meta_data.add}}
							<a class="icons iadd btn btn-outline-info" {{if !$meta_data.fullpage}}onclick="javascript: return toggleEdit('{{$smarty.request.object_type}}', 0);"{{/if}} href="{{#server_url#}}manager/{{$smarty.request.object_type}}?mode=edit" title="Add New {{$meta_data.singular}}"><i class="fas fa-plus-circle"></i> Add New {{$meta_data.singular}}</a>
							{{/if}}
							{{if $meta_data.search}}
							<a class="icons isearch btn btn-outline-info" id="anchorSearch_{{$smarty.request.object_type}}" href="javascript: toggleSearch('{{$smarty.request.object_type}}');"><i class="fas fa-search"></i>Search {{$meta_data.plural}}</a>
							<a class="btn btn-outline-info" href="{{#server_url#}}manager/{{$smarty.request.object_type}}"><i class="fas fas fa-street-view"></i>View All {{$meta_data.plural}}</a>
							{{/if}}
							{{if $meta_data.actions}}
								{{foreach from=$meta_data.actions key=myId item=i}}
							<a href="{{#server_url#}}manager/{{$smarty.request.object_type}}?action={{$myId}}" class="btn btn-outline-info">{{$i}}</a>
								{{/foreach}}
							{{/if}}
                        </div>
	                </div>
				</div>
			</div>
		</div>
	</div>
{{if $meta_data.search}}
	<div class="row" id="divSearch_{{$smarty.request.object_type}}" style="display: none;">
		<div class="col-12">
			<div class="card">
				<div class="row p-2">
					<div class="col-sm-12 col-md-6">
						<h3 class="card-title text-danger">
						Search {{$meta_data.plural}}
						</h3>
					</div>
					<div class="col-sm-12 col-md-6">
						<a href="javascript: void(0);" class="float-right p-2" onclick="javascript: $('#searchform .advanced').toggleClass('hide');"><i class="fas fa-search"></i> Advanced Search</a>
					</div>
				</div>
                <div class="card-body border-top">
					<div class="row">
						<div class="col-md-6" style="margin:0 auto;">
							<form name="searchform" id="searchform" method="post" onsubmit="javascript:return false;" class="form-horizontal">
								<div class="card-body">
								<input type="hidden" name="search" value="1" />
								{{foreach from=$object_fields key=myId item=i}}
									{{if $i.search}}
									{{assign var="s_field" value="s_{$myId}"}}
									<div class="form-group row {{if $i.search === "advanced"}}hide advanced{{/if}}">
										<label class="col-sm-3 text-right control-label col-form-label">{{$i.displayname}}</label>
										
										<div class="col-sm-9">
	                                        {{if $i.input eq 'date' or $i.input eq 'currency'}}
											{{assign var="s_field" value="s_{$myId}_from"}}
											<input type="text" class="form-control" spellcheck="false" value="{{$smarty.request.$s_field}}" name="s_{{$myId}}_from" id="s_{{$myId}}_from" /> &nbsp;&nbsp; To &nbsp;&nbsp;
											{{assign var="s_field" value="s_{$myId}_to"}}
											<input type="text" class="form-control" spellcheck="false" value="{{$smarty.request.$s_field}}" name="s_{{$myId}}_to" id="s_{{$myId}}_to" />
											{{if $i.input eq 'date'}}
					<script type="text/javascript">
						$(document).ready(function() {
							$("#s_{{$myId}}_from, #s_{{$myId}}_to").css('width', '200px').datepicker({
								format: 'yyyy-mm-dd',
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
											{{/if}}
										{{elseif $i.input eq 'select'}}
											<select name="s_{{$myId}}" id="s_{{$myId}}" class="form-control">
												<option value="">Any</option>
											{{foreach from=$i.options key=ok item=ov name=foo}}
												{{if $ov}}
												<option value="{{if $ok neq $smarty.foreach.foo.index or $i.assoc}}{{$ok}}{{else}}{{$ov}}{{/if}}">{{$ov}}</option>
												{{/if}}
											{{/foreach}}
											</select>
					<script type="text/javascript">selectValue("s_{{$myId}}", "{{$smarty.request.$s_field}}");</script>
										{{elseif $i.input eq 'month'}}
											<select name="s_{{$myId}}" id="s_{{$myId}}" class="form-control">
												<option value="">Any</option>
											{{include file="include/months.tpl"}}
											</select>
					<script type="text/javascript">selectValue("s_{{$myId}}", "{{$smarty.request.$s_field}}");</script>
										{{elseif $i.input eq 'textarea'}}
											<textarea name="s_{{$myId}}" id="s_{{$myId}}" class="form-control">{{$smarty.request.$s_field}}</textarea>
										{{else}}
											<input type="text" class="form-control" spellcheck="false" value="{{$smarty.request.$s_field}}" name="s_{{$myId}}" id="s_{{$myId}}" />
										{{/if}}
	                                    </div>
									</div>
									{{/if}}
								{{/foreach}}
									<div class="form-group row hide advanced">
										<label class="col-sm-3 text-right control-label col-form-label">Order by:</td>
										</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-12 col-md-6">
													<select name="orderby" id="orderby" class="form-control">
													{{foreach from=$object_fields key=myId item=i}}
														{{if $i.sort}}
														<option value="{{$myId}}">{{$i.displayname}}</option>
														{{/if}}
													{{/foreach}}
													</select>
												</div>
												<div class="col-sm-12 col-md-6">
													<select name="order" id="order" class="form-control">
														<option value="asc">Ascending</option>
														<option value="desc">Descending</option>
													</select>
											</div>
											</div>
										</div>
									</div>
								</div>
								<div class="border-top">
									<div class="card-body text-center">
										<button type="submit" class="btn btn-success icons search" name="search"><i class="fas fa-search"></i>Search</button>
										<button type="reset" name="discard" class="btn btn-primary icons reset" onclick="javascript:toggleSearch('{{$smarty.request.object_type}}');">Close</button>
										
										<button type="reset" name="discard" class="btn btn-danger icons reset" onclick="javascript:resetSearchPaging('{{$smarty.request.object_type}}');">Reset</button>
									</div>
								</div>
							</form>
						</div>
                	</div>
				</div>
			</div>
		</div>
	</div>
{{/if}}
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                		<div class="table-responsive">
                    	<div id="msgBox">
					        {{if $status}}
					        <div class="success alert alert-success">{{$meta_data.singular}} has been {{$status}} successfully</div>
					        {{elseif $smarty.session.$session.status}}
					        <div class="success alert alert-success">{{$smarty.session.$session.status}}</div>
					        {{/if}}
					    </div>
					    {{if !$meta_data.fullpage and ($meta_data.add or $meta_data.edit)}}
						<div id="divEdit_{{$smarty.request.object_type}}" class="hide popup_div"></div>
						{{/if}}
						<div id="items_{{$smarty.request.object_type}}">
	{{/if}}
{{else}}
	{{if $status}}
<script type="text/javascript">
showNotification('{{$meta_data.singular}} has been {{$status}} successfully', 'success');
</script>
{{/if}}
{{/if}}
{{if $smarty.request.mode eq 'list'}}
	{{if $meta_data.listing}}
		{{include file=$meta_data.listing}}
	{{else}}
							<table class="table table-striped table-bordered list list_{{$smarty.request.object_type}}" id="tblObjects">
								<thead>
	                                <tr>
									{{foreach from=$object_fields key=myId item=i}}
										{{if $i.list}}
										<th class="{{$smarty.request.object_type}}_{{$myId}}" align="left" index="{{$myId}}">
											{{if $i.sort}}
											<a class="sort" sortindex="{{$myId}}" href="javascript:void(0);" onclick="javascript:sortPaging('{{$smarty.request.object_type}}', '{{$myId}}');">{{$i.displayname}}</a>
											{{else}}
												{{$i.displayname}}
											{{/if}}
										</th>
										{{/if}}
									{{/foreach}}
										<th class="c">Controls</th>
									</tr>
	                            </thead>
	                            <tbody>
	                                {{section name="i" loop=$records}}
									<tr valign="middle" id="{{$smarty.request.object_type}}{{$records[i].id}}" {{if $meta_data.edit}}title="Edit {{$meta_data.singular}}"{{/if}}>
									{{foreach from=$object_fields key=myId item=i}}
										{{if $i.list}}
										<td {{if $i.title}}title="{{$i.title}}"{{/if}}>
											{{$i.prefix}}
											{{if $i.input eq 'image'}}
											<a target="_blank" href="{{#server_url#}}{{$records[i].$myId}}"><img src="{{#server_url#}}{{$records[i].$myId}}" height="40px" /></a>
											{{elseif $i.url}}
												{{if $i.url eq 'self'}}
											<a href="{{#server_url#}}{{$records[i].$myId}}" target="_blank">{{$records[i].$myId}}</a>
												{{else}}
													{{assign var=url value=$i.url}}
											<a href="{{#server_url#}}{{$records[i].$url}}" target="_blank">{{$records[i].$myId}}</a>
												{{/if}}
											{{elseif $i.link}}
											<a href="{{$i.link|replace:'ID':$records[i].id}}">{{$records[i].$myId}}</a>
											{{elseif $i.input eq 'file' and $records[i].$myId}}
											<div class="el-card-item">
												<div class="el-card-avatar el-overlay-1">
													<a class="btn default btn-outline image-popup-vertical-fit el-link" href="{{#server_url#}}{{$records[i].$myId}}">
														<img src="{{#server_url#}}{{$records[i].$myId}}" style="max-width:100px; margin: 0 auto;" />
													</a>
				                                </div>
			                                </div>
											{{elseif $i.input eq 'month'}}
											{{$records[i].$myId|date_format:#format_month#}}
											{{elseif $i.input eq 'date'}}
											{{$records[i].$myId|date_format:#format_date#}}
											{{elseif $i.input eq 'datetime'}}
											{{$records[i].$myId|date_format:#format_datetime#}}
											{{elseif $i.input eq 'checkbox'}}
						    					{{assign var=tmp value=$records[i].$myId}}
						                        {{if $i.options[$tmp]}}{{$i.options[$tmp]}}{{elseif $i.label and $tmp}}{{$i.label}}{{else}}{{/if}}
											{{elseif $myId eq 'userid' and $records[i].userid_id}}
												<a href="{{#server_url#}}manager/customers?id={{$records[i].userid_id}}&mode=details">{{$records[i].$myId}}</a>
											{{elseif $i.input eq 'select'}}
											{{$records[i].$myId}}
											{{else}}
												{{$records[i].$myId}}
											{{/if}}
											{{$i.suffix}}
										</td>
										{{/if}}
									{{/foreach}}
										<td align="center">
											{{assign var="added_by" value=$records[i].added_by|@intval}}
											{{if $meta_data.details}}
											<a class="icons idetails btn btn-outline-info"  data-toggle="modal" href="javascript:void(0);" onclick="javascript: return bpopup('{{#server_url#}}manager/{{$smarty.request.object_type}}?mode=details&id={{$records[i].id}}{{if !$meta_data.fullpage}}&popup=true{{/if}}', '{{$records[i].id}}');" title="{{$meta_data.singular}} Details"><i class="fas fa-info-circle"></i></a>
											{{/if}}
											{{if $meta_data.edit}}
											{{* and ($added_by eq $userid or $smarty.session.$session.usertype eq 'Administrator')*}}
											<a class="icons iedit btn btn-outline-info" {{if !$meta_data.fullpage}}onclick="javascript: return toggleEdit('{{$smarty.request.object_type}}', '{{$records[i].id}}');"{{/if}} href="{{#server_url#}}manager/{{$smarty.request.object_type}}?mode=edit&id={{$records[i].id}}{{if !$meta_data.fullpage}}&popup=true{{/if}}" title="{{$meta_data.singular}} Editor"><i class="fas fa-edit"></i></a>
											{{/if}}
											{{if $meta_data.delete}}
											{{* and ($added_by eq $userid or $smarty.session.$session.usertype eq 'Administrator')*}}
											<a class="icons idelete btn btn-outline-info" href="javascript:void(0);" onclick="javascript: deleteRecord('{{$smarty.request.object_type}}', '{{#server_url#}}manager/{{$smarty.request.object_type}}?mode=delete&id={{$records[i].id}}', '{{$records[i].id}}');" title="Delete {{$meta_data.singular}}"><i class="fas fa-trash"></i></a>
											{{/if}}
											{{if $meta_data.row_actions}}
												{{section name=k loop=$meta_data.row_actions}}
												<a style="{{$meta_data.row_actions[k].style}}" class="btn btn-outline-info" href="{{$meta_data.row_actions[k].link|replace:'ID':$records[i].id}}" title="{{if $meta_data.row_actions[k].title}}{{$meta_data.row_actions[k].title}}{{else}}{{$meta_data.row_actions[k].text}}{{/if}}" target="{{$meta_data.row_actions[k].target}}"><i class="{{$meta_data.row_actions[k].icon}}" ></i>{{$meta_data.row_actions[k].text}}</a>
												{{/section}}
											{{/if}}
										</td>
									</tr>
									{{sectionelse}}
									<tr><td colspan="10" class="fail alert">No {{$meta_data.singular}} found</td></tr>
									{{/section}}
	                        	</tbody>
	                    	</table>
						</div>
	{{if $summary}}
	<script type="text/javascript">
		summaryLimit = parseInt('{{$summaryIfLessThanNOptions}}');
		summary = {{$summary}};
		console.debug(summary);
		renderSummaryRow();
	</script>
	{{/if}}
	{{if !$meta_data.details and !$meta_data.edit and !$meta_data.delete}}
	<style type="text/css">
		table.list_{{$smarty.request.object_type}} th:last-child, table.list_{{$smarty.request.object_type}} td:last-child {
			display:none;
		}
	</style>
	{{/if}}
	{{/if}}
	<script type="text/javascript">
		//bindEditRow('{{$smarty.request.object_type}}', {{if $meta_data.edit}}true{{else}}false{{/if}}, '{{$meta_data.fullpage}}');
	</script>
                	</div>
                </div>
                {{if !$smarty.request.ajax}}
					{{if $smarty.request.mode eq 'list'}}
					<div class="admin row pt-3" id="div_paging_{{$smarty.request.object_type}}"></div>
					{{if $meta_data.suffix}}{{$meta_data.suffix}}{{/if}}
					{{/if}}
				{{/if}}
            </div>
		</div>
	</div>
</div>

{{elseif $smarty.request.mode eq 'details'}}
	{{if $meta_data.viewer}}
		{{include file=$meta_data.viewer}}
	{{else}}
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
										<td>
											{{if $i.input eq 'image'}}
											<a target="_blank" href="{{#server_url#}}{{$object_row.$myId}}"><img src="{{#server_url#}}{{$object_row.$myId}}" height="40px" /></a>
											{{else}}
												{{if $i.input eq 'month'}}
											{{$object_row.$myId|date_format:#format_month#}}
												{{elseif $i.input eq 'date'}}
											{{$object_row.$myId|date_format:#format_date#}}
												{{elseif $i.input eq 'datetime'}}
											{{$object_row.$myId|date_format:#format_datetime#}}
												{{elseif $i.input eq 'file' and $object_row.$myId}}
											<a class="download" target="_blank" href="{{#server_url#}}{{$object_row.$myId}}">{{$object_row.$myId|replace:$i.path:""}}</a>
												{{elseif $i.input eq 'cms' or $i.input eq 'textarea'}}
											{{$object_row.$myId|strip_tags|nl2br}}
												{{else}}
											{{$object_row.$myId}}
												{{/if}}
											{{/if}}
										</td>
									</tr>
									{{/if}}
								{{/foreach}}
								</table>
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
	{{/if}}
{{else}}
	{{assign var=cmsfound value=""}}
	{{if $smarty.request.reload eq 'true'}}
<script type="text/javascript">
	self.parent.pagingReload('{{$smarty.request.object_type}}');
</script>
	{{/if}}
	{{if $meta_data.editor}}
		{{include file=$meta_data.editor}}
	{{else}}
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
							<form class="form-horizontal" name="form" id="frmEdit_{{$smarty.request.object_type}}" action="{{#server_url#}}manager/{{$smarty.request.object_type}}?mode=edit" method="post" enctype="multipart/form-data"{{if !$smarty.request.ajax}} {{/if}}>
								<input type="hidden" name="ajax" value="{{if $smarty.request.ajax}}true{{/if}}" />
								<input type="hidden" name="popup" value="{{if $smarty.request.popup}}true{{/if}}" />
								<input type="hidden" name="id" value="{{$smarty.request.id}}" />
								<input type="hidden" name="ts" value="{{$smarty.now}}" />
								{{if $smarty.request.custom}}<input type="hidden" name="custom" value="{{$smarty.request.custom}}" />{{/if}}
								{{foreach from=$object_fields key=myId item=i}}
									{{assign var="validationArr" value=","|explode:$i.validation}}
									{{assign var="validationClass" value=" "|implode:$validationArr}}
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
												<div class="file-loading">
										    <input id="{{$myId}}" name="{{$myId}}" type="file">
										</div>
										<script>
											var initialPreviewVideo = new Array();
											var initialPreviewConfigVideo = new Array();
											initialPreviewVideo.push("{{#server_url#}}{{$object_row.$myId}}");
											initialPreviewConfigVideo.push({caption: "{{$object_row.$myId|basename}}", size: 329892, width: "120px", key: 1});
										</script> 
                                        <script>
											$(document).ready(function() {
												$("#{{$myId}}").fileinput({
											        theme: 'fas',
											        allowedFileExtensions: ['jpeg', 'jpg', 'png', 'gif', 'webp'],
											        overwriteInitial: true,
											        maxFileSize: 1000,
											        maxFilesNum: 10,
											        showUploadStats: false,
									        		uploadIcon: false,
									        		showUpload: false,
											        //allowedFileTypes: ['image', 'video', 'flash'],
											        slugCallback: function (filename) {
											            return filename.replace('(', '_').replace(']', '_');
											        },
		        									initialPreviewAsData: true,
											        initialPreview: initialPreviewVideo,
											        initialPreviewConfig: initialPreviewConfigVideo,
											    });
											});
										</script>
												{{if !$object_row.$myId}}{{if $i.validation|strstr:'required'}}<div id="{{$myId}}_err">You must upload a file</div>{{/if}}{{/if}}
											{{elseif $i.input eq 'textarea' or $i.input eq 'cms'}}
												<textarea class="form-control {{$validationClass}}" name="{{$myId}}" id="{{$myId}}" validation="{{if $i.validation|strstr:'required'}}required{{/if}}" {{if $i.rows}}rows="{{$i.rows}}"{{/if}} {{if $i.cols}}cols="{{$i.cols}}"{{/if}} {{if $i.title}}title="{{$i.title}}"{{/if}}>{{$object_row.$myId}}</textarea>
												<div class="info" id="{{$myId}}_length"></div>
												{{if $i.input eq 'cms'}}
												<input type="hidden" name="tagged[]" value="{{$myId}}" />
													{{assign var="cmsfound" value="$cmsfound,$myId"}}
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
													<input type="checkbox" class="custom-control-input" name="{{$myId}}[]" id="cb_{{$ok}}" value="{{$ok}}" {{if $ok|in_array:$selected_csv}}checked{{/if}}>
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
												<input type="text" class="form-control {{$validationClass}}" maxlength="{{if $i.maxlength}}{{$i.maxlength}}{{else}}128{{/if}}" spellcheck="false" name="{{$myId}}" id="{{$myId}}" value="{{$object_row.$myId}}" validation="{{if $i.validation|strstr:'required'}}required{{/if}}" {{if $i.title}}title="{{$i.title}}"{{/if}} />
												{{if $i.input eq 'date'}}
					<script type="text/javascript">
						$(document).ready(function(){
							{{if $i.todate and $i.range eq 'future'}}
							$("#{{$myId}}").datepicker({
							  startDate: new Date(),
							  format: 'yyyy-mm-dd',
							}).on('changeDate',function(e){
								var newDate=new Date();
							  newDate.setDate(e.date.getDate()+1);
							  $("#{{$i.todate}}").datepicker('setDate',newDate);
							  $("#{{$i.todate}}").datepicker('setStartDate',e.date);
							});
							{{else}}
							$("#{{$myId}}").css('width', '200px').datepicker({
								format: 'yyyy-mm-dd',
								changeYear: true,
								changeMonth: true,
								{{if $i.range eq 'past'}}
								minDate:'-20Y',
								maxDate:'+0d'
								{{elseif $i.range eq 'future'}}
								startDate: new Date(),
								minDate:'+0d',
								maxDate:'+20Y'
								{{/if}}
							});
							{{/if}}
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
{{if $i.readonly}}
<script type="text/javascript">
	$("#{{$myId}}").attr('readonly', 'readonly');
</script>
{{/if}}
								{{/foreach}}
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
		{{if $cmsfound}}
<script type="text/javascript">
    var cms = '{{$cmsfound}}';
    cms = cms.split(',');
    for(i=0;i<cms.length;i++)
    	if(cms[i])
    		myEditor("#" + cms[i], '724', '350');
</script>
		{{/if}}
	{{/if}}
<script type="text/javascript">
	try {
		$('#frmEdit_{{$smarty.request.object_type}}').validate();
		
		callInputMask();
		if(typeof(init{{$smarty.request.object_type}}Editor) != "undefined")
			setTimeout("init{{$smarty.request.object_type}}Editor();", 0);
	} catch(e) { }
</script>
{{/if}}

<script type="text/javascript">
{{section name=i loop=$maxlength}}
	charLength($e('{{$maxlength[i]}}'));
{{/section}}
</script>
<script type="text/javascript">
	hideListingWhileEditing = true;
	{{if !$meta_data.nopaging and $smarty.request.mode eq 'list'}}
	initPaging('div_paging_{{$smarty.request.object_type}}', '{{$total}}', '{{$pages}}', '{{$page_num}}', '{{#server_url#}}manager/{{$smarty.request.object_type}}{{if $smarty.request.params}}?params={{$smarty.request.params}}{{/if}}', 'items_{{$smarty.request.object_type}}', '{{$meta_data.plural}}', '{{$pagesize}}', ($e('searchform')?'searchform':null), '{{if $smarty.request.orderby}}{{$smarty.request.orderby}}{{else}}{{$meta_data.default_sort_field}}{{/if}}', '{{if $smarty.request.order}}{{$smarty.request.order}}{{else}}{{$meta_data.default_sort_order}}{{/if}}', '{{$smarty.request.object_type}}', 3, false, {{if $smarty.request.ajax}}true{{else}}false{{/if}});
	{{/if}}
</script>
{{if !$smarty.request.ajax}}
	{{if $loadEditor}}
<script type="text/javascript">
	window.onload = function() {
		setTimeout("toggleEdit('{{$smarty.request.object_type}}', '{{$smarty.request.id}}');", 200);
	};
</script>
	{{/if}}
	{{$footer}}
{{/if}}