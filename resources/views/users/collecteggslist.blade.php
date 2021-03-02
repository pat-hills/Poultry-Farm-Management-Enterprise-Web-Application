@extends('users/layouts.eggs_list_master') 
@section('eggslist')



<article class="content forms-page">
    <div class="title-block">
        <div class="title">
             <!-- @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif -->
            <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#addEggs">Collect Egg</button>
        </div>
        <h3 class="title">Eggs Collection</h3>
        <p class="title-description"> List Of Collections. </p>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <section class="example">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date Collected</th>
                                            {{-- <th>ID</th> --}}
                                            <th>Pen</th>
                                            <th>Number of trays</th>
                                            <th>Eggs remaining</th>
                                            <th> Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- @if(!$penHouseStocking) 
                                        <tr>
                                            <td> No Records </td>
                                        </tr> -->
                                        <!-- @else    -->
                                        @foreach ($penHouseStocking as $pen)
                                   
                                        <tr id="{{$pen->id}}">
                                      
                                            <td>{{\Carbon\Carbon::parse($pen->date_recorded)->format('jS \o\f F, Y')}}</td>
                                            {{-- <td>{{$pen->id}}</td> --}}
                                            <td> {{$pen->pen_house_id}} </td>
                                            <td> {{$pen->tray_quantity}} </td>
                                            <td> {{$pen->eggs_remaining}} </td>
                                            <td>{{$pen->type_of_egg}} </td>
                                            <td>

                                                    {{-- bttn btn btn-info edit-modal --}}
                                                <button  class="btn btn-success edit-modal"
                                                data-tray-quantity ="{{$pen->tray_quantity}}" data-eggs_remaining="{{$pen->eggs_remaining}}" data-id="{{$pen->id}}"
                                                
                                                data-type_of_egg="{{$pen->type_of_egg}}"
                                                data-date_recorded="{{$pen->date_recorded}}"
                                                data-batch_id="{{$pen->batch_id}}"
                                                data-pen_house_id="{{$pen->pen_house_id}}"
                                                
                                                
                                                >
                                                    <i class="fa fa-pencil"></i>
                                                </button>

                                                <button href="" class=" btn btn-danger delete-collection"  data-id="{{$pen->id}}"
                                                    data-href="{{route('account.deleteCollection', ['id'=>$pen->id])}}" data-toggle="modal" data-target="deleteCustomerModal" data-token="{{csrf_token()}}">
                                                        <i class="fa fa-trash"></i>
                                                </button>


                                            </td>
                                        </tr>
                                        @endforeach
                                        <!-- @endif    -->
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

</article>


<!-- ADD P MODAL -->
<div class="modal fade" id="addEggs" tabindex="-1" role="dialog" aria-labelledby="addEggs" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Collecting eggs</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" action="{{route('account.collectEggs')}}">
                            {{csrf_field()}}
                            <div class="row form-group">
                                <div class="col-5">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Batch  </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <select name="batch_id" class="form-control" required>
                                                        <option></option>
                                                        @foreach($batches as $batch)
                                                            <option value="{{$batch->id}}">{{$batch->batch_id}}</option> 
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="form-group row">
                                        <label class="col-sm-5 form-control-label">Penhouse</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <select   name="pen_house_id" class="form-control" required>
                                                        <option>Select Penhouse</option>
                                                        @foreach($penhouses as $penhouse)
                                                            <option value="{{$penhouse->id}}">{{$penhouse->pen_name}}</option> 
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row form-group">
                                <div class="col-5">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Type</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <select name="type_of_egg" class="form-control" required>
                                                        <option>Select Egg Type</option>
                                                        <option>Good</option>
                                                        <option>Broken</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="form-group row">
                                        <label class="col-sm-5 form-control-label">Quantity Of Trays</label>
                                        <div class="col-sm-7">
                                            <input name="tray_quantity" required type="number" class="form-control" id="" placeholder="Enter number of trays">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-5">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Date</label>
                                        <div class="col-sm-8">
                                            <input autocomplete="off" name="date_recorded" required type="text" class="form-control example1" id="" placeholder="dd/mm/yy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="form-group row">
                                        <label style="color:red" class="col-sm-5 form-control-label">Eggs Remaining</label>
                                        <div class="col-sm-7">
                                            <input name="eggs_remaining" type="number" class="form-control" id="" placeholder="Enter eggs remaining">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" onclick="return confirm('Are you sure you want to proceed?');" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



    </div>
