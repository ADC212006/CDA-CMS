'use strict';

// Advanced Search Functions Starts
// --------------------------------------------------------------------

// Filter column-wise function
function filterColumn(i, val) {
  if (i == 5) {
    var startDate = $('.start_date').val(),
        endDate = $('.end_date').val();
    if (startDate !== '' && endDate !== '') {
      filterByDate(i, startDate, endDate); // Call filter function
    }
    $('.dt-advanced-search').DataTable().draw();
  } else {
    $('.dt-advanced-search').DataTable().column(i).search(val, false, true).draw();
  }
}

// Datepicker for advanced filter
var separator = ' - ',
    rangePickr = $('.flatpickr-range'),
    dateFormat = 'MM/DD/YYYY';
var options = {
  autoUpdateInput: false,
  autoApply: true,
  locale: {
    format: dateFormat,
    separator: separator
  },
  opens: $('html').attr('data-textdirection') === 'rtl' ? 'left' : 'right'
};

if (rangePickr.length) {
  rangePickr.flatpickr({
    mode: 'range',
    dateFormat: 'm/d/Y',
    onClose: function (selectedDates, dateStr, instance) {
      var startDate = '',
          endDate = '';
      if (selectedDates[0] !== undefined) {
        startDate = (selectedDates[0].getMonth() + 1) + '/' + selectedDates[0].getDate() + '/' + selectedDates[0].getFullYear();
        $('.start_date').val(startDate);
      }
      if (selectedDates[1] !== undefined) {
        endDate = (selectedDates[1].getMonth() + 1) + '/' + selectedDates[1].getDate() + '/' + selectedDates[1].getFullYear();
        $('.end_date').val(endDate);
      }
      $(rangePickr).trigger('change').trigger('keyup');
    }
  });
}

// Advance filter function
var filterByDate = function (column, startDate, endDate) {
  $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    var rowDate = normalizeDate(data[column]),
        start = normalizeDate(startDate),
        end = normalizeDate(endDate);

    if (start <= rowDate && rowDate <= end) {
      return true;
    } else if (rowDate >= start && end === '' && start !== '') {
      return true;
    } else if (rowDate <= end && start === '' && end !== '') {
      return true;
    } else {
      return false;
    }
  });
};

var normalizeDate = function (dateString) {
  var date = new Date(dateString);
  var normalized =
    date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
  return normalized;
};
// Advanced Search Functions Ends

$(function () {
  var isRtl = $('html').attr('data-textdirection') === 'rtl';

  var dt_ajax_table = $('.datatables-ajax'),
      dt_filter_table = $('.dt-column-search'),
      dt_adv_filter_table = $('.dt-advanced-search'),
      dt_responsive_table = $('.dt-responsive'),
      assetPath = $('body').attr('data-framework') === 'laravel' ? $('body').attr('data-asset-path') : 'app-assets/';

  // Ajax Sourced Server-side
  // --------------------------------------------------------------------

  if (dt_ajax_table.length) {
    var dt_ajax = dt_ajax_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: assetPath + 'category/fetch', // Change to your Laravel route
      columns: [
        { data: 'id', title: 'ID' },
        { data: 'category_name', title: 'Category Name' },
        { data: 'description', title: 'Description' },
        { data: 'file', title: 'File' },
        { data: 'created_at', title: 'Created At' },
        { data: 'updated_at', title: 'Updated At' }
      ],
      language: {
        paginate: {
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // Column Search
  // --------------------------------------------------------------------

  if (dt_filter_table.length) {
    $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
    $('.dt-column-search thead tr:eq(1) th').each(function (i) {
      var title = $(this).text();
      $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

      $('input', this).on('keyup change', function () {
        if (dt_filter.column(i).search() !== this.value) {
          dt_filter.column(i).search(this.value).draw();
        }
      });
    });

    var dt_filter = dt_filter_table.DataTable({
      ajax: assetPath + 'data/table-datatable.json',
      columns: [
        { data: 'id', title: 'ID' },
        { data: 'category_name', title: 'Category Name' },
        { data: 'description', title: 'Description' },
        { data: 'file', title: 'File' },
        { data: 'created_at', title: 'Created At' },
        { data: 'updated_at', title: 'Updated At' }
      ],
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      orderCellsTop: true,
      language: {
        paginate: {
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // Advanced Search
  // --------------------------------------------------------------------

  if (dt_adv_filter_table.length) {
    var dt_adv_filter = dt_adv_filter_table.DataTable({
      ajax: assetPath + 'data/table-datatable.json',
      columns: [
        { data: 'id', title: 'ID' },
        { data: 'category_name', title: 'Category Name' },
        { data: 'description', title: 'Description' },
        { data: 'file', title: 'File' },
        { data: 'created_at', title: 'Created At' },
        { data: 'updated_at', title: 'Updated At' }
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          targets: 0
        }
      ],
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      orderCellsTop: true,
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['category_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' ? '<tr data-dt-row="' +
                col.rowIndex +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td>' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>' : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      },
      language: {
        paginate: {
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // on key up from input field
  $('input.dt-input').on('keyup', function () {
    filterColumn($(this).attr('data-column'), $(this).val());
  });

  // Responsive Table
  // --------------------------------------------------------------------

  if (dt_responsive_table.length) {
    var dt_responsive = dt_responsive_table.DataTable({
      ajax: assetPath + 'data/table-datatable.json',
      columns: [
        { data: 'id', title: 'ID' },
        { data: 'category_name', title: 'Category Name' },
        { data: 'description', title: 'Description' },
        { data: 'file', title: 'File' },
        { data: 'created_at', title: 'Created At' },
        { data: 'updated_at', title: 'Updated At' }
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          targets: 0
        },
        {
          targets: -1,
          render: function (data, type, full, meta) {
            return '<a href="' + data + '" target="_blank">View File</a>';
          }
        }
      ],
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      orderCellsTop: true,
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['category_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' ? '<tr data-dt-row="' +
                col.rowIndex +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td>' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>' : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      },
      language: {
        paginate: {
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }
});
