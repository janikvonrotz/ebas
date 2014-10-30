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
var options = {
  valueNames: header
};
var userList = new List('ebas', options);

// table sorter
LightTableSorter.init();

// insert row to table
var tempIdcounter = -1;
$("button.add-row").click(function() {
  var cells = "";
  // get dropdown code for this table

  $.each(header, function( index, value ) {
    if(index!=0 && (header.length - 1) != index){
      // check if dropdown code is available for field, if yes insert it as data
      cells += '<td class="'+value+'" contenteditable="true"></td>';
    }
  });
  $('table').prepend('<tr data-id="'+tempIdcounter+'">'+
  '<td class="'+header[0]+'" contenteditable="false"></td>'+cells+
  '<td><button type="button" class="btn btn-default btn-sm save-row"><i class="fa fa-save"></i></button> '+
  '<button type="button" class="btn btn-default btn-sm delete-row"><i class="fa fa-trash-o"></i></button>'+
  '</td></tr>');
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
    $.ajax({
      type: "POST",
      url:'change.php',
      data: {'action':'delete','id':id,'table':document.title}
    });

    $('[data-id=' + id + ']').remove();
    $('#myModal').modal('hide');
    var userList = new List('ebas', options);
});

// save row
$("table").on('click', 'button.save-row', function() {

  var id = $(this).closest('tr').data('id');
  var method="insert";
  // create json
  var json = {};
  $(this).closest('tr').each (function(){
    $.each(this.cells, function(i){
        if(header[i]!="Edit"){
          json[header[i]] = $(this).text();
        }
    });
    json = JSON.stringify(json);
  });

  // run update if id is greater than 0
  if(id>0){method="update"}

  $.ajax({
    type: "POST",
    url: "change.php",
    data: {'action':method,'id':id,'table':document.title,'data':json},
    success: function(data){
      // alert("success");
    },
    failure: function(errMsg) {
        // alert("fail");
    }
  });
  // if successfull update id on row
  if(id){
    $(this).closest('tr').attr('data-id',4);
    $(this).closest('tr').find('td:first').text(4);
  }

  // reindex Listsearch
  var userList = new List('ebas', options);
});

// refresh
$('button.refresh-page').click(function() {
    location.reload();
});
