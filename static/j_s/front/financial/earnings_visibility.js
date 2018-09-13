/*
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

/*
This javascript file deals with a users earnings page and allows the 
data to be displayed via a filter that works on a yearly basis.

This script degrades gracefully and has been tested on IE 6&7, Firefox, and Safari.

Instructions:
  The page must have a div with an ID of 'filters', the javascript 
  will then add a drop down where the user can select what year they
  want displayed.
*/
  

//logic for adding elements to the DOM
function bindFilter() {
    var fieldset, legend, strongLabel, yearDropdown;
    
    fieldset = new Element('fieldset');
    $('filters').insert(fieldset);
    legend = new Element('legend');
    legend.update('Filter');
    $(fieldset).insert(legend);
    strongLabel = new Element('strong');
    strongLabel.update('Year: ');
    $(fieldset).insert(strongLabel);
    yearDropdown = new Element('select', { 'id': 'year_dropdown'});
    $(fieldset).insert(yearDropdown);

    //determine current year 
    var d = new Date();
    var fullYear = d.getFullYear().toString();

    //add default 'all' value
    var option = new Element('option', { 'value': 'all', 'selected': 'true' });
    option.update('All');
    yearDropdown.insert(option);

    //loop through from 2006 to current year and add option
    for(var i=2006; i <= fullYear; i++) {
        var option = new Element('option', { 'value': i });
        option.update(i);
        yearDropdown.insert(option);
    }

      //add event to drop down box
    yearDropdown.observe('change', function(event) {
        var year = Event.element(event).getValue();
        processVisibility('general_table','sales_table', year);
        processVisibility('general_table','referrals_table', year);
        processVisibility('graph', 'sales_graph', year);
        processVisibility('graph', 'earnings_graph', year);
    });
};

function processVisibility(type, item, year) {  
  //sales and earning table logic
  if (type == "general_table") {      
    var trNumVal = 0; //total value for table

    //initially hide all rows
    hideAllRows(item);

    //if year is not all grab rows by year otherwise grab every row in that table
    //then calculate the value for totals and show row
    if (year != "all") {
      $(item).select('.' + year).each(function(elem){
        trNumVal += getValues(elem);   
        elem.show();
      });
    } else {
      $$('table#' + item + ' tbody tr').each(function(elem){
        trNumVal += getValues(elem); 
        elem.show();
      });
    }
    $(item).select('.earningsTotal').each(function(elem){ //update total
      elem.innerHTML = "$" + addCommas(trNumVal.toFixed(2));
    });
  } 

  //sales and earning graphs logic
  else if (type == "graph") {

    hideAllBars(item); //initially hide all

    //if year is not all grab bars by year otherwise grab every bar and display
    if (year != 'all') {
      $(item).select('.' + year).each(function(elem){
        elem.show();
      });
    } else {
     $(item).select('div').each(function(elem){
        elem.show();
      });
    }
  }
};


//hide all bars in graph
function hideAllBars(graph) {
  $$('div#' + graph + ' div.bar').each(function(elem) {
    elem.hide();        
  });
}

//hide all rows in tables
function hideAllRows(table) {
  $$('table#' + table + ' tbody tr').each(function(elem){
    elem.hide();
  });
};

//get value from the row and return the value as float
function getValues(elem) {
  var trVal = elem.select('.earningsVal')[0].innerHTML;  
  trVal = trVal.substr(1, trVal.length).replace(/\,/g,''); //remove commas if value is greater than a thousand
  var newtrVal = trVal.replace(/\,/g,'');

  return parseFloat(newtrVal);  
}

//http://www.mredkj.com/javascript/nfbasic.html
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
