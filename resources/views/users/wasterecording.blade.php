@extends('users/layouts.feedrecordingmaster') 
@section('givefeed')

<article class="content forms-page">
    <div class="title-block">
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#recordFeed">Record Wastage </button>

        </div>
       
         
        @if(count($getFarmFeed)==0) 
        <h3 class="title">

            <a href="{{url('account/billitems')}}">
                <div class="col-12 col-sm-12 stat-col stats">
                    <div class="value">  No feed recorded yet? (Add feed as a farm expense product) </div>
                </div>
            </a>

        </h3>
     @else 
     <h3 class="title">List of feed given</h3>  
     @endif


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
                                            <th>Penhouse</th>
                                            <th>Feed name</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!$wastes)
                                        <tr>
                                            <td> No Records </td>
                                        </tr>
                                        @else @foreach($wastes as $waste)
                                        <tr id="{{$waste->id}}">
                                            <td>{{\Carbon\Carbon::parse($waste->date_recorded)->format('jS \o\f F, Y')}}</td>
                                            <td>{{$waste->pen_house->pen_number}}</td>
                                            <td>{{$waste->feed_name}}</td>
                                            <td>{{$waste->weight}}</td>
                                            <td>{{$waste->unit_measurement}}</td>
                                            <td>
                                                <button class="edit-waste btn btn-info" data-toggle="modal" data-feed="{{$waste->feed_name}}" data-weight="{{$waste->weight}}"
                                                    data-batchwas="{{$waste->batch_id}}" data-href="{{route('birds.updatefeedwastage',['id'=>$waste->id])}}"
                                                    data-notes="{{$waste->notes}}" data-penhouse="{{$waste->pen_house_id}}" data-unit="{{$waste->unit_measurement}}"
                                                    data-daterecorded="{{$waste->date_recorded}}" data-target="#editrecordFeed">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                <button class="delete-waste-record btn btn-danger" data-token="{{csrf_token()}}" data-id="{{$waste->id}}" data-href="{{route('birds.deletefeedwastage', ['id'=>$waste->id])}}">
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
<div class="modal fade" id="recordFeed" tabindex="-1" role="dialog" aria-labelledby="recordFeed" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Record Wastage</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" action="{{route('birds.feedwastage')}}">
                            {{csrf_field()}}

 
                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Batch</label>
                                            <div class="col-sm-7">
                                                    <select   class="form-control" name="batch_id" required>
                                                            <option>Select Batch</option>
                                                            @foreach ($batches as $batch) 
                                                            <option value="{{$batch->id}}">{{$batch->batch_id}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
    
    
                                            {{-- <label style="display:none" class="col-sm-4 form-control-label">Drug Frequency</label>
                                             --}}
    
                                            {{-- <div class="col-sm-7">
                                                <input type="hidden" class="form-control" name="drug_frequency" placeholder="Enter drug frequency">
                                            </div>   --}}
    
                                        </div>
                                    </div>
                                </div>
 
                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Penhouse</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" name="pen_house_id" required>
                                                        <option>Select Pen</option>
                                                        @foreach ($penHouses as $pen) 
                                                        <option value="{{$pen->id}}">{{$pen->pen_name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
    
    
                                            {{-- <label style="display:none" class="col-sm-4 form-control-label">Drug Frequency</label>
                                             --}}
    
                                            {{-- <div class="col-sm-7">
                                                <input type="hidden" class="form-control" name="drug_frequency" placeholder="Enter drug frequency">
                                            </div>   --}}
    
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Feed name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select class="form-control" name="feed_name" required>
                                                        <option></option>
                                                        @foreach ($getFarmFeed as $pen) 
                                                       <option value="{{$pen->item_name}}">{{$pen->item_name}}</option>
                                                       @endforeach 
                                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
                                            <label style="display:none" class="col-sm-4 form-control-label">Drug Device</label>
                                            <div class="col-sm-7">
                                                {{-- <select style="display:none" class="form-control" name="drug_device" required>
                                                            <option>Select Pen</option>
                                                            <option>Device 1</option>
                                                            <option>Device 2</option>
                                                            <option>Device 3</option>
                                                            @foreach ($penHouse as $pen) 
                                                            <option value="{{$pen->id}}">{{$pen->pen_name}}</option>
                                                            @endforeach  
                                                        </select> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Unit(Weight)</label>
                                            <div class="col-sm-7">
                                                    <select required style="" class="form-control" name="unit_measurement" required>
                                                            <option></option>
                                                            <option>g</option>
                                                            <option>Kg</option>
                                                       
                                                            
                                                        </select>
    
                                                
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
    
                                            {{-- <label class="col-sm-4 form-control-label">Quantiy</label>
                                             --}}
                                            <div class="col-sm-7">
                                                
                                                {{-- <div class="form-group">
                                                    <input type="number" class="form-control" name="weight" placeholder="Enter weight of drug ">
                                                </div> --}}
    
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
    
                                <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                
                                                <label class="col-sm-4 form-control-label">Quantity</label>
                                                <div class="col-sm-7">
                                                         <div class="form-group">
                                                                <input type="number" autocomplete="off" class="form-control" name="weight" placeholder="Enter Quantity">
                                                            </div>  
                                                    
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-6">
                                            <div class="row">
    
                                                {{-- <label style="display:none" class="col-sm-4 form-control-label">Quantiy</label> --}}
    
                                                <div class="col-sm-7">
    
                                                    {{-- <div class="form-group">
                                                        <input style="display:none" type="number" class="form-control" name="weight" placeholder="Enter weight of drug ">
                                                    </div> --}}
    
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
    
    
                                <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Date recorded</label>
                                                <div class="col-sm-7">
                                                        <div class="form-group">
                                                                <input autocomplete="off" type="text" class="form-control example1" name="date_recorded" placeholder="yyyy-mm-dd">
                                                            </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-6">
                                            <div class="row">
                                             {{--                                             
                                                <label style="display:none" class="col-sm-4 form-control-label">Quantiy</label>
                                               --}}
                                                <div class="col-sm-7">
    
                                                    {{-- <div class="form-group">
                                                        <input style="display:none" type="number" class="form-control" name="weight" placeholder="Enter weight of drug ">
                                                    </div> --}}
                                               
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

<!-- EDIT FEEDING MODAL -->
<div class="modal fade" id="editrecordFeed" tabindex="-1" role="dialog" aria-labelledby="recordFeed" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Edit Wastage</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form id="editWasteRecordForm" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">

                            
                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Batch</label>
                                            <div class="col-sm-7">
                                                    <select id="batchwas" class="form-control" name="batch_id" required>
                                                            <option>Select Batch</option>
                                                            @foreach ($batches as $batch) 
                                                            <option value="{{$batch->id}}">{{$batch->batch_id}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
    
    
                                            {{-- <label style="display:none" class="col-sm-4 form-control-label">Drug Frequency</label>
                                             --}}
    
                                            {{-- <div class="col-sm-7">
                                                <input type="hidden" class="form-control" name="drug_frequency" placeholder="Enter drug frequency">
                                            </div>   --}}
    
                                        </div>
                                    </div>
                                </div>
 
                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Penhouse</label>
                                            <div class="col-sm-7">
                                                <select id="penhouse" class="form-control" name="pen_house_id" required>
                                                        <option>Select Pen</option>
                                                        @foreach ($penHouses as $pen) 
                                                        <option value="{{$pen->id}}">{{$pen->pen_name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
    
    
                                            {{-- <label style="display:none" class="col-sm-4 form-control-label">Drug Frequency</label>
                                             --}}
    
                                            {{-- <div class="col-sm-7">
                                                <input type="hidden" class="form-control" name="drug_frequency" placeholder="Enter drug frequency">
                                            </div>   --}}
    
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Feed name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select id="feed" class="form-control" name="feed_name" required>
                                                        <option></option>
                                                        @foreach ($getFarmFeed as $pen) 
                                                       <option value="{{$pen->item_name}}">{{$pen->item_name}}</option>
                                                       @endforeach 
                                                                    {{-- @foreach ($penHouse as $pen) 
                                                                    <option value="{{$pen->id}}">{{$pen->pen_name}}</option>
                                                                    @endforeach --}}
                                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
                                            <label style="display:none" class="col-sm-4 form-control-label">Drug Device</label>
                                            <div class="col-sm-7">
                                                {{-- <select style="display:none" class="form-control" name="drug_device" required>
                                                            <option>Select Pen</option>
                                                            <option>Device 1</option>
                                                            <option>Device 2</option>
                                                            <option>Device 3</option>
                                                            @foreach ($penHouse as $pen) 
                                                            <option value="{{$pen->id}}">{{$pen->pen_name}}</option>
                                                            @endforeach  
                                                        </select> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Unit(Weight)</label>
                                            <div class="col-sm-7">
                                                    <select id="unit" required style="" class="form-control" name="unit_measurement" required>
                                                            <option></option>
                                                            <option>g</option>
                                                            <option>Kg</option>
                                                       
                                                            
                                                        </select>
    
                                                
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="row">
    
                                            {{-- <label class="col-sm-4 form-control-label">Quantiy</label>
                                             --}}
                                            <div class="col-sm-7">
                                                
                                                {{-- <div class="form-group">
                                                    <input type="number" class="form-control" name="weight" placeholder="Enter weight of drug ">
                                                </div> --}}
    
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
    
                                <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                
                                                <label class="col-sm-4 form-control-label">Quantity</label>
                                                <div class="col-sm-7">
                                                         <div class="form-group">
                                                                <input id="weight" type="number" autocomplete="off" class="form-control" name="weight" placeholder="Enter Quantity">
                                                            </div>  
                                                    
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-6">
                                            <div class="row">
    
                                                {{-- <label style="display:none" class="col-sm-4 form-control-label">Quantiy</label> --}}
    
                                                <div class="col-sm-7">
    
                                                    {{-- <div class="form-group">
                                                        <input style="display:none" type="number" class="form-control" name="weight" placeholder="Enter weight of drug ">
                                                    </div> --}}
    
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
    
    
                                <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Date recorded</label>
                                                <div class="col-sm-7">
                                                        <div class="form-group">
                                                                <input id="daterecorded" autocomplete="off" type="text" class="form-control example1" name="date_recorded" placeholder="yyyy-mm-dd">
                                                            </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-6">
                                            <div class="row">
                                             {{--                                             
                                                <label style="display:none" class="col-sm-4 form-control-label">Quantiy</label>
                                               --}}
                                                <div class="col-sm-7">
    
                                                    {{-- <div class="form-group">
                                                        <input style="display:none" type="number" class="form-control" name="weight" placeholder="Enter weight of drug ">
                                                    </div> --}}
                                               
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


<link rel="stylesheet" href="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.css')}}">
 
<script src="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.js')}}"></script>  


<script>
 $(document).ready(function () {
                
                $('.example1').datepicker({
                    // format: 'yyyy-mm-dd hh:ii'
                    format: "yyyy-mm-dd",
                    showDropdowns: true
                });  
            
            });
</script>
         
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection