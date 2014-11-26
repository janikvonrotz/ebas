// ie10 viewport fix
(function () {
  'use strict';
  if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
      document.createTextNode(
        '@-ms-viewport{width:auto!important}'
      )
    )
    document.querySelector('head').appendChild(msViewportStyle)
  }
})();

// list.js
var header = Array();
$("table tr th").each(function(i, v){
        header[i] = $(this).text();
});
if(header!=""){
  var options = {
    valueNames: header
  };
  var userList = new List('ebas', options);
}

// table sorter
LightTableSorter.init();

// setup hidden dropdowns
var classname="";
var id=0;
$('div.dropdowns select').each(function(){
  // foreach cell where a selection with name equal class name exist
  // replace content with
  classname = $(this).attr('name');
  // remove header from searchindex
  options['valueNames'] = $.grep(options['valueNames'], function(value) {
    return value != classname;
  });
  $('table td.'+classname).each(function(){
    id = $(this).text();
    $(this).text('');
    $('div.dropdowns select[name='+classname+']').clone().appendTo($(this));
    $(this).find('select option[value="'+id+'"]').attr('selected','selected');
  });
});

// insert row to table
var tempIdcounter = -1;
$("button.add-row").click(function(){
  var cells = "";
  var celltext = "";
  // get dropdown code for this table

  $.each(header, function( index, value ) {
    if(index!=0 && (header.length - 1) != index){

      // check if dropdown code is available for field, if yes insert it as data
      // $('div.dropdowns select[name='+value+']').val(0);
      celltext = $('div.dropdowns select[name="'+value+'"]').parent().clone().html();
      if(!celltext){celltext = ""}
      cells += '<td class="'+value+'"><div style="height: "100%"; width: "100%";" contenteditable="'+$('table th:contains("'+value+'")').attr('iscontenteditable')+'">'+celltext+'</div></td>';
    }
  });

  // append generated html code
  $('table').prepend('<tr data-id="'+tempIdcounter+'">'+
  '<td class="'+header[0]+'" contenteditable="false"></td>'+cells+
  '<td><button type="button" class="btn btn-default btn-sm save-row"><i class="fa fa-save"></i></button> '+
  '<button type="button" class="btn btn-danger btn-sm delete-row"><i class="fa fa-trash-o"></i></button>'+
  '</td></tr>');

  // id only once
  tempIdcounter -= 1;
});

