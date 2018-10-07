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
	var datasetLabels = jQuery(this).attr('data-datasetLabels');
	var labelX = jQuery(this).attr('data-labelX');
	var labelY = jQuery(this).attr('data-labelY');

	var spreadsheetChartColumns = jQuery(this).attr('data-spreadsheetChartColumns');
	var summaryText = jQuery(this).attr('data-summaryText');
	if(summaryText){
		summaryText = JSON.parse(summaryText);	
	}
	if(filters){
		filters = JSON.parse(filters);	
	}

	if(datasetLabels){
		datasetLabels = JSON.parse(datasetLabels);	
	}

	if(spreadsheetChartColumns){
		spreadsheetChartColumns = JSON.parse(spreadsheetChartColumns);	
	}

	var props = {
		title: title, 
		spreadsheetId: spreadsheetID,
		dataset: dataset,
		count: count,
		byDate: byDate,
		groupBy: groupBy,
		chartType: chartType,
		showChartTypeSelect: showChartTypeSelect,
		spreadsheetChartColumns: spreadsheetChartColumns,
		filters: filters,
		datasetLabels: datasetLabels,
		labelX: labelX,
		labelY: labelY,
		summaryText: summaryText
	};

	var elm = jQuery(this)[0];

	ReactDOM.render(React.createElement(SobaVisualization, props), elm);
});
//# sourceMappingURL=visualization.js.map
//# sourceMappingURL=visualization.js.map
