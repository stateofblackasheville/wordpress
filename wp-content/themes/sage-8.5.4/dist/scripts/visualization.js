jQuery('.soba-visualization').each(function(){
	var title = jQuery(this).attr('data-title');
	var spreadsheetID = jQuery(this).attr('data-spreadsheetid');
	var dataset = jQuery(this).attr('data-dataset');
	var count = jQuery(this).attr('data-count');
	var byDate = jQuery(this).attr('data-bydate');
	var groupBy = jQuery(this).attr('data-groupby');
	var chartType = jQuery(this).attr('data-charttype');
	var showChartTypeSelect = jQuery(this).attr('data-showcharttypeselect');
	var filters = jQuery(this).attr('data-filters');

	console.log('test', title);
	var props = {
		title: title, 
		spreadsheetId: spreadsheetID,
		dataset: dataset,
		count: count,
		byDate: byDate,
		groupBy: groupBy,
		chartType: chartType,
		showChartTypeSelect: showChartTypeSelect,
		filters: filters
	};

	var elm = jQuery(this)[0];

	ReactDOM.render(React.createElement(SobaVisualization, props), elm);
});
//# sourceMappingURL=visualization.js.map