// delete row
$("table").on('click', 'button.delete-row', function(e){
  e.preventDefault();
  var id = $(this).closest('tr').data('id');
  $('#myModal').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {

    var id = $('#myModal').data('id');
    if(id > 0){
      $.ajax({
        type: "POST",
        url:'change.php',
        async: false,
        data: {'action':'delete','id':id,'table':document.title},
        success: function(response){
          if(response.status == 'success'){
          }else if(response.status == 'error'){
            alert("Error occured!: "+response.errormessage +"\nPlease refresh the page.");
          }
        }
      });
    }
    $('[data-id=' + id + ']').remove();
    $('#myModal').modal('hide');
    var userList = new List('ebas', options);
});

// save row
$("table").on('click', 'button.save-row', function() {

  var id = $(this).closest('tr').attr('data-id');
  var method = "insert";
  var newid = 0;

  // create json
  var json = {};
  var selectid = 0;
  $(this).closest('tr').each (function(){
    $.each(this.cells, function(i){
        if(header[i]!="Edit"){
          if($(this).find('select').length){
            selectid = $(this).find('select').val();
          }else{
            selectid = $(this).text();
          }
          json[header[i]] = selectid;
        }
    });
  });

  // run update if id is greater than 0
  if(id>0){method="update";}

  $.ajax({
    type: "POST",
    url: "change.php",
    async: false,
    data: {'action':method,'id':id,'table':document.title,'data':json},
    success: function(response){
      if(response.status == 'success'){
        newid=response.ID;
      }else if(response.status == 'error'){
        alert("Error occured!: "+response.errormessage +"\nPlease refresh the page.");
      }
    }
  });

  if(method=='insert'){
    $(this).closest('tr').attr('data-id',newid);
    $(this).closest('tr').find('td:first').text(newid);
  }
  // reindex Listsearch
  var userList = new List('ebas', options);
});

//tasks
//run-Bereinigungslauf
$('button.run-task').click(function(){

  var counter = 0;
  var alerttype = "warning";

  // run task
  $.ajax({
    type: "POST",
    url:'task.php',
    async: false,
    data: {'task':"Bereinigungslauf"},
    success: function(response){
      if(response.status == 'success'){
        counter = response.counter;
      }else if(response.status == 'error'){
        alert("Error occured!: "+response.errormessage +"\nPlease refresh the page.");
      }
    }
  });

  if(counter > 0){
    alerttype="success";
  };

  $('div.alert-'+alerttype+'.Bereinigungslauf').removeClass("hide");
  $('div.alert-'+alerttype+'.Bereinigungslauf').text("Es wurden "+counter+" Datensätze gelöscht.");

});

// refresh
$('button.refresh-page').click(function() {
    location.reload();
});

function exportTableToCSV($table, filename){

  var $rows = $table.find('tr:has(td)'),

  // Temporary delimiter characters unlikely to be typed by keyboard
  // This is to avoid accidentally splitting the actual contents
  tmpColDelim = String.fromCharCode(11), // vertical tab character
  tmpRowDelim = String.fromCharCode(0), // null character

  // actual delimiter characters for CSV format
  colDelim = '","',
  rowDelim = '"\r\n"',

  // Grab text from table into CSV formatted string
  csv = '"' + $rows.map(function (i, row) {
    var $row = $(row),
    $cols = $row.find('td');

    return $cols.map(function (j, col) {
      var $col = $(col),
      text = $col.text();

      return text.replace('"', '""'); // escape double quotes

    }).get().join(tmpColDelim);

  }).get().join(tmpRowDelim)
  .split(tmpRowDelim).join(rowDelim)
  .split(tmpColDelim).join(colDelim) + '"',

  // Data URI
  csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

  $(this)
  .attr({
    'download': filename,
    'href': csvData,
    'target': '_blank'
  });
}

jQuery.fn.table2CSV = function(options) {

  // get function options
  var options = jQuery.extend({
    separator: ',',
    header: [],
    delivery: 'popup' // popup, value
  },
  options);

  var csvData = [];
  var headerArr = [];
  var el = this;

  //header
  var numCols = options.header.length;
  var tmpRow = [];

  // construct header avalible array
  if (numCols > 0) {
    for (var i = 0; i < numCols; i++) {
      tmpRow[tmpRow.length] = formatData(options.header[i]);
    }
  }else{
    $(el).filter(':visible').find('th').each(function() {
      if ($(this).css('display') != 'none') tmpRow[tmpRow.length] = formatData($(this).html());
    });
  }

  // add to row to csv
  row2CSV(tmpRow);

  // actual data
  $(el).find('tr').each(function() {
    var tmpRow = [];
    $(this).filter(':visible').find('td').each(function(){
      // get select id
      if($(this).find('select').length){
        content = $(this).find('select').val();
      }else{
        content = $(this).html();
      }
      if($(this).css('display') != 'none'){
        tmpRow[tmpRow.length] = formatData(content);
      }
    });
    row2CSV(tmpRow);
  });
  if (options.delivery == 'popup') {
    var mydata = csvData.join('\n');
    return popup(mydata);
  }else{
    var mydata = csvData.join('\n');
    return mydata;
  }

  // function to generate csv from different rows
  function row2CSV(tmpRow) {
    var tmp = tmpRow.join('');
    // to remove any blank rows
    if (tmpRow.length > 0 && tmp != '') {
      var mystr = tmpRow.join(options.separator);
      csvData[csvData.length] = mystr;
    }
  }

  // remove invalid characters
  function formatData(input) {
    // replace " with â€œ
    var regexp = new RegExp(/["]/g);
    var output = input.replace(regexp, "â€œ");
    //HTML
    var regexp = new RegExp(/\<[^\<]+\>/g);
    var output = output.replace(regexp, "");
    if (output == "") return '';
    return '"' + output + '"';
  }

  // create a popup with the csv data
  function popup(data) {
    var generator = window.open('', 'csv', 'height=270,width=540');
    generator.document.write('<html><head><title>CSV</title>');
    generator.document.write('</head><body >');
    generator.document.write('<textArea cols=70 rows=15 wrap="off" >');
    generator.document.write(data);
    generator.document.write('</textArea>');
    generator.document.write('</body></html>');
    generator.document.close();
    return true;
  }
}

// csv export
$("button.export-csv").click(function(){
  $('table').table2CSV();
});
