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
var options = {
  valueNames: [ 'Id', 'Beschreibung', 'Ort', 'Datum', 'Typ' ]
};
var userList = new List('ebas', options);

// table sorter
LightTableSorter.init();

// insert row to table
$("button.add-row").click(function() {
  $('table').prepend('<tr data-id="3"><td class="Id" contenteditable="false">3</td> \
                  <td class="Beschreibung" contenteditable="true"></td> \
                  <td class="Ort" contenteditable="true"></td> \
                <td class="Datum" contenteditable="true"></td> \
                  <td class="Typ" contenteditable="true"></td> \
				  <td> \
          <button type="button" class="btn btn-default btn-sm save-row"><span class="glyphicon glyphicon-floppy-disk"></span></button> <button id="3" type="button" class="btn btn-default btn-sm delete-row" data-toggle="modal" data-target=".bs-delete-modal-sm"><span class="glyphicon glyphicon-trash"></span></span></button> \
          </td> \
          </tr>');
});

// delete row
$("table").on('click', 'button.delete-row', function(e){
  e.preventDefault();
  var id = $(this).closest('tr').data('id');
  $('#myModal').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {
    var id = $('#myModal').data('id');
    $('[data-id=' + id + ']').remove();
    $('#myModal').modal('hide');
    var userList = new List('ebas', options);
});

// save row

$("table").on('click', 'button.save-row', function() {
  var userList = new List('ebas', options);
});

// refresh
$('button.refresh-page').click(function() {
    location.reload();
});
