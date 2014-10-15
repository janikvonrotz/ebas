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

// table sort
$(function() 
    { 
        $("#table1").tablesorter();
    } 
); 

// insert row to table
$("#addrow").click(function() {
  $('#table1').prepend('<tr><td class="Id" contenteditable="false"></td> \
                  <td class="Beschreibung" contenteditable="true"></td> \
                  <td class="Ort" contenteditable="true"></td> \
                  <td class="Datum" contenteditable="true"></td> \
                  <td class="Typ" contenteditable="true"></td> \
				  <td><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></button> <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span></span></button></td> \
                </tr>');
});

// delete row


// save

// refresh