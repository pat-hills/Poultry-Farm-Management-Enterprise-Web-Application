@extends('users/layouts.drugrecordingmaster') 
@section('givedrug')

<article class="content forms-page">
    <div class="title-block">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#giveDrug">Give Drug </button>

        </div>

        @if(count($getFarmDrugs)==0) 
        <h3 class="title">

            <a href="{{url('account/billitems')}}">
                <div class="col-12 col-sm-12 stat-col stats">
                    <div class="value">  No drug recorded yet? (Add drug as a farm expense product) </div>
                </div>
            </a>

        </h3>
     @else 
     <h3 class="title">List of drugs given</h3>  
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
                                            <th>Drug Name</th>
                                          
                                            <th>Quantity</th>
                                            <th>Unit</th>  
                                           
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($drugGiven as $drug)
                                        <tr id="{{$drug->id}}">
                                            <td>{{\Carbon\Carbon::parse($drug->date_recorded)->format('jS \o\f F, Y')}}</td>
                                            <td>{{$drug->pen_house->pen_number}}</td>
                                            <td>{{$drug->drug_name}}</td>
                                           
                                            <td>{{$drug->quantity}}</td>
                                            <td>{{$drug->unit}}</td> 
                                          
                                            
                                            <td>
                                                <button class="btn btn-info edit-drug" data-toggle="modal" data-target="#editGiveDrug" data-penhouse="{{$drug->pen_house_id}}"
                                                    data-drugFrequency="{{$drug->drug_frequency}}" data-drugName="{{$drug->drug_name}}"
                                                    data-drugDevice="{{$drug->drug_device}}" data-quantity="{{$drug->quantity}}"
                                                    data-weight="{{$drug->weight}}"
                                                    data-unit="{{$drug->unit}}"
                                                    data-date_recorded="{{$drug->date_recorded}}"
                                                    data-href="{{route('birds.updatedrugrecord',['id'=>$drug->id])}}"
                                                    >
                                                <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="delete-drug-record btn btn-danger" data-token="{{csrf_token()}}" data-id="{{$drug->id}}" data-href="{{route('birds.deletedrugrecord', ['id'=>$drug->id])}}">
                                                            <i class="fa fa-trash"></i>
                                                 </button>
                                            </td>
                                        </tr>
                                    @endforeach 
                                        <tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

</article>


<!-- ADD  MODAL -->
<div class="modal fade" id="giveDrug" tabindex="-1" role="dialog" aria-labelledby="giveDrug" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Record drugs given</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" action="{{route('birds.recorddrug')}}">
                            {{csrf_field()}}



                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Batch</label>
                                            <div class="col-sm-7">
                                                    <select id="batch" class="form-control" name="batch_id" required>
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
                                                    @foreach ($penHouse as $pen) 
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
                                        <label class="col-sm-4 form-control-label">Drug</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">

                                                    @if(!$getFarmDrugs) 
                                                    No records yet
                                                 @else 
                                                 <select class="form-control" name="drug_name" required>
                                                        
                                                        <option></option>
                                                        @foreach ($getFarmDrugs as $pen) 
                                                       <option value="{{$pen->item_name}}">{{$pen->item_name}}</option>
                                                       @endforeach 
                                                   
                                                   </select>
                                                 @endif

                                               
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
                                                            <input type="number" class="form-control" name="quantity" placeholder="Enter weight of drug ">
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


<!-- EDIT  MODAL -->
<div class="modal fade" id="editGiveDrug" tabindex="-1" role="dialog" aria-labelledby="giveDrug" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Edit Drugs Given</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form id="editDrugRecordForm" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                            {{csrf_field()}}

 

                            <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Penhouse</label>
                                            <div class="col-sm-7">
                                                <select id="penhouse" class="form-control" name="pen_house_id" required>
                                                        <option>Select Pen</option>
                                                        @foreach ($penHouse as $pen) 
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
                                            <label class="col-sm-4 form-control-label">Drug</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select id="drugName" class="form-control" name="drug_name" required>
                                                        <option></option>
                                                        @foreach ($getFarmDrugs as $pen) 
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
                                                                <input id="quantity" type="number" class="form-control" name="quantity" placeholder="Enter weight of drug ">
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