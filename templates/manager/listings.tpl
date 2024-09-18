<div class="listing form">
	<h2>Edit Listings</h2>
	<form onsubmit="javascript: return validateForm(this);" enctype="multipart/form-data" method="post" action="{{#server_url#}}manager/listings?mode=edit" id="frmListing" name="frmListing">
		<input type="hidden" value="{{$object_row.id}}" name="id" id="id" />
		<input type="hidden" value="{{$smarty.now}}" name="ts" />
		<input type="hidden" value="0" name="list_default_sort_field_id" id="list_default_sort_field_id" />
		<table class="form new">
			<tbody>
				<tr>
					<td class="label">{{$object_fields.client.displayname}} {{if $object_fields.client.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						<select name="client" id="client" validation="{{$object_fields.client.validation}}" {{if $object_fields.client.title}}title="{{$object_fields.client.title}}"{{/if}} {{if $object_fields.client.edit}}{{else}}disabled{{/if}}>
							<option value="">Choose {{$object_fields.client.displayname}}</option>
						{{foreach from=$object_fields.client.options key=ok item=ov name=foo}}
							<option value="{{if $ok neq $smarty.foreach.foo.index or $object_fields.client.assoc}}{{$ok}}{{else}}{{$ov}}{{/if}}">{{$ov}}</option>
						{{/foreach}}
						</select>
						<script type="text/javascript">selectValue("client", "{{$object_row.client}}");</script>
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.singular.displayname}} {{if $object_fields.singular.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						<input type="text" maxlength="{{if $object_fields.singular.maxlength}}{{$object_fields.singular.maxlength}}{{else}}128{{/if}}" spellcheck="false" name="singular" id="singular" value="{{$object_row.singular}}" validation="{{$object_fields.singular.validation}}" {{if $object_fields.singular.title}}title="{{$object_fields.singular.title}}"{{/if}} />
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.active.displayname}} {{if $object_fields.active.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						<select name="active" id="active" validation="{{$object_fields.active.validation}}" {{if $object_fields.active.title}}title="{{$object_fields.active.title}}"{{/if}} {{if $object_fields.active.edit}}{{else}}disabled{{/if}}>
							<option value="">Choose {{$object_fields.active.displayname}}</option>
						{{foreach from=$object_fields.active.options key=ok item=ov name=foo}}
							<option value="{{if $ok neq $smarty.foreach.foo.index or $object_fields.active.assoc}}{{$ok}}{{else}}{{$ov}}{{/if}}">{{$ov}}</option>
						{{/foreach}}
						</select>
						<script type="text/javascript">selectValue("active", "{{$object_row.active}}");</script>
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.plural.displayname}} {{if $object_fields.plural.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						<input type="text" maxlength="{{if $object_fields.plural.maxlength}}{{$object_fields.plural.maxlength}}{{else}}128{{/if}}" spellcheck="false" name="plural" id="plural" value="{{$object_row.plural}}" validation="{{$object_fields.plural.validation}}" {{if $object_fields.plural.title}}title="{{$object_fields.plural.title}}"{{/if}} />
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.popup.displayname}} {{if $object_fields.popup.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						{{foreach from=$object_fields.popup.options key=ok item=ov}}
						<input type="radio" name="popup" id="rb_popup" value="{{$ok}}" {{if $object_row.popup eq $ok}}checked{{/if}} />
						<label for="rb_{{$ok}}">{{$ov}}</label>
						{{/foreach}}
						{{if $object_fields.popup.help}}
							<div class="info">{{$object_fields.popup.help}}</div>
						{{/if}}
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.image_gallery.displayname}} {{if $object_fields.image_gallery.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						{{foreach from=$object_fields.image_gallery.options key=ok item=ov}}
						<input type="radio" name="image_gallery" id="rb_image_gallery" value="{{$ok}}" {{if $object_row.image_gallery eq $ok}}checked{{/if}} />
						<label for="rb_{{$ok}}">{{$ov}}</label>
						{{/foreach}}
						{{if $object_fields.image_gallery.help}}
							<div class="info">{{$object_fields.image_gallery.help}}</div>
						{{/if}}
					</td>
				</tr>
				<tr>
					<td class="label">Maximum Width X Height</td>
					<td>
						<input type="text" maxlength="{{if $object_fields.max_width.maxlength}}{{$object_fields.max_width.maxlength}}{{else}}128{{/if}}" spellcheck="false" name="max_width" id="max_width" value="{{$object_row.max_width}}" validation="{{$object_fields.max_width.validation}}" {{if $object_fields.max_width.title}}title="{{$object_fields.max_width.title}}"{{/if}} placeholder="{{$object_fields.max_width.displayname}}" />
					X
						<input type="text" maxlength="{{if $object_fields.max_height.maxlength}}{{$object_fields.max_height.maxlength}}{{else}}128{{/if}}" spellcheck="false" name="max_height" id="max_height" value="{{$object_row.max_height}}" validation="{{$object_fields.max_height.validation}}" {{if $object_fields.max_height.title}}title="{{$object_fields.max_height.title}}"{{/if}} placeholder="{{$object_fields.max_height.displayname}}" />
					</td>
				</tr>
				<tr>
					<td class="label">Thumbnail Width X Height</td>
					<td>
						<input type="text" maxlength="{{if $object_fields.thumb_width.maxlength}}{{$object_fields.thumb_width.maxlength}}{{else}}128{{/if}}" spellcheck="false" name="thumb_width" id="thumb_width" value="{{$object_row.thumb_width}}" validation="{{$object_fields.thumb_width.validation}}" {{if $object_fields.thumb_width.title}}title="{{$object_fields.thumb_width.title}}"{{/if}} placeholder="{{$object_fields.thumb_width.displayname}}" />
					X
						<input type="text" maxlength="{{if $object_fields.thumb_height.maxlength}}{{$object_fields.thumb_height.maxlength}}{{else}}128{{/if}}" spellcheck="false" name="thumb_height" id="thumb_height" value="{{$object_row.thumb_height}}" validation="{{$object_fields.thumb_height.validation}}" {{if $object_fields.thumb_height.title}}title="{{$object_fields.thumb_height.title}}"{{/if}} placeholder="{{$object_fields.thumb_height.displayname}}" />
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.dontcrop.displayname}} {{if $object_fields.dontcrop.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						<input type="checkbox" name="dontcrop" id="dontcrop" value="1" {{if $object_row.dontcrop}}checked{{/if}} />
						<label for="dontcrop">{{$object_fields.dontcrop.label}}</label>
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.map.displayname}} {{if $object_fields.map.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						{{foreach from=$object_fields.map.options key=ok item=ov}}
						<input type="radio" name="map" id="rb_map" value="{{$ok}}" {{if $object_row.map eq $ok}}checked{{/if}} />
						<label for="rb_{{$ok}}">{{$ov}}</label>
						{{/foreach}}
						{{if $object_fields.map.help}}
							<div class="info">{{$object_fields.map.help}}</div>
						{{/if}}
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.folder.displayname}} {{if $object_fields.folder.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						{{foreach from=$object_fields.folder.options key=ok item=ov}}
						<input type="radio" name="folder" id="rb_folder" value="{{$ok}}" {{if $object_row.folder eq $ok}}checked{{/if}} />
						<label for="rb_{{$ok}}">{{$ov}}</label>
						{{/foreach}}
						{{if $object_fields.folder.help}}
							<div class="info">{{$object_fields.folder.help}}</div>
						{{/if}}
					</td>
				</tr>
				<tr>
					<td class="label">{{$object_fields.folder_files.displayname}} {{if $object_fields.folder_files.validation|strstr:'required'}}<span class="compulsary">*</span>{{/if}}</td>
					<td>
						{{foreach from=$object_fields.folder_files.options key=ok item=ov}}
						<input type="radio" name="folder_files" id="rb_folder_files" value="{{$ok}}" {{if $object_row.folder_files eq $ok}}checked{{/if}} />
						<label for="rb_{{$ok}}">{{$ov}}</label>
						{{/foreach}}
						{{if $object_fields.folder_files.help}}
							<div class="info">{{$object_fields.folder_files.help}}</div>
						{{/if}}
					</td>
				</tr>
				<tr>
					<td class="label">&nbsp;</td>
					<td>
						<input type="radio" name="url_field" id="url_field_0" value="0" />
						<label for="rb_0">Do Not Use SEO URL</label>
					</td>
				</tr>
				<tr>
					<td class="label">&nbsp;</td>
					<td>
						<input type="radio" name="list_default_sort_field" value="-1" />
						<label for="list_default_sort_field">Default sort by order of entry</label>
					</td>
				</tr>
				<tr class="sort_opt" style="display:{{if $object_row.default_sort_field eq 'id'}}table-row{{else}}none{{/if}};">
					<td class="label">&nbsp;</td>
					<td>
						<select id="list_default_sort_order-1" name="list_default_sort_order[-1]">
							<option value="">Sort Order</option>
							<option value="1">Ascending</option>
							<option value="0">Descending</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="label">&nbsp;</td>
					<td>
						<input type="checkbox" name="hide_menu" id="hide_menu_0" value="1"{{if $object_row.hide_menu}} checked="checked"{{/if}} />
						<label for="hide_menu_0">Hide Menu</label>
					</td>
				</tr>
				<tr>
					<td class="label">&nbsp;</td>
					<td>
						<input type="checkbox" name="all_active" id="all_active_0" value="1"{{if $object_row.all_active}} checked="checked"{{/if}} />
						<label for="all_active_0">All Active</label>
					</td>
				</tr>
				<tr>
					<td class="label">&nbsp;</td>
					<td>
						<input type="checkbox" name="no_folder" id="no_folder_0" value="1"{{if $object_row.no_folder}} checked="checked"{{/if}} />
						<label for="no_folder_0">No Folder</label>
					</td>
				</tr>
				<tr>
					<td class="label">&nbsp;</td>
					<td>
						<input type="checkbox" name="no_seo" id="no_seo_0" value="1"{{if $object_row.no_seo}} checked="checked"{{/if}} />
						<label for="no_seo_0">No SEO</label>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<a class="add" title="Add Listing Field" onclick="javascript: addListingFields();" >&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<div id="listing_fields" class="listing_fields">
							<table class="hide new">
								<tbody>
									<tr>
										<td width="12%" class="label">Display Name</td>
										<td>
											<input type="text" maxlength="128" spellcheck="false" name="list_displayname[0]"  validation="required" title="Displayname" />
											<div class="fr">
												<a href="javascript:void(0)" class="delIcon icons idelete" title="Delete Listing Field" onclick="javascript: deleteListingField(this);" ></a>
												<a href="javascript:void(0)" class="deleted icons" title="Restore Listing Field" onclick="javascript: RestoreListingField(this);" ></a>
											</div>
										</td>
									</tr>
									<tr>
										<td width="12%" class="label">Type</td>
										<td>
											<input type="hidden" name="list_id[0]" value="0"/>
											<select name="list_type[0]">
												<option value="">Input Type</option>
												<option value="text">Text</option>
												<option value="email">Email</option>
												<option value="phone">Phone</option>
												<option value="cms">HTML Editor</option>
												<option map="true" value="longitude">Longitude</option>
												<option map="true" value="latitude">Latitude</option>
												<option map="true" value="address">Google Map Address</option>
												<option value="textarea">Large Text</option>
												<option value="radio">Radio Buttons</option>
												<option value="checkbox">Check Box</option>
												<option value="select">Drop Down List</option>
												<option value="date">Date Input</option>
												<option value="image">Image Upload</option>
												<option value="file">File Upload</option>
												<option value="relation">Relations</option>
											</select>
										</td>
									</tr>
									<tr class="type_dep type_text">
										<td class="label">&nbsp;</td>
										<td width="15%">
											<input type="radio" name="url_field" id="url_field_0" value="0" />
											<label for="url_field_0">Use for SEO URL</label>
										</td>
									</tr>
									<tr>
										<td class="label">&nbsp;</td>
										<td width="15%">
											<input type="checkbox" name="list_required[0]" id="list_required_0" value="1" />
											<label for="list_required_0">Required</label>
											<br clear="both" />
											<div>
											<input type="radio" name="title_field" value="0" />
											<label for="title_field">Use for title (to recognize listing in admin)</label>
											</div>
										</td>
									</tr>
									<tr class="type_dep type_text">
										<td class="label">Prefix</td>
										<td>
											<input type="text" maxlength="128" spellcheck="false" name="list_prefix[0]"  validation="required" title="Prefix" />
										</td>
									</tr>
									<tr class="type_dep type_text">
										<td class="label">Suffix</td>
										<td>
											<input type="text" maxlength="128" spellcheck="false" name="list_suffix[0]"  validation="required" title="Suffix" />
										</td>
									</tr>
									<tr>
										<td class="label">&nbsp;</td>
										<td>
											<input type="radio" name="list_default_sort_field" value="0" />
											<label for="list_default_sort_field">Default Sort</label>
										</td>
									</tr>
									<tr class="sort_opt" style="display:none;">
										<td class="label">&nbsp;</td>
										<td>
											<select name="list_default_sort_order[0]">
												<option value="">Sort Order</option>
												<option value="1">Ascending</option>
												<option value="0">Descending</option>
											</select>
										</td>
									</tr>
									<tr class="type_dep type_select type_radio">
										<td class="label">Options</td>
										<td>
											<textarea name="options[0]" max="512" rows="3" style="width:85%;" placeholder="One entry on each line"></textarea>
										</td>
									</tr>
									<tr class="type_dep type_image">
										<td class="label">Original</td>
										<td>
											<input type="text" size="6" maxlength="4" spellcheck="false" name="list_max_width[0]" validation="required" placeholder="Width" />
											<label>x</label>
											<input type="text" size="6" maxlength="4" spellcheck="false" name="list_max_height[0]"  validation="required" placeholder="Height" />
											<label><input type="checkbox" name="list_crop[0]" value="1" /> Crop</label>
										</td>
									</tr>
									<tr class="type_dep type_image">
										<td class="label">Thumbnail</td>
										<td>
											<input type="text" size="6" maxlength="4" spellcheck="false" name="list_thumb_width[0]"  validation="required" placeholder="Width" />
											<label>x</label>
											<input type="text" size="6" maxlength="4" spellcheck="false" name="list_thumb_height[0]"  validation="required" placeholder="Height" />
											<label style="display:none;"><input type="checkbox" name="list_thumb_crop[0]" value="1" /> Crop</label>
										</td>
									</tr>
									<tr class="type_dep type_relation">
										<td class="label">Table Name</td>
										<td>
											<input type="text" spellcheck="false" name="list_fr_table[0]" validation="required" title="Table Name" />

										</td>
									</tr>
									<tr class="type_dep type_relation">
										<td class="label">Column Name</td>
										<td>
											<input type="text" spellcheck="false" name="list_fr_columns[0]" validation="required" title="Column Name" />

										</td>
									</tr>
									<tr class="type_dep type_relation">
										<td class="label">Relation</td>
										<td>
											<select name="list_fr_multiple[0]">
												<option value="0">One To One Mapping</option>
												<option value="1">One To Multiple Mapping</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="label">&nbsp;</td>
										<td>
											<input type="checkbox" name="list_sortable[0]" value="1" />
											<label for="list_sortable">Sortable</label>
											<br />
											<!--
											<input type="checkbox" name="list_required[0]" value="1" />
											<label for="list_required">Required</label>
											<br />-->
											<input type="checkbox" name="list_searchable[0]" value="1" />
											<label for="list_searchable">Searchable</label>
											<br />

											<input type="checkbox" name="list_listable[0]" value="1" />
                                            <label for="list_listable">Listable</label>
										</td>
									</tr>
									<tr>
										<td class="label">Help</td>
										<td>
											<input type="text" maxlength="128" spellcheck="false" name="list_help[0]"  title="Help" />
										</td>
									</tr>
									<tr class="type_dep type_date">
										<td class="label">Date Range</td>
										<td>
											<select name="list_date_range[0]">
												<option value="">Choose Date Range</option>
												<option value="past">Past</option>
												<option value="future">Future</option>
												<option value="all">All</option>
											</select>
										</td>
									</tr>
									<tr class="type_dep type_file type_image">
										<td class="label">Extensions</td>
										<td>
											<input type="text" maxlength="128" spellcheck="false" name="list_extensions_allowed[0]" />
										</td>
									</tr>
									<tr class="">
										<td class="label">Default Value</td>
										<td>
											<input type="text" spellcheck="false" name="list_default_value[0]" validation="" title="Default Value" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td class="label">&nbsp;</td>
					<td>
						<input type="checkbox" name="force_update" id="force_update" value="1" />
						<label for="force_update">Force update of client database listing meta data</label>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="r">
						<input type="submit" class="btn2" name="mysubmit" value="Submit" />
						&nbsp;
						<input type="button" class="btn1" onclick="javascript:window.location.href='{{#server_url#}}manager/listings';" value="Discard" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<script type="text/javascript">
	var fields = {{$object_row.items|@json_encode}};

	if(fields && fields.length)
	{
		for(i=0;i<fields.length;i++)
			addListingFields(null, fields[i]);
	}
	else
	{
		addListingFields();
		addListingFields();
	}

	$("#frmListing input[type=radio][name*=list_default_sort_field]:eq(0)").bind( "change", changeListingFieldOrdering);
	{{if $object_row.default_sort_field eq 'id'}}
    	$("#frmListing input[type=radio][name*=list_default_sort_field]:eq(0)").attr('checked', true).trigger("change");
    	selectValue('list_default_sort_order-1', '{{if $object_row.default_sort_order eq 'asc'}}1{{else}}0{{/if}}');
	{{/if}}
</script>
