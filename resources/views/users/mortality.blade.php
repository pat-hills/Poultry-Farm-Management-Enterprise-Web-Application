@extends('users/layouts.mortalitymaster') 
@section('mortality')

<article class="content forms-page">
    <div class="title-block">
        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#addMortality">Add Mortality</button>

        </div>
        <h3 class="title">Mortality</h3>

        <p class="title-description">

     </p>
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
                                            <th>Date Recorded</th>
                                            <th>Batch Id</th>
                                            <th>Pen</th>
                                            <th>Quantity</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$deadBirds)
                                        <tr>
                                            <td>No Records</td>
                                        </tr>
                                        @else @foreach($deadBirds as $deadBird)
                                        <tr id="{{$deadBird->id}}">
                                                <td> {{\Carbon\Carbon::createFromTimeStamp(strtotime($deadBird->date_stocked))->diffForHumans()         
                                                    }} </td> 
                                            {{-- <td>{{\Carbon\Carbon::parse($deadBird->created_at)->format('jS \o\f F, Y')}}</td> --}}
                                            <td>{{$deadBird->batch_id}}</td>
                                            <td>{{$deadBird->pen_house->pen_name}}</td>
                                            <td>{{$deadBird->number_of_birds}}</td>
                                            <td>{{$deadBird->reason}}</td>
                                            <td>
                                                <button class="btn btn-info edit-mortality" data-toggle="modal" data-target="#editMortality" data-batch="{{$deadBird->batch_id}}"
                                                    data-birdnumber="{{$deadBird->number_of_birds}}" data-reason="{{$deadBird->reason}}"
                                                    data-href="{{route('birds.updatemortality',['id'=>$deadBird->id])}}"
                                                     data-penhouse="{{$deadBird->pen_house_id}}"
                                                     data-idrecord="{{$deadBird->id}}"
                                                     data-daterecorded="{{$deadBird->date_stocked}}"
                                                        
                                                     >
                                                          
                                                    <i class="fa fa-pencil"></i>
                                                        </button>

                                                <button class="btn btn-danger delete-mortality-record"  data-token="{{csrf_token()}}" data-id="{{$deadBird->id}}" data-href="{{route('birds.deletemortality',['id'=>$deadBird->id])}}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                            </td>
                                        </tr>
                                        @endforeach @endif
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
<div class="modal fade" id="addMortality" tabindex="-1" role="dialog" aria-labelledby="addMortality" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Mortality Recording</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" action="{{route('birds.mortality')}}">
                            {{csrf_field()}}
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Batch Id</label>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="batchId" required>
                                                    <option>Select Batch Id</option>
                                                    @foreach ($batches as $batch)
                                                    <option value="{{$batch->id}}">{{$batch->batch_id}} </option>
                                                    @endforeach   
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Penhouse</label>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="penHouse" required>
                                                    <option>Select Pen</option>
                                                    @foreach ($penHouse as $pen) 
                                                    <option value="{{$pen->id}}">{{$pen->pen_name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Quantity</label>
                                        <div class="col-sm-7">
                                            <input type="number" class="form-control" name="numberOfBirds" placeholder="Enter number dead">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Description</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <textarea rows="2" name="reason" class="form-control" id="" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Recording date</label>
                                        <div class="col-sm-7">
                                            <input autocomplete="off" required type="text" class="form-control example1" name="daterecorded"  placeholder="dd/mm/yy">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label"></label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                 
                                            </div>
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
        </section>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editMortality" tabindex="-1" role="dialog" aria-labelledby="addMortality" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Mortality Recording</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form  method="POST" action="{{route('birds.editCullingDeadBirds')}}">
                            {{csrf_field()}}
                        
                            <input id="idrecord" type="hidden" class="form-control" name="idrecord" placeholder="Enter number dead">
                                       

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Batch Id</label>
                                        <div class="col-sm-7">
                                            <select id="batch" class="form-control" name="batchId" required>
                                                    <option>Select Batch Id</option>
                                                    @foreach ($batches as $batch)
                                                    <option value="{{$batch->id}}">{{$batch->batch_id}} </option>
                                                    @endforeach   
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label">Penhouse</label>
                                        <div class="col-sm-7">
                                            <select id="penhouse" class="form-control" name="penHouse" required>
                                                    <option>Select Pen</option>
                                                    @foreach ($penHouse as $pen) 
                                                    <option value="{{$pen->id}}">{{$pen->pen_name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Quantity</label>
                                        <div class="col-sm-7">
                                            <input id="birdNumber" type="number" class="form-control" name="numberOfBirds" placeholder="Enter number dead">
                                       
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Description</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <textarea id="reason" rows="2" name="reason" class="form-control" id="" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Date recorded</label>
                                            <div class="col-sm-7">
                                                <input id="daterecorded" autocomplete="off" required type="text" class="form-control example1" name="daterecorded" placeholder="yyyy/mm/dd">
                                           
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label"></label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                   
                                                </div>
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
        </section>
    </div>
</div>
{{-- <script src="{{url('/')}}/assestdash/js/custom.js"></script> --}}

  <link rel="stylesheet" href="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.css')}}">
 
<script src="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.js')}}"></script>  

<script>

$(".edit-mortality").click(function () {

$('#batch').val($(this).data("batch"));
$('#reason').val($(this).data("reason"));
$('#penhouse').val($(this).data("penhouse"));
$('#birdNumber').val($(this).data("birdnumber"));
$('#idrecord').val($(this).data("idrecord"));
$('#daterecorded').val($(this).data("daterecorded"));
//  $('#editMortalityRecordForm').attr("action", $(this).data("href"));
});



 $(document).ready(function () {
                
                $('.example1').datepicker({
                    // format: 'yyyy-mm-dd hh:ii'
                    format: "yyyy-mm-dd",
                    showDropdowns: true
                });  
            
            });



//delete a mortality record
$(".delete-mortality-record").click(function () {
    var r = confirm("Are you sure you want to delete mortality record?");
    if (r == true) {
        var tableRow = 'table#dataTable tr#' + $(this).data("id");
        var url = $(this).data("href");
        console.log("url " + url);
        console.log("tableRow " + tableRow);
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
                   // var json = JSON.parse(data);
                   // console.log(json["msg"]);
                    //console.log(data);
                    // if (json["msg"] == "Success") {
                    //     $(tableRow).remove();
                    //     // $('#dataTable').DataTable().row('#' + $(this).data("id")).remove().draw();
                    //     toastr.success('Record deleted successfully');
                    // } 
                   // else {
                   //     toastr.error('An error occured!')
                   // }
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
@endsection