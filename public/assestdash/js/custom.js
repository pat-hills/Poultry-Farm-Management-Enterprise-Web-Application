$(function () {
    $('.biill-save-btn').on('click', function (e) {
        e.preventDefault();
        var rowCount = $('#bills-table tr').length;
        console.log(rowCount);
        if (rowCount < 4) {
            alert("Please add atleast one item");
        }
        else {
            $('#billsdetailfrm').submit();
        }
    });

    // button to add more item for bills, sales etc
    $('.addSales').on('click', function (e) {
        e.preventDefault();
        var itemRow = $('.new-item').clone().removeAttr("style").removeAttr("class");
        itemRow.find('.bill-item').attr({ name: 'billItem[]', required: 'true' });
        itemRow.find('.quantity').attr({ name: 'quantity[]', required: 'true' });
        itemRow.find('.amount').attr({ name: 'amount[]', required: 'true' });
        itemRow.find('.bill-id').attr('name', 'billId[]');
        $('.sales_row').append(itemRow);
        $('#one-item').css('display', 'none');
        $('.no-records').css('display', 'none');
    });

    // button to add more item for sales
    $('.add-sales-item').on('click', function (e) {
        e.preventDefault();
        var itemRow = $('.new-item').clone().removeAttr("style").removeAttr("class");
        itemRow.find('.bill-item').attr({ name: 'billItem[]', required: 'true' });
        itemRow.find('.quantity').attr({ name: 'quantity[]', required: 'true' });
        itemRow.find('.amount').attr({ name: 'amount[]', required: 'true' });
        itemRow.find('.item-id').attr('name', 'itemId[]');
        $('.sales_row').append(itemRow);
        $('#one-item').css('display', 'none');
        $('.no-records').css('display', 'none');
    });

});


$('#bills-table').on('click', 'tr button.remove', function (e) {
    // e.preventDefault();
    // $(this).parents()[1].remove();
    // var r = confirm("Press a button!");
    // if (r == true) {
    $(this).closest('tr').remove();
    var rowCount = $('#bills-table tr').length;
    console.log(rowCount);
    if (rowCount < 5) {
        $('#one-item').css('display', '');
    }

});

//remove table row from bill item
$('.remove-bill-item').on('click', function () {
    var r = confirm("Are you sure you want to delete item?");
    if (r == true) {
        var url = $(this).data('href');
        var token = $(this).data('token');
        var rowCount = $('#bills-table tr').length;
        console.log(rowCount);
        $(this).closest('tr').remove();
        if (rowCount < 5) {
            $('#one-item').css('display', '');
            console.log(rowCount);
        }
        $.ajax({
            type: "POST",
            url: url,
            data: { _token: token },
            success: function (data) {
                // $(this).parents()[1].remove();
                console.log("success");
                // alert(data); // show response from the php script.
            },
            error: function (data, textStatus, errorThrown) {
                console.log("error");
            },
        });
    }
});

//remove table row from sales 
$('.remove-sales-item').on('click', function () {
    var r = confirm("Are you sure you want to delete item?");
    if (r == true) {
        var url = $(this).data('href');
        var token = $(this).data('token');
        // var rowCount = $('#bills-table tr').length;
        // console.log(rowCount);
        $(this).closest('tr').remove();
        // if (rowCount < 5) {
        //     $('#one-item').css('display', '');
        //     console.log(rowCount);
        // }
        $.ajax({
            type: "POST",
            url: url,
            data: { _token: token },
            success: function (data) {
                // $(this).parents()[1].remove();
                // $(this).closest('tr').remove();
                // console.log("success");
                // alert(data); // show response from the php script.
            },
            error: function (data, textStatus, errorThrown) {
                console.log("error");
                alert(data);
            },
        });
    }
});

$('.delete-sale-item-payment').on('click', function () {
    var r = confirm("Are you sure you want to delete payment?");
    if (r == true) {
        var url = $(this).data('href');
        var token = $(this).data('token');
        $(this).closest('tr').remove();
        $('#norecords').css('display', '');
        $.ajax({
            type: "POST",
            url: url,
            data: { _token: token },
            success: function (data) {
                // $(this).parents()[1].remove();
                console.log("success");
                alert(data); // show response from the php script.
            },
            error: function (data, textStatus, errorThrown) {
                console.log("error");
                console.log(textStatus);
                console.log(data);
                console.log(errorThrown);

            },
        });
    }
});

$('.delete-payment').on('click', function () {
    var r = confirm("Are you sure you want to delete payment?");
    if (r == true) {
        var url = $(this).data('href');
        var token = $(this).data('token');
        $(this).closest('tr').remove();
        $('#norecords').css('display', '');
        $.ajax({
            type: "POST",
            url: url,
            data: { _token: token },
            success: function (data) {
                // $(this).parents()[1].remove();
                console.log("success");
                // alert(data); // show response from the php script.
            },
            error: function (data, textStatus, errorThrown) {
                console.log("error");
                console.log(textStatus);
                console.log(data);
                console.log(errorThrown);
            },
        });
    }
});

//bills table row onclick
$('.edit-bills').on('click', function (e) {
    var url = $(this).data('href');
    window.location.href = url;
});

//make payment, this function sets the url for payment of a bill
// this function also set the amount to pay in the mpayment modal//vendorid
$('.make-payment').on('click', function (e) {
    var url = $(this).data('href');
    $('#paymentForm').attr("action", url);
    $('#vendorid').val($(this).data("vendorid"));
    var amountToPay = $(this).data('amounttopay');
    console.log("amounttopay: " + amountToPay)
    $('.amount-to-pay').attr('value', amountToPay);
});

//delete a bill
$(".delete-bill").click(function () {
    var r = confirm("Are you sure you want to delete bill?");
    if (r == true) {
        var tableRow = 'table#dataTable tr#' + $(this).data("id");
        console.log(tableRow);
        var url = $(this).data("href");
        var token = $(this).data("token");
        toastr.options.showMethod = 'slideDown';
        toastr.options.hideMethod = 'slideUp';
        toastr.options.closeMethod = 'slideUp';
        $.ajax(
            {
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function (data) {
                    $(tableRow).remove();
                    toastr.success('Record deleted successfully');
                },
                error: function (data, textStatus, errorThrown) {
                    toastr.error('An error occured!')
                },
            });
    }
});

//delete a sale
$(".delete-sale").click(function () {
    var r = confirm("Are you sure you want to delete sale?");
    if (r == true) {
        var url = $(this).data("href");
        console.log("url " + url);
        $(this).closest('tr').remove();
        var token = $(this).data("token");
        $.ajax(
            {
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function (data) {
                    console.log("it Work");
                    console.log(data);
                    alert(data);
                    // $(window).on('load', function () {
                    //     $('#deleteModal').modal('show');
                    // });


                },
                error: function (data, textStatus, errorThrown) {
                    console.log("error");
                    console.log(textStatus);
                    console.log(data);
                    console.log(errorThrown);
                },
            });
    }
});


/**********
 * Farm feed recording
 ******* */
$(".edit-feeding").click(function () {
    $('#batchb').val($(this).data("batchb"));
    $('#penhouse').val($(this).data("penhouse"));
    $('#frequency').val($(this).data("frequency"));
    $('#quantity').val($(this).data("quantity"));
    $('#feed').val($(this).data("feed"));
    $('#unit').val($(this).data("unit"));
    $('#date_recorded').val($(this).data("date_recorded"));
    $('#feedRecordForm').attr("action", $(this).data("href"));
});

// $(".delete-feed-record").click(function () {
//           var url = $(this).data("href"); 
//           var id = $(this).data("id"); 
//           var newurl = $('.delete-feed-record-confirm').data('href', url); //setter
//           var newurl = $('.delete-feed-record-confirm').data('id', id); //setter
// });


//delete a feed record
$(".delete-feed-record").click(function () {
    var r = confirm("Are you sure you want to delete feed record?");
    if (r == true) {
        var tableRow = 'table#dataTable tr#' + $(this).data("id");
        var url = $(this).data("href");
        console.log("url " + tableRow);
        var token = $(this).data("token");
        $.ajax(
            {
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function (data) {
                    $(tableRow).remove();
                    toastr.success('Feed record deleted successfully')
                },
                error: function (data, textStatus, errorThrown) {
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'slideUp';
                    toastr.options.closeMethod = 'slideUp';
                    toastr.error('An error occured!')
                },
            });
    }
});



/**********
 * Farm drug recording date_recorded
 ******* */
