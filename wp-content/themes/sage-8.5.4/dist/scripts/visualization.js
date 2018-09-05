jQuery('.soba-visualization').each(function(){
	//console.log(jQuery(this));
	var title = jQuery(this).attr('data-title');
	var spreadsheetID = jQuery(this).attr('data-spreadsheetid');
	var dataset = jQuery(this).attr('data-dataset');
	var count = jQuery(this).attr('data-count');
	var byDate = jQuery(this).attr('data-bydate');
	var groupBy = jQuery(this).attr('data-groupby');
	var chartType = jQuery(this).attr('data-charttype');

	console.log('test', title);
	var props = {
		title: title, 
		spreadsheetId: spreadsheetID,
		dataset: dataset,
		count: count,
		byDate: byDate,
		groupBy: groupBy,
		chartType: chartType
	};

	var elm = jQuery(this)[0];

	console.log(elm, props);


	ReactDOM.render(React.createElement(SobaVisualization, props), elm);
});
//# sourceMappingURL=visualization.js.map
