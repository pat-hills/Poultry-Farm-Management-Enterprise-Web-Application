@extends('users/layouts.feedrecordingmaster') 
@section('givefeed')

<article class="content forms-page">
    <div class="title-block">
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#recordFeed">Give Feed </button>

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
                                            <th>Feed Name</th>
                                            <th>Quantity</th>
                                            <th>Penhouse</th>
                                            {{-- <th>Feed Frequency</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!$feedGiven)
                                        <tr>
                                            <td> No Records </td>
                                        </tr>
                                        @else @foreach($feedGiven as $feed)
                                        <tr id="{{$feed->id}}">
                                            <td>{{\Carbon\Carbon::parse($feed->date_recorded)->format('jS \o\f F, Y')}}</td>
                                            <td>{{$feed->feed_name}}</td>
                                            <td>{{$feed->quantity_applied}}</td>
                                            <td>{{$feed->pen_house->pen_number}}</td>
                                            {{-- <td>{{$feed->feed_frequency}}</td> --}}
                                            <td>
                                                <button class="edit-feeding  btn btn-info" data-toggle="modal" data-feed="{{$feed->feed_name}}" data-quantity="{{$feed->quantity_applied}}"
                                                    data-batchb="{{$feed->batch_id}}" data-href="{{route('birds.updaterecordfeed',['id'=>$feed->id])}}"
                                                    data-penhouse="{{$feed->pen_house_id}}" 
                                                    data-frequency="{{$feed->feed_frequency}}"
                                                    data-date_recorded="{{$feed->date_recorded}}"
                                                    data-unit="{{$feed->unit}}"
                                                    data-target="#editrecordFeed">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>

                                                <button class="delete-feed-record btn btn-danger" data-id="{{$feed->id}}" data-token="{{csrf_token()}}" data-id="{{$feed->id}}"
                                                    data-href="{{route('birds.deleterecordfeed', ['id'=>$feed->id])}}">
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

<!-- delete Modal -->
<div class="modal fade" id="deleteFeedRecordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete feed record
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" data-dismiss="modal" data-token="{{csrf_token()}}" data-id="" class="delete-feed-record-confirm btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- ADD P MODAL -->
<div class="modal fade" id="recordFeed" tabindex="-1" role="dialog" aria-labelledby="recordFeed" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Give Feed</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" action="{{route('birds.recordfeed')}}">
                            {{csrf_field()}}


                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Batch</label>
                                            <div class="col-sm-7">
                                                    <select  class="form-control" name="batch_id" required>
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
                                                    <select required style="" class="form-control" name="unit" required>
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
                                                                <input type="number" autocomplete="off" class="form-control" name="quantity_applied" placeholder="Enter weight of drug ">
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
                    <h4 class="modal-title" id="modelTitleId">Give Feed</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form id="feedRecordForm" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">

 
                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Batch</label>
                                            <div class="col-sm-7">
                                                    <select id="batchb" class="form-control" name="batch_id" required>
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
                                                    <select id="unit" required style="" class="form-control" name="unit" required>
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
                                                                <input id="quantity" type="number" autocomplete="off" class="form-control" name="quantity_applied" placeholder="Enter weight of drug ">
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
                                                                <input id="date_recorded" autocomplete="off" type="text" class="form-control example1" name="date_recorded" placeholder="yyyy-mm-dd">
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