$(".edit-drug").click(function () {
    $('#penhouse').val($(this).data("penhouse"));
    $('#drugFrequency').val($(this).data("drugfrequency"));
    $('#drugName').val($(this).data("drugname"));
    $('#drugDevice').val($(this).data("drugdevice"));
    $('#quantity').val($(this).data("quantity"));
    $('#weight').val($(this).data("weight"));
    $('#date_recorded').val($(this).data("date_recorded"));
    $('#unit').val($(this).data("unit"));
    $('#editDrugRecordForm').attr("action", $(this).data("href"));
});

// $(".delete-feed-record").click(function () {
//           var url = $(this).data("href"); 
//           var id = $(this).data("id"); 
//           var newurl = $('.delete-feed-record-confirm').data('href', url); //setter
//           var newurl = $('.delete-feed-record-confirm').data('id', id); //setter
// });


//delete a feed record
$(".delete-drug-record").click(function () {
    var r = confirm("Are you sure you want to delete drug record?");
    if (r == true) {
        var tableRow = 'table#dataTable tr#' + $(this).data("id");
        var url = $(this).data("href");
        console.log("url " + tableRow);
        var token = $(this).data("token");
        $.ajax(
            {
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function (data) {
                    $(tableRow).remove();
                    toastr.success('Drug record deleted successfully');
                },
                error: function (data, textStatus, errorThrown) {
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'slideUp';
                    toastr.options.closeMethod = 'slideUp';
                    toastr.error('An error occured!')
                    // console.log("error");
                    // console.log(textStatus);
                    // console.log(data);
                    // console.log(errorThrown);
                },
            });
    }
});

/**********
 * Waste recording
 ******* */
$(".edit-waste").click(function () {
    $('#batchwas').val($(this).data("batchwas"));
    $('#penhouse').val($(this).data("penhouse"));
    $('#weight').val($(this).data("weight"));
    $('#unit').val($(this).data("unit"));
    $('#feed').val($(this).data("feed"));
    $('#notes').val($(this).data("notes"));
    $('#daterecorded').val($(this).data("daterecorded"));
    $('#editWasteRecordForm').attr("action", $(this).data("href"));
});

// $(".delete-feed-record").click(function () {
//           var url = $(this).data("href"); 
//           var id = $(this).data("id"); 
//           var newurl = $('.delete-feed-record-confirm').data('href', url); //setter
//           var newurl = $('.delete-feed-record-confirm').data('id', id); //setter
// });


//delete a feed record
$(".delete-waste-record").click(function () {
    var r = confirm("Are you sure you want to delete drug record?");
    if (r == true) {
        var tableRow = 'table#dataTable tr#' + $(this).data("id");
        var url = $(this).data("href");
        console.log("url " + tableRow);
        var token = $(this).data("token");
        $.ajax(
            {
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function (data) {
                    $(tableRow).remove();
                    toastr.success('Record deleted successfully');
                },
                error: function (data, textStatus, errorThrown) {
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'slideUp';
                    toastr.options.closeMethod = 'slideUp';
                    toastr.error('An error occured!')
                    // console.log("error");
                    // console.log(textStatus);
                    // console.log(data);
                    // console.log(errorThrown);
                },
            });
    }
});


/**********
 * Mortality recording daterecorded
 ******* */


// $(".delete-feed-record").click(function () {
//           var url = $(this).data("href"); 
//           var id = $(this).data("id"); 
//           var newurl = $('.delete-feed-record-confirm').data('href', url); //setter
//           var newurl = $('.delete-feed-record-confirm').data('id', id); //setter
// });



/**********
 * Employee
 ******* */
$(".edit-employee").click(function () {
    $('#firstName').val($(this).data("firstname"));
    $('#lastName').val($(this).data("lastname"));
    $('#primaryContact').val($(this).data("primarycontact"));
    $('#secondaryContact').val($(this).data("secondarycontact"));
    $('#email').val($(this).data("email"));
    $('#residence').val($(this).data("residence"));
    $('#employmentType').val($(this).data("employmenttype"));
    $('#region').val($(this).data("region"));
    $('#salary').val($(this).data("salary"));
    $('#editemployeeForm').attr("action", $(this).data("href"));
});

