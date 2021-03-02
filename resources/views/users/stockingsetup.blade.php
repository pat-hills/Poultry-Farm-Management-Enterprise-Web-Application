@extends('users/layouts.stockingsetup-master')
@section('stocking')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <ul class="progressbar">
                        <li class="active1">Create Account</li>
                        <li class="active2">Setup Farm</li>
                        <li class="active3">Setup Penhouse</li>
                        <li class="active4">Setup Stock</li>
                        <li class="active5">Completed</li>
                    </ul>
                </div>


                <div id="smartwizard" class="pt-3">
                    <div>
                        <div class="wz-content-wrapper mt-5 mb-5">
                            @if(Session::has('message'))
                            <p class="alert {{Session::get('alert-class','alert-info')}}">
                                {{Session::get('message')}}
                            </p>
                            @endif

                            <div class="text-center">
                                <h1>Let's add your stock!</h1>
                               
                                
                                <p>
                                    <h5>
                                            Click on the "Add New Stock" button to stock your pen. </br>
                                            Stocking automatically prepare your bills from vendors.</br>

                                     
                                            Thank you.

                                    </h5>
                       </p>

                        <p>
                                <h5>
                                    Afterwards click on the "Next" button to proceed.
                                </h5>
                   </p>


                                <img class="mt-2 d-block mx-auto" src="{{ URL::to('vendor/poultry-farm.jpg') }}" alt="Poultry Farm" height="100" width="auto">

                                <button type="button" class="btn btn-primary btn-sm mt-3 add-new-stock" data-token="{{csrf_token()}}" data-href="{{route('onboarding.stocking')}}"
                                data-toggle="modal" data-target="#addStock">Add New Stock</button>                               
                               
