jQuery(function($) {
	var el = $('.anps-table-field-vals');
	/* Add cells */
	$('.anps-table-field-add-cells button').on('click', function() {
		var elRow = el.find('tr');
		var elChild;
		elRow.each(function(index) {
			if( index === 0 ) {
				elChild = $('<th><input type="text" placeholder="' + el.attr('data-heading-placeholder') + '" /></th>');
			} else {
				elChild = $('<td><input type="text" placeholder="' + el.attr('data-cell-placeholder') + '" /></td>');
			}
			elRow.eq(index).append(elChild);
		});
		$('.anps-table-field-remove-cells tr').append('<td><button>×</button></td>');
		changeEvent();
	});
	/* Add rows */
	$('.anps-table-field-add-rows button').on('click', function() {
		var numRows = el.find('tr').eq(0).children().length;
		var elChild = '';
		for(var i=0;i<numRows;i++) {
			elChild += '<td><input type="text" placeholder="' + el.attr('data-cell-placeholder') + '" /></td>';
		}
		elChild = $('<tr>' + elChild + '</tr>');
		el.append(elChild);
		$('.anps-table-field-remove-rows').append('<button>×</button>');
		changeEvent();
	});
	/* Input field change */
	function contentChange() {
		var tableStructure = "";

		/* Table head */
		var tabHead = el.find('tr').eq(0).find('th');

		tableStructure += '[table_head][table_row]';
		tabHead.each(function(index) {
			tableStructure += '[table_heading_cell]';
			tableStructure += tabHead.eq(index).children('input').val();
			tableStructure += '[/table_heading_cell]';
		});	
		tableStructure += '[/table_row][/table_head]';

		/* Table body */

		var tabBody = el.find('tr');

		tableStructure += '[table_body]';
		tabBody.each(function(index) {
			if(index > 0) {
				tableStructure += '[table_row]';

				var tabData = tabBody.eq(index).find('td');

				tabData.each(function(index) {
					tableStructure += '[table_cell]';
					tableStructure += tabData.eq(index).children('input').val();
					tableStructure += '[/table_cell]';
				});
				tableStructure += '[/table_row]';
			}
		});
		tableStructure += '[/table_body]';

		$('#anps_custom_prod').val(tableStructure);
	}
	/* Input change event handler */
	function changeEvent() {
		el.find('input[type="text"]').unbind('keyup');
		el.find('input[type="text"]').keyup(function() {
			contentChange();
		});
		$('.anps-table-field-remove-cells button').unbind('click');
		$('.anps-table-field-remove-cells button').click(function() {
			removeCells($(this));
		});
		$('.anps-table-field-remove-rows button').unbind('click');
		$('.anps-table-field-remove-rows button').click(function() {
			removeRows($(this));
		});
		contentChange();
	}
	changeEvent();
	/* Remove rows */
	$('.anps-table-field-remove-rows button').on('click', function() {
		removeRows($(this));
	});
	function removeRows(temp) {
		if( temp.index() > 0 ) {
			el.find('tr').eq(temp.index()).remove();
			temp.remove();
		}
		contentChange();
	}
	/* Remove cells */
	$('.anps-table-field-remove-cells button').on('click', function() {
		removeCells($(this));
	});
	function removeCells(temp) {
		if( el.find('th').length > 1 ) {
			el.find('tr').each(function(){
				$(this).find('td, th').eq(temp.parent().index()).remove();
			});
			temp.parent().remove();
		}
		contentChange();
	}
});