// $(".delete-feed-record").click(function () {
//           var url = $(this).data("href"); 
//           var id = $(this).data("id"); 
//           var newurl = $('.delete-feed-record-confirm').data('href', url); //setter
//           var newurl = $('.delete-feed-record-confirm').data('id', id); //setter
// });


//delete an employee record
// $(".delete-employee").click(function () {
//     var r = confirm("Are you sure you want to delete employee?");
//     if (r == true) {
//         var tableRow = 'table#emplyoyeeTable tr#' + $(this).data("id");
//         var url = $(this).data("href");
//         console.log("url " + tableRow);
//         var token = $(this).data("token");
//         toastr.options.showMethod = 'slideDown';
//         toastr.options.hideMethod = 'slideUp';
//         toastr.options.closeMethod = 'slideUp';
//         $.ajax(
//             {
//                 url: url,
//                 type: 'DELETE',
//                 data: {
//                     "_token": token,
//                 },
//                 success: function (data) {
//                     var json = JSON.parse(data);
//                     console.log(json["msg"]);
//                     if (json["msg"] == "Success") {
//                         $(tableRow).remove();
//                         // $('#dataTable').DataTable().row('#' + $(this).data("id")).remove().draw();
//                         toastr.success('Drug record deleted successfully');
//                     } else {
//                         toastr.error('An error occured!')
//                     }
//                 },
//                 error: function (data, textStatus, errorThrown) {

//                     toastr.error('An error occured!')
//                     // console.log("error");
//                     console.log(textStatus);
//                     console.log(data);
//                     // console.log(errorThrown);
//                 },
//             });
//     }
// });
/**********
 * penhouse stocking dtstocked
 ******* */
$(".edit-penstocking").click(function () {
    $('#typeOfBird').val($(this).data("typeofbird"));
    $('#numberOfStock').val($(this).data("numberofstock"));
    // $('#penHouse').val($(this).data("penhouse"));
    $('#amount').val($(this).data("amount"));
    $('#batch').val($(this).data("batch"));
    $('#vendor').val($(this).data("vendor"));
    $('#dateIssued').val($(this).data("dateissued"));
    $('#description').val($(this).data("description"));
    $('#dateDue').val($(this).data("date_due"));
    $('#farmitemid').val($(this).data("farmitemid"));
    $('#dtstocked').val($(this).data("dtstocked"));
     $('#editpenstockginForm').attr("action", $(this).data("href"));
});

// $(".delete-feed-record").click(function () {
//           var url = $(this).data("href"); 
//           var id = $(this).data("id"); 
//           var newurl = $('.delete-feed-record-confirm').data('href', url); //setter
//           var newurl = $('.delete-feed-record-confirm').data('id', id); //setter
// });


//delete an employee record
$(".delete-employee").click(function () {
    var r = confirm("Are you sure you want to delete employee?");
    if (r == true) {
        var tableRow = 'table#emplyoyeeTable tr#' + $(this).data("id");
        var url = $(this).data("href");
        console.log("url " + tableRow);
        var token = $(this).data("token");
        toastr.options.showMethod = 'slideDown';
        toastr.options.hideMethod = 'slideUp';
        toastr.options.closeMethod = 'slideUp';
        $.ajax(
            {
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function (data) {
                    var json = JSON.parse(data);
                    console.log(json["msg"]);
                    if (json["msg"] == "Success") {
                        $(tableRow).remove();
                        // $('#dataTable').DataTable().row('#' + $(this).data("id")).remove().draw();
                        toastr.success('Employee record deleted successfully');
                    } else {
                        toastr.error('An error occured!')
                    }
                },
                error: function (data, textStatus, errorThrown) {

                    toastr.error('An error occured!')
                    // console.log("error");
                    console.log(textStatus);
                    console.log(data);
                    // console.log(errorThrown);
                },
            });
    }
});


// var table = $('#example').DataTable();

// // #myInput is a <input type="text"> element
$('#vendor').change(function () {
    console.log(this.value);
    var table = $('#dataTable').DataTable();
    table.search(this.value).draw();
});

// // // #myInput is a <input type="text"> element
// $('#vendor').change(function () {
//     console.log(this.value);
//     var table = $('#dataTable').DataTable();
//     table.search(this.value).draw();
// });

$('#min').keyup(function () {
    var table = $('#example').DataTable();
    table.draw();
});

$('#max').keyup(function () {
    var table = $('#example').DataTable();
    table.draw();
});