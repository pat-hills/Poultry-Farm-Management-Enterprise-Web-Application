@extends('users/layouts.createbillmaster')

@section('createbill')

<article class="content forms-page">
    <div class="title-block">
            

            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif


            @if(Session::has('messagefailed'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('messagefailed') }}</p>
            @endif


        <h3 class="title"> Add  a record</h3>
        {{-- <p class="title-description"> ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p> --}}
    </div>

    <section class="section">
                <div class="card card-block sameheight-item">
                <form method="POST" action="{{route('account.createbills')}}">
                            {{csrf_field()}} 
                        <div class="row form-group">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Creditor</label>
                                        <div class="col-sm-7">
                                            <div class="form-group"> 
                                                    @if(!$vendors) 
                                                    <a href="{{url('account/vendors')}}">Add Creditor</a>
                                                   @else 
                                                   <select name="vendor" class="form-control" required>
                                                        <option value=""></option>
                                                        @foreach($vendors as $vendor)
                                                        <option value="{{$vendor->id}}">{{$vendor->name}}</option> 
                                                        @endforeach
                                              
                                                    </select>
                                                   @endif 

                                                {{-- <select name="vendor" class="form-control" required>
                                                    <option value=""></option>
                                                    @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->id}}">{{$vendor->name}}</option> 
                                                    @endforeach
                                               <a href="{{url('account/items')}}">Add vendor</a>
                                                </select> --}}
                                           
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" required  name="dateIssued" class="form-control example1" autocomplete="off"  placeholder="yyyy-mm-dd" required> 
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Currency</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <select name="currency" class="form-control" required>
                                                    <option></option>
                                                    <option value="GHS">Cedi</option>
                                                    <option value="Naira">Naira</option>
                                                  
                                                    <option value="CFA">CFA</option>
                                                </select>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Date Due</label>
                                        <div class="col-sm-8">
                                            <input required type="text" name="dateDue" autocomplete="off" class="form-control example1"  placeholder="yyyy-mm-dd" required> 
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Bill Number</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input required type="number"  name="invoiceNumber" na class="form-control" id="" placeholder="Enter bill number"> 
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Stock batch</label>
                                        <div class="col-sm-8">
                                                <select required name="batchId" class="form-control">
                                                @foreach($batchCycles as $batch)
                                                <option value="{{$batch->id}}">{{$batch->batch_id}}</option> 
                                                @endforeach
                                                </select>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Description</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <textarea required rows="3" class="form-control"  name="description" id="formGroupExampleInput7"></textarea>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div id="unpaid" class="container tab-pane active"><br>
                                <table class="table table-responsive" id="sales-table">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th> 
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select id="chosen_a"  class="form-control" name="billItem[]" required>
                                                        <option></option>
                                                    @foreach($getAllItemsF as $item)
                                                  

                                                        <option value="{{$item->id}}" data-price="{{$item->price}}"  >{{$item->item_name}} </option> 
                                                   
                                                        @endforeach
                                                </select> 
                                            </td>
                                            <td><input autocomplete="off"  type="decimal" name="quantity[]" class="form-control" placeholder="Quantity" required/></td>
                                            <td><input autocomplete="off"  type="decimal" name="amount[]" class="form-control" placeholder="Unit Price" required/></td>
                                            
                                        </tr>
                                        <tr class="new-item" style="display: none">
                                            <td style="display: none"><input  class="bill-id"/></td>
                                            <td> 
                                                <select class="bill-item form-control"   >
                                                        <option></option>
                                            @foreach($getAllItemsF as $item)
                                           
                                            <option value="{{$item->id}}" data-price="{{$item->price}}"  >{{$item->item_name}} </option> 
                                                   
                                            @endforeach
                                            </select> </td>
                                            <td><input autocomplete="off" type="decimal" class="form-control quantity"  placeholder="Item Quantity"></td>
                                            <td><input autocomplete="off" type="decimal" class="form-control amount" placeholder="Item Amount"></td>
                                            <td> </td>
                                        <td><button type="button" class="btn btn-danger remove" onclick="$(this).parents()[1].remove()" >Remove</button></td>
                                   
                                    </tr>   
                                      
                                                <tr id="one-item" style="display: none">
                                                    <td>Please <a href="" class="addSales">Add </a>atleast one item  </td>
                                                </tr>
                                    </thead>
                                    <tbody class="sales_row">

                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary addSales" id="addSales">Add Item</button> 
                            </div>
                        </div>

                    
                        <div class="row form-group">
                            <div class="col-4">
                            </div> 
                            <div class="col-4">
                                <button onclick="return confirm('Are you sure you want to proceed?');" type="submit" class="btn btn-danger form-control" id="savebtn">Save</button>  
                            </div>
                        </div>
                    </form>
                </div>
    </section>

   
</article>




<link rel="stylesheet" href="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.css')}}">

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

 
        
 </script>

@endsection