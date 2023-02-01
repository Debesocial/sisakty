"use strict";

$("[data-checkboxes]").each(function () {
  var me = $(this),
  group = me.data('checkboxes'),
  role = me.data('checkbox-role');

  me.change(function () {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
    checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
    dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
    total = all.length,
    checked_length = checked.length;

    if (role == 'dad') {
      if (me.is(':checked')) {
        all.prop('checked', true);
      } else {
        all.prop('checked', false);
      }
    } else {
      if (checked_length >= total) {
        dad.prop('checked', true);
      } else {
        dad.prop('checked', false);
      }
    }
  });
});

$("#table-1").dataTable({
  "columnDefs": [
  { "sortable": false, "targets": [2, 3] }
  ]
});
$("#table-2").dataTable({
  "columnDefs": [
  { "sortable": false, "targets": [0, 2, 3] }
  ],
  order: [[1, "asc"]] //column indexes is zero based

});

$('#save-md').DataTable({
  "scrollX": true,
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "asc"]] 
});


$('#save-mdcomp').DataTable({
  "scrollX": true,
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[0, "asc"]] 
});

$('#save-stage1').DataTable({
  "scrollX": true,
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]] 
});

$('#save-stage2').DataTable({
  "scrollX": true,
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]] 
});

$('#save-stage3').DataTable({
  "scrollX": true,
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]] 
});

$('#save-stage4').DataTable({
  "scrollX": true,
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]] 
});


$('#save-stage5').DataTable({
  "scrollX": true,
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]] 
});


$('#save-stage6').DataTable({
  "scrollX": true,
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]] 
});

$('#save-stage-admin').DataTable({
  "scrollX": true,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[0, "desc"],[6, "desc"]] 
});

$('#save-stage-offense').DataTable({
  "scrollX": true,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]]
});

$('#save-stage-accident').DataTable({
  "scrollX": true,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]] 
});

$('#save-stage-spermit').DataTable({
  "scrollX": true,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[1, "desc"]] 
});

$('#tableExport').DataTable({
 select  : true,
 order   : [[1, "desc"]],
 dom     : 'Bfrtip',
 pageLength: 50,
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LEGAL'
}, 'print'], 
"scrollY": "100%",
"sScrollX": "100%",
"scrollCollapse": true
});

$('#datatable_export').DataTable({
 select  : true,
 order   : [[2, "desc"]],
 dom     : 'Bfrtip',
 pageLength: 50,
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LEGAL'
}, 'print'], 
"scrollY": "100%",
"sScrollX": "100%",
"scrollCollapse": true
});

$('#tableExportUser').DataTable({
 select  : true,
 order   : [[1, "asc"]],
 dom     : 'Bfrtip',
 pageLength: 50,
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LEGAL'
}, 'print'], 
"scrollY": "100%",
"sScrollX": "100%",
"scrollCollapse": true
});

$('#tableExport1').DataTable({
 select  : true,
 order   : [[1, "desc"]],
 dom     : 'Bfrtip',
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'portrait',
  pageSize: 'LEGAL'
}, 'print'], 
"scrollY": "650px",
"sScrollX": "100%",
"scrollCollapse": true
});

$('#tableExport2').DataTable({
 select  : true,
 order   : [[1, "desc"]],
 dom     : 'Bfrtip',
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LETTER'
}, 'print']
});

$('#tableExport3').DataTable({
 select  : true,
 order   : [[1, "desc"]],
 dom     : 'Bfrtip',
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LETTER'
}, 'print']
});

$('#tab1').DataTable({
 select  : true,
 order   : [[1, "desc"]],
 dom     : 'Bfrtip',
 pageLength: 12,
 buttons : ['copy', 'excel', 'print']
});

$('#tab2').DataTable({
 select  : true,
 order   : [[1, "desc"]],
 dom     : 'Bfrtip',
 pageLength: 12,
 buttons : ['copy', 'excel', 'print']
});

$('#tableExportdivpel').DataTable({
 select  : true,
 order   : [[13, "desc"]],
 dom     : 'Bfrtip',
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LETTER'
}, 'print']
});

$('#tableExportdivpelsu').DataTable({
 select  : true,
 order   : [[14, "desc"]],
 dom     : 'Bfrtip',
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LETTER'
}, 'print']
});

$('#tableExportdivpelhse').DataTable({
 select  : true,
 order   : [[14, "desc"]],
 dom     : 'Bfrtip',
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LETTER'
}, 'print']
});

$('#tableExportnampel').DataTable({
 select  : true,
 order   : [[6, "desc"]],
 dom     : 'Bfrtip',
 buttons : ['copy', 'excel',{
  extend: 'pdf',
  messageTop: '#HazardReport',
  orientation: 'landscape',
  pageSize: 'LETTER'
}, 'print']
});

$('#bulletin').DataTable({
  "scrollX": true,
  "sScrollX": "100%",
  lengthChange: false,
  pageLength: 50,
  bInfo: false,
  stateSave: true,
  order: [[0, "desc"]] 
});

$('#tablesum1').DataTable({
 select  : true,
 order   : [[1, "desc"]],
 dom     : 'Bfrtip',
 pageLength: 12,
 buttons : ['copy', 'excel', 'print']
});

$('#tablesum2').DataTable({
 select  : true,
 order   : [[1, "desc"]],
 dom     : 'Bfrtip',
 pageLength: 12,
 buttons : ['copy', 'excel', 'print']
});