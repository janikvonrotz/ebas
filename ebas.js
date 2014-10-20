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
$("button.add-row").click(function() {
  var cells = "";
  $.each(header, function( index, value ) {
    if(index!=0 && (header.length - 1) != index)
      cells += '<td class="'+value+'" contenteditable="true"></td>';
  });
  $('table').prepend('<tr data-id="'+Math.floor(Math.random() * 101)+'">'+
  '<td class="'+header[0]+'" contenteditable="false"></td>'+cells+
  '<td><button type="button" class="btn btn-default btn-sm save-row"><span class="glyphicon glyphicon-floppy-disk"></span></button> <button type="button" class="btn btn-default btn-sm delete-row" data-toggle="modal" data-target=".bs-delete-modal-sm"><span class="glyphicon glyphicon-trash"></span></span></button>'+
  '</td></tr>');
});

// delete row
$("table").on('click', 'button.delete-row', function(e){
  e.preventDefault();
  var id = $(this).closest('tr').data('id');
  $('#myModal').data('id', id).modal('show');
});
$('#btnDelteYes').click(function () {
    var id = $('#myModal').data('id');
    // php ajax here
    $('[data-id=' + id + ']').remove();
    $('#myModal').modal('hide');
    var userList = new List('ebas', options);
});

// save row
$("table").on('click', 'button.save-row', function() {
  // php ajax here
  // if successfull update id on row
  if(true){
    $(this).closest('tr').attr('data-id',4);
    $(this).closest('tr').find('td:first').text(4);
  }
  var userList = new List('ebas', options);
});

// refresh
$('button.refresh-page').click(function() {
    location.reload();
});
