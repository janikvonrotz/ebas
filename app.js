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

// insert row to table
var tempIdcounter = -1;
$("button.add-row").click(function() {
  var cells = "";
  // get dropdown code for this table

  $.each(header, function( index, value ) {
    if(index!=0 && (header.length - 1) != index){

      // check if dropdown code is available for field, if yes insert it as data
      cells += '<td class="'+value+'" contenteditable="'+$('table th:contains("'+value+'")').attr('iscontenteditable')+'"></td>';
    }
  });
  $('table').prepend('<tr data-id="'+tempIdcounter+'">'+
  '<td class="'+header[0]+'" contenteditable="false"></td>'+cells+
  '<td><button type="button" class="btn btn-default btn-sm save-row"><i class="fa fa-save"></i></button> '+
  '<button type="button" class="btn btn-danger btn-sm delete-row"><i class="fa fa-trash-o"></i></button>'+
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
    if(id > 0){
      $.ajax({
        type: "POST",
        url:'change.php',
        data: {'action':'delete','id':id,'table':document.title}
      });
    }
    $('[data-id=' + id + ']').remove();
    $('#myModal').modal('hide');
    var userList = new List('ebas', options);
});

// save row
$("table").on('click', 'button.save-row', function() {

  var id = $(this).closest('tr').attr('data-id');
  var method="insert";
  var newid;

  // create json
  var json = {};
  $(this).closest('tr').each (function(){
    $.each(this.cells, function(i){
        if(header[i]!="Edit"){
          json[header[i]] = $(this).text();
        }
    });
    //json = JSON.stringify(json);
  });

  // run update if id is greater than 0
  if(id>0){method="update";}

  $.ajax({
    type: "POST",
    url: "change.php",
    async: false,
    data: {'action':method,'id':id,'table':document.title,'data':json},
    success: function(response){
        newid=$.parseJSON(response).ID;
    },
    failure: function(response) {
        // alert("fail");
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
        counter = $.parseJSON(response).count;
    },
    failure: function(response) {
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
