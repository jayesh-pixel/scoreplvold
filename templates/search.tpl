{{$header}}
<h1>{{$meta.title}}</h1>
<div>
	<table>
		<tbody>
		{{foreach from=$results key=j item=i}}
            {{if $i.cnt neq 0}}
			<tr>
				<td>
					<h3><a href="{{#server_url#}}{{$i.url}}">{{$j}} ({{if $i.cnt gt 0}}{{$i.cnt}}{{else}}1{{/if}})</a></h3>
				</td>
			</tr>
            {{/if}}
		{{foreachelse}}
			<tr><td>No record found</td></tr>	
		{{/foreach}}
		</tbody>
	</table>
</div>
{{$footer}}