@extends('users/layouts.createbillmaster')

@section('createbill')

<article class="content forms-page">
    <div class="title-block">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
        <h3 class="title"> View payables</h3>
         <p class="title-description">

             
           
            </p> 
    
            </div>

    <section class="section">
                <div class="card card-block sameheight-item">
                    <form id="billsdetailfrm" role="form" method="POST">
                            {{csrf_field()}} 
                        <div class="row form-group">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Vendor</label>
                                        <div class="col-sm-7">
                                            <div class="form-group"> 
                                                <select name="vendor" class="form-control">
                                                    <option>Select vendor's name</option>
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{$vendor->id}}" {{($vendor->id === $bill->vendor_id) ? 'selected="selected"':''}}>{{$vendor->name}}</option> 
                                                        @endforeach
                                                    <option style="color:brown"> <a href="{{url('account/items')}}">Add vendor</a></option>
                                                </select>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{\Carbon\Carbon::parse($bill->date_issued)->format('Y-m-d')}}"  name="dateIssued" class="form-control example1" placeholder="Enter the issued date"> 
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
                                                <select name="currency" class="form-control">
                                                    <option>Select currecny of operation</option>
                                                    <option {{($bill->currency === 'Naira') ? 'selected="selected"':''}} value="Naira">Naira</option>
                                                    <option {{($bill->currency === 'GHS') ? 'selected="selected"':''}} value="GHS">Cedi</option>
                                                    <option {{($bill->currency === 'CFA') ? 'selected="selected"':''}} value="CFA">CFA</option>
                                                </select>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Date Due</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{\Carbon\Carbon::parse($bill->date_due)->format('Y-m-d')}}" name="dateDue" class="form-control example1" id="" placeholder="Enter due date of bill"> 
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
                                            <input type="number" value="{{$bill->invoice_number}}" name="invoiceNumber" class="form-control" id="" placeholder="Enter bill number"> 
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 form-control-label">Batch</label>
                                        <div class="col-sm-8">
                                                <select name="batchId" class="form-control"> 
                                                <option>Select Batch Number</option>
                                                @foreach($batchCycles as $batch) 
                                                    <option value="{{$batch->id}}" {{($bill->batch_id === $batch->id) ? 'selected="selected"':''}}>{{$batch->batch_id}}</option> 
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
                                                <textarea rows="3" class="form-control"  name="description" id="formGroupExampleInput7"></textarea>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="container mt-3">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a style="text-decoration: none;" class="nav-link active" data-toggle="tab" href="#billitems">Bill Items</a>
                                    </li>
                                    <li class="nav-item">
                                        <a style="text-decoration: none;" class="nav-link" data-toggle="tab" href="#payments">Payments</a>
                                    </li>
                                   
                                </ul>
    
                          <!-- Tab panes -->
                          <div class="tab-content">
                                <div id="billitems" class="container tab-pane active"><br>
                                    <div class="table-responsive">
                                          
                                <table  id="bills-table">
                                        <thead>
                                            <tr> 
                                                <td style="display: none">id</td>
                                                <td>Item</td>
                                                <td>Quantity</td>
                                                <td>Amount</td>
                                                <td>Total Amount</td>
                                                {{-- <td>Action</td> --}}
                                             </tr>
                                        </thead> 
                                        <tbody id="bills">  
                                            @foreach($billsDetail as $bill)
                                            <tr>
                                            <td style="display: none"><input  name="billId[]" value="{{$bill->id}}"/></td>
                                                    <td>
                                                    <select  class="form-control" name="billItem[]">
                                                        @foreach($getAllItemsF as $item)
                                                            <option value="{{$item->id}}" {{($item->id === $bill->item_id) ? 'selected="selected"':''}} >{{$item->item_name}} </option> 
                                                        @endforeach
                                                    </select> 
                                                    <td><input    type="text" name="quantity[]" class="form-control" value="{{$bill->quantity}}"/></td>
                                                    <td><input    type="text" name="amount[]" class="form-control" value="{{$bill->price}}"/></td>
                                                    <td><input    type="text" name="amount[]" class="form-control" value="{{$bill->price*$bill->quantity}}"/></td>
                                                    
                                                    {{-- <td>{{$bill->price*$bill->quantity}}</td> --}}


                                                {{-- <td><button type="button"  class="btn btn-danger remove-bill-item" data-token="{{csrf_token()}}" data-href="{{route('account.deletebillitem', ['id' => $bill->id])}}">Remove</button></td>
                                            --}}
                                           
                                            </tr>   
                                            @endforeach  
                                                <tr class="new-item" style="display: none">
                                                        <td style="display: none"><input  class="bill-id"/></td>
                                                        <td> 
                                                            <select class="bill-item form-control"   >
                                                        @foreach($getAllItemsF as $item)
                                                        <option value="{{$item->id}}">{{$item->item_name}}</option>
                                                        @endforeach
                                                        </select> </td>
                                                        <td><input class="form-control quantity"  placeholder="Item Quantity"></td>
                                                        <td><input class="form-control amount" placeholder="Item Amount"></td>
                                                        <td> </td>

                                                        <td><button type="button" class="btn btn-danger remove" onclick="$(this).parents()[1].remove()" >Remove</button></td>
                                   

                                                    {{-- <td><button type="button" class="btn btn-danger remove" >Remove</button></td>
                                               --}}
                                                </tr>   
                                                 
                                                <tr id="one-item" style="display: none">
                                                    <td>Please <a href="" class="addSales">Add </a>atleast one item  </td>
                                                </tr>
                                               
                                                @empty($billsDetail->count())
                                                <tr class="no-records" >
                                                        <td>No Records</td>
                                                </tr>
                                                @endempty
                                             </tbody> 
                                             <tbody class="sales_row" > 
                                                   
                                            </tbody>  
                                    </table>
                                    
                                      {{-- PREVENTING EDIT OF BILL FOR NOW COMMENTING ADDING OF MORE ITEM
                                    <button type="button" class="btn btn-primary addSales" id="addSales">Add Item</button> 
                               --}}
                                   
                                </div>
                                </div>
                                <div id="payments" class="container tab-pane fade"><br>
                                    <div class="table-responsive">
                                            <table class="table table-responsive" id="sales-table">
                                                    
                                                        <tr>
                                                            <td>Payment Date</td>
                                                            <td>Payment Method</td>
                                                            <td>Amount</td>  
                                                        </tr>
                                                  
                                                    <tbody id="sales-log"> 
                                                        @isset($payments)
                                                         @foreach($payments as $payment)
                                                            <tr> 
                                                                <td>{{\Carbon\Carbon::parse($payment->date_paid)->format('jS \o\f F, Y')}}</td>
                                                                <td>{{$payment->mode_of_payment}}</td>
                                                                <td>{{$payment->amount_paid}}</td>

                                                            {{-- <td><button type="button"  class="btn btn-danger delete-payment" data-href="{{route('account.deletebillpayment', ['id' => $payment->id])}}"  data-token="{{ csrf_token() }}"> Delete</button></td> 
                                                            --}}
                                                        </tr>
                                                         @endforeach
                                                         @endisset
                                                         <tr id="norecords" style="display: none">
                                                                <td>No Records</td>
                                                            </tr>
                                                         @empty($payments->count()) 
                                                            <tr>
                                                                <td>No Records</td>
                                                            </tr>
                                                        @endempty
                                                    </tbody>
                                                </table>
                                    </div>
                                </div>
                                <div class="row form-group">
                                        <div class="col-4">
                                        </div> 
                                        <div class="col-4">

{{--                                             
                                           PREVENTING EDIT OF BILLS NOW
                                            <button type="submit"   class="form-control biill-save-btn" id="savebtn">Save</button>  
                                        --}}
                                       
                                        </div>
                                    </div>
                            </div>
                            </div>
                            
                         
                    </form>
                </div>


  
      <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <label > Are you sure you want to delete item?</label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-primary">Yes</button>
            </div>
          </div>
        </div>
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