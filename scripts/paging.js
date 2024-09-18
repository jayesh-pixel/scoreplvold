
	var paging = new Array();
	var pagingtypes = new Array();

	var pagingi = 1;
	var paging_items = 0;
	var paging_pages = 1;
	var paging_curpage = 2;
	var paging_url = 3;
	var paging_divc = 4;
	var paging_div = 5;
	var paging_cpage = 6;
	var paging_name = 7;
	var paging_pagesize = 8;
	var paging_orderby = 9;
	var paging_order = 10;
	var paging_searchform = 11;
	var paging_type = 12;
	var paging_displayedPageLinks = 13;
	var paging_append = 14;
	var paging_callback = 15;
	var paging_ts = 0;

	function updateSortables(pi, sortindex)
	{
		if(sortindex)
		{
			if(sortindex == paging[pi][paging_orderby])
			{
				if(paging[pi][paging_order] == 'desc')
					paging[pi][paging_order] = 'asc';
				else
					paging[pi][paging_order] = 'desc';
			}
			else
			{
				paging[pi][paging_orderby] = sortindex;
				paging[pi][paging_order] = 'asc';
			}

			if($e('orderby'))
			{
				selectValue('orderby', paging[pi][paging_orderby]);
				selectValue('order', paging[pi][paging_order]);
			}

			pagingReload(pi);
		}
		else
		{
			$('#' + paging[pi][paging_divc] + ' a.sort').each(function() {
				if($(this).attr('sortindex') == paging[pi][paging_orderby])
				{
					if(paging[pi][paging_order] == 'desc')
						$(this).addClass('sort_desc').removeClass('sort_asc');
					else
						$(this).addClass('sort_asc').removeClass('sort_desc');
				}
				else
					$(this).removeClass('sort_desc').removeClass('sort_asc');
			});
		}
	}

	function populatePageDropDown(pi)
	{
		if($e('curpage'+pi+'_0'))
		{
			if(!paging[pi][paging_curpage])
				paging[pi][paging_curpage] = 0;
			var start = (paging[pi][paging_curpage] - paging[pi][paging_displayedPageLinks]);
			var end = (paging[pi][paging_curpage] + paging[pi][paging_displayedPageLinks]);

			if(start < 0)
			{
				end -= (start - 1);
				start = 0;
			}
			if(end > paging[pi][paging_pages])
			{
				if(start != 0)
				{
					start -= (end - paging[pi][paging_pages]);
					if(start < 0)
						start = 0;
				}
				end = paging[pi][paging_pages];
			}

			var html = getNextLink(pi);;
			for(i=(end-1); i>=start; i--)
			{
				html += '<li class="page-item"><a '+ ((paging[pi][paging_curpage]==i)?'class="page-link current"':'class="page-link"') + ' href="javascript:void(0);" '+ ((paging[pi][paging_curpage]==i)?'':'onclick="javascript:changePage(' + pi + ', true,' + i + ' );"') +' >'  + (i+1) + '</a></li>';
			}
			html += getPrevLink(pi);
			$e('curpage'+pi+'_0').innerHTML = html;

			if($e('curpage'+pi+'_1'))
				$e('curpage'+pi+'_1').innerHTML = $e('curpage'+pi+'_0').innerHTML;
		}

		pagingUpdateCurrentRecords(pi);
	}

	function pagingFirst(pi)
	{
		if(paging[pi][paging_curpage] == 0)
			return;
		paging[pi][paging_curpage] = 0;
		pagingReload(pi);
		populatePageDropDown(pi);
	}

	function pagingPrev(pi)
	{
		if(!parseInt(pi))
			pi = parseInt(pagingtypes[pi]);

		if(paging[pi][paging_curpage] > 0)
		{
			paging[pi][paging_curpage] = parseInt(paging[pi][paging_curpage]) - 1;
			pagingReload(pi);
			populatePageDropDown(pi);
		}
	}

	function pagingNext(pi)
	{
		if(!parseInt(pi))
			pi = parseInt(pagingtypes[pi]);

		if(paging[pi][paging_curpage] < (paging[pi][paging_pages]-1))
		{
			paging[pi][paging_curpage] = parseInt(paging[pi][paging_curpage]) + 1;
			pagingReload(pi);
			populatePageDropDown(pi);
		}
	}

	function pagingLast(pi)
	{
		if(!parseInt(pi))
			pi = parseInt(pagingtypes[pi]);

		var newpage = parseInt(parseInt(paging[pi][paging_pages]) - parseInt(1));
		if(paging[pi][paging_curpage] == newpage)
			return;
		paging[pi][paging_curpage] = newpage;
		pagingReload(pi);
		populatePageDropDown(pi);
	}

	function changePage(pi, force, p)
	{
		if(!p)
			p = $v('txt_curpage' + pi);
		if(p >= 0 && p <= paging[pi][paging_pages] && (p != paging[pi][paging_curpage] || force))
		{
			paging[pi][paging_curpage] = p;
			pagingReload(pi);
			populatePageDropDown(pi);
		}
	}

	function changePageSize(pi)
	{
		var ps = $v('txt_pagesize' + pi);
		var start = (paging[pi][paging_curpage] * paging[pi][paging_pagesize]) + 1;

		var p = parseInt(start / ps);
		paging[pi][paging_pages] = parseInt(paging[pi][paging_items] / ps);
		if((paging[pi][paging_pages] * ps) < paging[pi][paging_items])
			paging[pi][paging_pages]++;

		paging[pi][paging_pagesize] = ps;

		changePage(pi, true);
	}

	function pagingRecordAdded(pi)
	{
		_pagingRecordsChanged(pi, 1);
	}

	function pagingRecordDeleted(pi)
	{
		_pagingRecordsChanged(pi, -1);
	}

	function _pagingRecordsChanged(pi, change)
	{
		if(!parseInt(pi))
			pi = parseInt(pagingtypes[pi]);

		if(!parseInt(pi))
			return;

		paging[pi][paging_items] = parseInt(paging[pi][paging_items]) + parseInt(change);
		var pages = parseInt(parseInt(paging[pi][paging_items]) / parseInt(paging[pi][paging_pagesize]));
		if(pages * paging[pi][paging_pagesize] < paging[pi][paging_items])
			pages++;
		paging[pi][paging_pages] = pages;
		
		pagingReload(pi);
	}

	function pagingUpdateCurrentRecords(pi)
	{
		var start = (paging[pi][paging_curpage] * paging[pi][paging_pagesize]) + 1;
		var end = (paging[pi][paging_curpage] + 1) * paging[pi][paging_pagesize];
		if(end > paging[pi][paging_items])
			end = paging[pi][paging_items];
		if($e('txt_records' + pi))
			$e('txt_records' + pi).innerHTML = 'Showing ' + start + ' to ' + end + ' of ' + parseInt(paging[pi][paging_items]);
		updateDuplicatePagingBar(pi);
	}

	function pagingReload(pi)
	{
		if(!parseInt(pi))
			pi = parseInt(pagingtypes[pi]);

		if(!parseInt(pi))
			return;

		var ts = new Date().getTime();
		if((ts - paging_ts) < 250)
			return;
		else
			paging_ts = ts;

		selectValue('txt_curpage' + pi + '', paging[pi][paging_curpage]);
		selectValue('txt_curpage' + pi + '_1', paging[pi][paging_curpage]);
		if($e('paging_curpage' + pi))
			$e('paging_curpage' + pi).innerHTML = (paging[pi][paging_curpage] + 1);

		pagingUpdateCurrentRecords(pi);

		if($e(paging[pi][paging_searchform]))
		{
			if($e(paging[pi][paging_searchform]).elements['orderby'])
				paging[pi][paging_orderby] = $e(paging[pi][paging_searchform]).elements['orderby'].value;
			if($e(paging[pi][paging_searchform]).elements['order'])
				paging[pi][paging_order] = $e(paging[pi][paging_searchform]).elements['order'].value;
		}

		// ?ajax=true&orderby={{$smarty.request.orderby}}&order={{$smarty.request.order}}&page_num=
		var url = paging[pi][paging_url] + (paging[pi][paging_url].indexOf('?') == -1?'?':'&') + 'ajax=true&orderby=' + paging[pi][paging_orderby] + '&order=' + paging[pi][paging_order] + '&page_num=' + paging[pi][paging_curpage] + '&pagesize=' + paging[pi][paging_pagesize];

		if(!paging[pi][paging_append])
			$('#' + paging[pi][paging_divc]).css('min-height', $('#' + paging[pi][paging_divc]).height() + "px").html('<div class="loading">Loading ...</div>');

		$.ajax({
			type: 'POST',
			global: false,
			url: url,
			data: ($e(paging[pi][paging_searchform])?$('#' + paging[pi][paging_searchform]).serialize():null),
			success: function(data) {
				if(paging[pi][paging_append])
					$('#' + paging[pi][paging_divc]).append(data);
				else
				{
					$('#' + paging[pi][paging_divc]).html(data);
					$('#' + paging[pi][paging_divc]).css('min-height', '0');
				}

				if($('#' + paging[pi][paging_divc]).length && !$('#' + paging[pi][paging_divc]).attr('noscroll'))
				{
					var targetOffset = $('#' + paging[pi][paging_divc]).offset().top;
			        $('html,body').animate({scrollTop: targetOffset - 100}, 1000);
				}

				updateSortables(pi);

				if(typeof(postPaging) != 'undefined')
					postPaging(pi, data);

				if(paging[pi][paging_callback])
					paging[pi][paging_callback]();
			}
		});
	}

	function initPaging(div, items, pages, curpage, url, divc, object_name, pagesize, searchform, orderby, order, type, displayedPageLinks, append, renew, callback)
	{
		if(div && !$e(div))
			return;
		if(renew)
		{
			if(pagingtypes[type])
				pagingi = pagingtypes[type];
			else
				if(paging[pagingi - 1])
					pagingi--;
		}

		paging[pagingi] = new Array();
		paging[pagingi][paging_items] = parseInt(items);
		paging[pagingi][paging_pages] = parseInt(pages);
		paging[pagingi][paging_curpage] = parseInt(curpage);
		paging[pagingi][paging_url] = url;
		paging[pagingi][paging_divc] = divc;
		paging[pagingi][paging_div] = div;
		paging[pagingi][paging_cpage] = 'curpage' + pagingi;
		paging[pagingi][paging_displayedPageLinks] = (displayedPageLinks?displayedPageLinks:1);
		paging[pagingi][paging_append] = (append?true:false);
		paging[pagingi][paging_callback] = (callback?callback:null);

		if($e('paging_pages' + pagingi))
			$e('paging_pages' + pagingi).innerHTML = paging[pagingi][paging_pages];

		if($e('paging_curpage' + pagingi))
			$e('paging_curpage' + pagingi).innerHTML = (paging[pagingi][paging_curpage] + 1);

		if(object_name)
			paging[pagingi][paging_name] = object_name;
		else
			paging[pagingi][paging_name] = 'Records';
		paging[pagingi][paging_pagesize] = parseInt(pagesize);
		paging[pagingi][paging_orderby] = orderby;
		paging[pagingi][paging_order] = order;
		
		var integers = new Array(paging_items, paging_pages, paging_curpage, paging_pagesize);
		for(i=0;i<integers.length;i++)
			if(isNaN(paging[pagingi][integers[i]]))
				paging[pagingi][integers[i]] = 0;

		if(type)
		{
			paging[pagingi][paging_type] = type;
			pagingtypes[type] = pagingi;
		}

		if(searchform)
		{
			paging[pagingi][paging_searchform] = searchform;
			$('#' + searchform + ' [type="submit"]').bind("click", searchPaging).attr('pageindex', pagingi);
			if(orderby && $('#' + searchform + ' select[name="orderby"]').length)
			{
				$('#' + searchform + ' select[name="orderby"] option[value=' + orderby + ']').attr('selected', true);
				$('#' + searchform + ' select[name="order"] option[value=' + order + ']').attr('selected', true);
			}
		}
		$('#' + divc).attr("pageindex", pagingi);

		var x = '';
		if(paging[pagingi][paging_pages] > 0)
		{
			var start = parseInt(paging[pagingi][paging_curpage] * paging[pagingi][paging_pagesize]) + 1;
			var end = parseInt(paging[pagingi][paging_curpage] + 1) * parseInt(paging[pagingi][paging_pagesize]);
			if(end > paging[pagingi][paging_items])
				end = paging[pagingi][paging_items];

			x += '<div class="col-sm-12 col-md-3 pagingc">\
					<div class="dataTables_info paging" id="paging' + pagingi + '" role="status" aria-live="polite"><span class="td_records" id="txt_records' + pagingi + '">Showing ' + start + ' to ' + end + ' of ' + parseInt(paging[pagingi][paging_items]) + '</span></div>\
				</div>\
				<div class="col-sm-12 col-md-2 text-center">\
					<select class="rounded form-control w-50" id="txt_pagesize' + pagingi + '" onchange="javascript:changePageSize(' + pagingi + ');">\
					<option value="10">10</option>\
					<option value="20">20</option>\
					<option value="50">50</option>\
					<option value="100">100</option>\
					<option value="500">500</option>\
					<option value="100000">ALL</option>\
					</select>\
				</div>';
			x += '<div class="col-sm-12 col-md-7 text-right">\
					<div class="dataTables_paginate paging_simple_numbers float-right" id="curpage' + pagingi + '">\
						<ul class="pagination" id="curpage' + pagingi + '_0">\
						</ul>\
					</div>\
				</div>\
			';	
				
	/*		x += '<div class="pagingc 123"><table class="paging" id="paging' + pagingi + '"><tr valign="middle">\
<td class="td_records" id="txt_records' + pagingi + '" align="left">Showing ' + start + ' to ' + end + ' of ' + parseInt(paging[pagingi][paging_items]) + ' ' + paging[pagingi][paging_name] + ' </td><td class="td_pagesize" align="center"><select class="rounded" id="txt_pagesize' + pagingi + '" onchange="javascript:changePageSize(' + pagingi + ');">\
<option value="10">10</option>\
<option value="20">20</option>\
<option value="50">50</option>\
<option value="100">100</option>\
<option value="500">500</option>\
<option value="100000">ALL</option>\
</select> per page</td><td class="td_controls" align="right"> \
<span id="curpage' + pagingi + '"><span id="curpage' + pagingi + '_0" ></span></span><span></span>\
</td></tr></table>\
<div class="cf"></div>\
</div>';
*/
			x += '<form id="frmPaging' + pagingi + '" name="frmPaging"></form>';
			setTimeout('selectValue("txt_pagesize' + pagingi + '", "' + paging[pagingi][paging_pagesize] + '");', 250);
			setTimeout('updateSortables(' + pagingi + ');', 250);
			setTimeout('populatePageDropDown(' + pagingi + ');', 250);
		}
		if(div)
		{
			$e(div).innerHTML = x;
			updateDuplicatePagingBar(pagingi);
		}
		else
			document.write(x);

		$('#paging_' + pagingi).css('display', (paging[pagingi][paging_pages]>1?'':'none'));
			
		return pagingi++;
	}

	function getPrevLink(pi)
	{
		return '<li class="page-item"><a class="page-link prev' + (paging[pi][paging_curpage]>0?'':' hide') + '" href="javascript:void(0);" onclick="javascript:pagingPrev(' + pi + ');">prev</a></li><li class="page-item"><a class="page-link first' + (paging[pi][paging_pages]>0?'':' hide') + '" href="javascript:void(0);" onclick="javascript:pagingFirst(' + pi + ');">first</a></li>';
	}

	function getNextLink(pi)
	{
		return '<li class="page-item"><a class="page-link last' + (paging[pi][paging_pages] > 0?'':' hide') + '" href="javascript:void(0);" onclick="javascript:pagingLast(' + pi + ');">last</a></li><li class="page-item"><a class="page-link next' + (paging[pi][paging_curpage] < (paging[pi][paging_pages]-1)?'':' hide') + '" href="javascript:void(0);" onclick="javascript:pagingNext(' + pi + ');">next</a></li>';
	}

	function searchPaging(pi)
	{
		if(pi && pi.currentTarget)
			pi = $(pi.currentTarget).attr('pageindex');
		if(!pi)
			pi = $(this).attr('pageindex');
		pagingReload(pi);
		return false;
	}

	function sortPaging(pi, sortindex)
	{
		updateSortables(pagingtypes[pi], sortindex);
	}

	function resetSearchPaging(pi)
	{
		if($e(paging[pagingtypes[pi]][paging_searchform]))
			$e(paging[pagingtypes[pi]][paging_searchform]).reset();
		pagingReload(pi);
	}

	function updateDuplicatePagingBar(pi)
	{
		if(paging[pi][paging_div] && $e(paging[pi][paging_div] + 'Dup'))
		{
			$('#' + paging[pi][paging_div] + 'Dup').html('').append($('#' + paging[pi][paging_div] + ' .pagingc').clone()).find('*').attr('id', '');
		}
	}