{{--                                
                                @empty(!count($penHouseStocking))
                                <button type="button" class="btn btn-primary btn-sm mt-3" data-toggle="modal" data-target="#addToExistingStock">Add To Existing Stock</button> 
                                 @endempty --}}



                            </div>

                                <div class="table-responsive">
                                    <table id="onboardingDataTable" class="table table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                    <th>Date Stocked</th>
                                                <th>Pen Number</th>
                                                <th>Bird Type </th>
                                                <th>Quantity of stock</th>
                                                {{-- <th>Quantity of price</th>
                                                <th>Total Amount</th> --}}
                                                {{-- <th>Action</th>  --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @empty(count($penHouseStocking))
                                            <tr>
                                                <td> No Records </td>
                                            </tr>
                                            @endempty 
                                            @foreach ($penHouseStocking as $pen)
                                            <tr id="{{$pen->id}}">
                                                   
                                                    <td> {{\Carbon\Carbon::createFromTimeStamp(strtotime($pen->date_stocked))->diffForHumans()         
                                                        }} </td>    
                                                            
                                                <td> {{$pen->pen_house->pen_number}} </td>
                                                <td> {{$pen->type_of_bird}} </td>
                                                <td>{{$pen->number_of_stock}} </td>
                                                {{-- <td>{{$pen->farm_payable->farm_payables_details[0]->price}} </td>
                                                <td>{{$pen->farm_payable->farm_payables_details[0]->total_amount}} </td> --}}
                                                <td>
{{--                                                     
                                                    <button  class="update-penhouse-stocking-prepopulate edit-modal  btn btn-info" data-penstocking="{{$pen}}" data-amount="{{$pen->farm_payable->farm_payables_details[0]->price}}" data-href="{{route('onboarding.updatestocking',['id'=>$pen->id])}}"
                                                    data-toggle="modal" data-target="#editStock">
                                                        <i class="fa fa-pencil"></i>
                                                    </button> --}}

                                                    {{-- <button class="delete-stocking-url delete-modal btn btn-danger" data-toggle="modal" data-target="#deletePenStockingModal" data-href="{{route('onboarding.deletestocking',['id'=>$pen->id])}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button><br> --}}


                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                      
                                </div>
                            <div class="modal-footer" style="margin-top: 30px;">

                                <button id="prevbtn" type="button" class="btn btn-primary">Previous</button>
                                <button id="finbtn" type="button" class="btn btn-primary">Next</button>
                                


                                {{-- <button id="prevbtn" type="button" class="btn btn-primary">Previous</button>
                                <button id="finbtn" type="button" class="btn btn-primary">Finish</button>
 --}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--delete  Modal -->
    <div class="modal fade" id="deletePenStockingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Penhose Stocking Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete Penhouse stocking
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" data-dismiss="modal" data-token="{{csrf_token()}}" class="delete-stocking-modal btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ADD STOCKING MODAL -->
    <div class="modal fade" id="addStock" tabindex="-1" role="dialog" aria-labelledby="addStock" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="stockingForm" method="POST" action="{{route('onboarding.stocking')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                            <label>Type of bird</label>               

                                <div class="form-group">
                                    <select class="form-control" name="typeOfBird" required>
                                      <option value=""></option>
                                      <option value="Broiler(DOC)">Broiler(DOC)</option>
                                      <option value="Layer(DOC)">Layer(DOC)</option>
                                      <option value="Cockerel(DOC)">Cockerel(DOC)</option>
                                      <option value="Guinea Fowl(DOC)">Guinea Fowl(DOC)</option>
                                      <option value="Turkey(DOC)">Turkey(DOC)</option>
                                      <option value="Ducks(DOC)">Ducks(DOC)</option>
                                      <option value="Quails(DOC)">Quails(DOC)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                        <label>Select penhouse</label>   
                                    <select class="form-control penhouse" name="penHouse" required>
                                        <option value="">Penhouse</option>
                                         @foreach ($penHouses as $pen)  
                                    <option value="{{$pen->id}}">{{$pen->pen_name}}</option>  
                                         @endforeach  
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                        <label>Enter of quantity of stock</label>   
                                    <input autocomplete="off" type="text" class="form-control" name="numberOfStock" aria-describedby="address" placeholder="Quantity of Stock" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                        <label>Unit price</label>   
                                    <input autocomplete="off" type="number" class="form-control" name="amount" aria-describedby="address" placeholder="Amount(0.00)" required>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                        <label>Enter the batch(number) of stock</label>   
                                    <input autocomplete="off" type="number" value="{{$maxBatch+1}}" class="form-control" name="batchId" aria-describedby="address" placeholder="Batch Number">
                                </div>

{{-- 
                                <div class="form-group">
                                    <label>Check box if stock is paid?</label><br>
                                    <input type="checkbox" name="checkme" value="Yes"> Check box if stock is paid?<br>
                               
                                </div> --}}

                                
                            </div>

                           

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                        <label>Enter name of vendor</label>   
                                    <input autocomplete="off" type="text" class="form-control" name="vendorName" aria-describedby="address" placeholder="Vendor">
                                </div>

                                <div class="form-group">
                                        <label>Enter some notes</label>  
                                    <textarea rows="3" id="description" name="description" class="form-control" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group" id="dueDate" style="Display:none;">
                                    <input type="text" class="form-control" name="dateDue" aria-describedby="address" placeholder="dd/mm/yy">
                                </div>
                            </div>


                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                             
                                    <input autocomplete="off" type="text" class="form-control example1" name="datestocked" aria-describedby="address" placeholder="Date stocked" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <!-- EDIT  STOCK MODAL -->
    <div class="modal fade" id="editStock" tabindex="-1" role="dialog" aria-labelledby="addStock" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form id="edit_stocking" method="POST">
                        {{csrf_field()}}
                        <div class="col-md-6 offset-md-6 selectedPenHouse" style="display: none">
                            <label style="margin-right:10px ">Pen House  </label>
                            <b id="selectedPenHouse">Pen House</b>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <select id="birdType" class="form-control" name="typeOfBird" required>
                                      <option value="">Type of Bird</option>
                                      <option value="Broiler">Broiler</option>
                                      <option value="Layer">Layer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <select class="form-control penhouse" name="penHouse" id="penhouse" required>
                                        <option value="">Penhouse</option>
                                         @foreach ($penHouses as $pen)  
                                    <option value="{{$pen->id}}">{{$pen->pen_name}}</option>  
                                         @endforeach  
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <input id="numberOfStock" type="text" class="form-control" name="numberOfStock" aria-describedby="address" placeholder="Number of Stock"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <input type="number" id="amount" class="form-control" name="amount" aria-describedby="address" placeholder="Amount(0.00)"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <input type="number" id="batchId" class="form-control" name="batchId" aria-describedby="address" placeholder="Batch Number">
                                </div>
                                <div class="form-group">
                                    <label>Has the stock been paid for?</label><br>
                                    <input type="radio" name="paid" id="yes" value="YES"> Yes<br>
                                    <input type="radio" name="paid" id="no" value="NO"> No
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <input type="text" id="vendor" class="form-control" name="vendorName" aria-describedby="address" placeholder="Vendor">
                                </div>

                                <div class="form-group">
                                    <textarea rows="3" id="description" name="description" class="form-control" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group" id="dueDate" style="Display:none;">
                                    <input type="text" class="form-control" name="dateDue" aria-describedby="address" placeholder="dd/mm/yy">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ADD TO EXISTING STOCK MODAL -->
    <div class="modal fade" id="addToExistingStock" tabindex="-1" role="dialog" aria-labelledby="addTeamMember" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="new_team_member_form" method="POST" action="{{route('onboarding.stocking')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <select class="form-control" name="typeOfBird">
                                  <option>Type of Bird</option>
                                  <option value="Broiler">Broiler</option>
                                  <option value="Layer">Layer</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <select class="form-control" name="penHouse" id="branch">
                                    <option>Penhouse</option>
                                     @foreach ($penHouses as $pen)  
                                      <option value="{{$pen->id}}">{{$pen->pen_name}}</option>  
                                     @endforeach   
                                </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="numberOfStock" aria-describedby="address" placeholder="Number of Stock">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="amount" aria-describedby="address" placeholder="Amount(0.00)">
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <select class="form-control" name="batchId" required>
                                        <option value="">Select Batch Number</option> 
                                        @foreach ($batches as $batch) 
                                            <option value="{{$batch->batch_id}}">{{$batch->batch_id}}</option> 
                                        @endforeach  
                                </select>
                                </div>
                                <div class="form-group">
                                    <label>Has the stock been paid for?</label><br>
                                    <input type="radio" name="paid" value="YES" checked> Yes<br>
                                    <input type="radio" name="paid" value="NO"> No
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="vendorName" aria-describedby="address" placeholder="Vendor">
                                </div>

                                <div class="form-group">
                                    <textarea rows="3" name="description" class="form-control" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    
    <link rel="stylesheet" href="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.css')}}">
    {{-- <script src="{{ URL::to('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('vendor/jquery/bootstrap.min.js')}}"></script>  --}}
    <script src="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.js')}}"></script> 
    


    <script>
        $('#yes').change(function() {
 
        document.getElementById('dueDate').style.display = 'none';    
   
});
        $('#no').change(function() {
   
        document.getElementById('dueDate').style.display = 'block';    
    
});

//prepopulate penhouse stocking
$('.update-penhouse-stocking-prepopulate').on('click', function (e) {
    // e.preventDefault();
    $(".penhouse").prop('required',false);
    var url = $(this).data('href');
    var penstocking = $(this).data('penstocking');
    var amount = $(this).data('amount');
    $('.selectedPenHouse').css('display', '');
    $("#selectedPenHouse").text(penstocking['pen_house']['pen_name']);
    console.log("Batch number >>>>>>"+ penstocking['stock_tracking']['batch_id']);
    // console.log(">>>>>>>>>>>>>>>>");
    $('#edit_stocking').attr("action", url);
    $('#birdType').val(penstocking['type_of_bird']);
    // $('#penhouse').append($('<option>', {
    //     value: penstocking['pen_house_id'],
    //     text: penstocking['pen_house']['pen_name']
    // }));
    // $('#penhouse').val(penstocking['pen_house_id']);
    $('#numberOfStock').attr("value", penstocking['number_of_stock']);
    $('#batchId').attr("value", penstocking['stock_tracking']['batch_id']);
    $('#dateDue').attr("value", penstocking['farm_payable']['date_due']);
    $('#vendor').attr("value", penstocking['vendor']['name']);
    $('#amount').attr("value", amount);
    if (penstocking['farm_payable']['date_due'] != null) {
        $('#yes').prop("checked", true);
    }
    else {
        $('#no').prop("checked", true);
        document.getElementById('dueDate').style.display = 'block';    
    }
});

// set url for adding new stock
$('.add-new-stock').on('click', function () { 
    $(".penhouse").prop('required',true);
    var token = $(this).data('token');
    $('.selectedPenHouse').css('display', 'none');
    $(':input').attr("value", '');//reset all input
    $('[name="_token"]').attr('value', token);
    $('option').attr('selected', false);//reset all select
    $('#birdType')
    $('input[name="paid"]').prop('checked', false);
    $("#stockingForm select").prop("selectedIndex", 0);
    var url = $(this).data('href');
    $('#stockingForm').attr("action", url);
});


//set url to delete stocking
$(".delete-stocking-url").click(function () {
    var url = $(this).data("href");
    var newurl = $('.delete-stocking-modal').data('href', url); //setter
    // var a = $('.delete-item').data('href'); //getter

});


//delete stocking
$(".delete-stocking-modal").click(function () { 
        var url = $(this).data("href");
        // console.log("url " + url);
        var token = $(this).data("token");
        $.ajax(
            {
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function (data) { 
                    // var json = JSON.parse(data);
                    if (data['status'] == "1") {
                    $('table#onboardingDataTable tr#' + data['id']).remove();
                    // location.reload();
                    // $(window).on('load', function () {
                    //     $('#deleteModal').modal('show');
                    // });
                    // console.log("it Work");
                    // console.log(data); 
                    }

                },
                error: function (data, textStatus, errorThrown) {
                     console.log("error");
                    // console.log(textStatus);
                    // console.log(data);
                    // console.log(errorThrown);
                },
            });
    
});

//delete stocking
$(".delete-stocking-action").click(function () { 
        var url = $(this).data("href");
        // console.log("url " + url); 
});



        document.getElementById("finbtn").onclick = function () {
            location.href = "{{url('account/completed')}}";
        };
        document.getElementById("prevbtn").onclick = function () {
            location.href = "{{url('onboarding/penhouse')}}";
        };

        function check(value){
            if (value === 'NO'){
                document.getElementById('dueDate').style.display = 'block';    
            }
            else{
                document.getElementById('dueDate').style.display = 'none';   
            }
        }

 // Edit a penhouse
 $(document).on('click', '.edit-modal', function() {


            $('.modal-title').text('Edit');
            $('#stockid').val($(this).data('id'));
            // var bird  = $(this).data('bird');
   document.getElementById('bird').value = $(this).data('bird');
        //    $("#bird").value = $(this).data('bird');vendorid//farmpayablesid//batchidd
            $('#penhouse').val($(this).data('house'));
            $('#stock').val($(this).data('stock'));
            $('#batchidd').val($(this).data('batchidd'));
            $('#vendorid').val($(this).data('vendorid'));
            $('#cost').val($(this).data('amount'));
            $('#batch').val($(this).data('batch'));
            $('#vendor').val($(this).data('vendor'));
            $('#notes').val($(this).data('description'));
            $('#farmpayablesid').val($(this).data('farmpayablesid'));
           // id = $('#id_edit').val();//description
            $('#editModal').modal('show');
        });


    	document.getElementById("finbtn").onclick = function () {
        location.href = "{{url('account/completed')}}";
    };
    document.getElementById("prevbtn").onclick = function () {
        location.href = "{{url('onboarding/penhouse')}}";
    };

   // When the document is ready
   $(document).ready(function () {
                
                $('.example1').datepicker({
                    // format: 'yyyy-mm-dd hh:ii'
                    format: "yyyy-mm-dd",
                    showDropdowns: true
                });  
            
            });


    </script>
    <!-- DataTables Pagination -->
    <script src="{{URL::to('vendor/jquery/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('vendor/jquery/dataTables.bootstrap4.min.js')}}"></script>
    
@endsection