</div>



<!-- EDIT COLLECTION MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Edit collecting eggs</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" action="{{route('account.collectUpdatedEggs')}}">
                            {{csrf_field()}}
                            <div class="row form-group">
                                    <input id="id" name="id" required type="hidden" class="form-control" id="" placeholder="Enter number of trays">
                                        
                                    <input required value="UPDATEFORM" id="formposttype" name="formposttype" required type="hidden" class="form-control" id="" placeholder="Enter number of trays">
                                        


                                <div class="col-5">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Batch  </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <select id="batch_id" name="batch_id" class="form-control" required>
                                                        <option>Select Batch Id</option>
                                                        @foreach($batches as $batch)
                                                            <option value="{{$batch->id}}">{{$batch->batch_id}}</option> 
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="form-group row">
                                        <label class="col-sm-5 form-control-label">Pen house</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <select id="pen_house_id" name="pen_house_id" class="form-control" required>
                                                        <option>Select Penhouse</option>
                                                        @foreach($penhouses as $penhouse)
                                                            <option value="{{$penhouse->id}}">{{$penhouse->pen_name}}</option> 
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row form-group">
                                <div class="col-5">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Type</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <select id="type_of_egg" name="type_of_egg" class="form-control" required>
                                                        <option>Select Egg Type</option>
                                                        <option>Good</option>
                                                        <option>Broken</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="form-group row">
                                        <label class="col-sm-5 form-control-label">Quantity Of Trays</label>
                                        <div class="col-sm-7">
                                            <input id="tray_quantity" name="tray_quantity" required type="number" class="form-control" id="" placeholder="Enter number of trays">
                                        
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-5">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Date</label>
                                        <div class="col-sm-8">
                                            <input id="date_recorded" autocomplete="off" name="date_recorded" required type="text" class="form-control example1" id="" placeholder="dd/mm/yy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="form-group row">
                                        <label style="color:red" class="col-sm-5 form-control-label">Eggs Remaining</label>
                                        <div class="col-sm-7">
                                            <input id="eggs_remaining" name="eggs_remaining" type="number" class="form-control" id="" placeholder="Enter eggs remaining">
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
        </section>
    </div>
</div>




 


<link rel="stylesheet" href="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.css')}}">
{{-- <script src="{{ URL::to('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::to('vendor/jquery/bootstrap.min.js')}}"></script>  --}}
<script src="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.js')}}"></script> 


<script type="text/javascript">

// When the document is ready
$(document).ready(function () {
        
        $('.example1').datepicker({
            // format: 'yyyy-mm-dd hh:ii'
            format: "yyyy-mm-dd",
            showDropdowns: true
        });  
    
    });


// Edit a penhouse//deleteModal
$(document).on('click', '.edit-modal', function() {
    $('.modal-title').text('Edit Collection');
    
    $('#batch_id').val($(this).data('batch_id'));
    $('#id').val($(this).data('id'));
    $('#tray_quantity').val($(this).data('tray-quantity'));
    $('#date_recorded').val($(this).data('date_recorded'));
    $('#eggs_remaining').val($(this).data('eggs_remaining'));
    $('#type_of_egg').val($(this).data('type_of_egg'));
    $('#pen_house_id').val($(this).data('pen_house_id'));
   // id = $('#id_edit').val();pen_house_id
    $('#editModal').modal('show');
});

 



//delete egg collection


$(".delete-collection").click(function () {
    var r = confirm("Are you sure you want to delete collection?");
    if (r == true) {
        var tableRow = 'table#dataTable tr#' + $(this).data("id");
        var url = $(this).data("href");
        console.log("url " + tableRow);
        console.log("url " + url);
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
                        toastr.success('Collection record deleted successfully');
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




</script>   
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection