@extends('users/layouts.viewbillmaster') 
@section('billview')

<article class="content forms-page">
    <div class="title-block">
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        @if(Session::has('messagefailed'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('messagefailed') }}</p>
        @endif

        
        @if(Session::has('delete'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('delete') }}</p>
        @endif
        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd">Add Records</button>
        </div>
        <h3 class="title"> Credit Records</h3>

    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div class="card-title-block">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select id="vendor" class="form-control">
                                                        <option>Select Creditor</option>
                                                            @foreach($vendors as $vendor)
                                                            <option>{{$vendor->name}}</option>
                                                            @endforeach
                                                    </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        {{-- <input type="text" class="form-control" id="passenger_dob" placeholder="From"> --}}
                                    </div>

                                    <div class="col-3">
                                        {{-- <input type="text" class="form-control" placeholder="To"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nav tabs -->
                        <div class="container mt-3">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a style="text-decoration: none;" class="nav-link active" data-toggle="tab" href="#bills">Bills</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="bills" class="container tab-pane active"><br>
                                    <div class="table-responsive">
                                        <table id="dataTable" class="billstable table table-hover" rules="rows">
                                            <thead>
                                                <tr>
                                                    <th>Creditor Info</th>
                                                    <th>Invoice Number</th>
                                                    <th>Amount Left</th>
                                                    <th>Amount Paid</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bills as $bill)
                                                <tr id="{{$bill->id}}" class="billstablerow">
                                                    <td>
                                                        {{$bill->vendor->name}}<br/> {{$bill->vendor->contact}}
                                                        <br/> {{$bill->vendor->email}} 
                                                        <br/> {{$bill->vendor->id}}
                                                        <br/> {{$bill->date_issued}}
                                                    </td>
                                                    <td>{{$bill->invoice_number}}</td>
                                                    <td>{{$bill->farm_payables_details->sum('total_amount')-$bill->farm_payable_payments->sum('amount_paid')}}</td>
                                                    <td>{{$bill->farm_payable_payments->sum('amount_paid')}}</td>
                                                    <td>
                                                        <button class="make-payment btn btn-success" data-href="{{route('account.billpayment', ['id' => $bill->id])}}" data-amounttopay="{{$bill->farm_payables_details->sum('total_amount')-$bill->farm_payable_payments->sum('amount_paid')}}"
                                                        data-toggle="modal" data-target="#addBranch" data-vendorid="{{$bill->vendor->id}}">
                                                                    <i class="fa fa-money"></i>
                                                                </button>
                                                        <button class="edit-bills btn btn-info" data-href="{{route('account.viewbilldetails', ['id' => $bill->id])}}">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>

                                                        {{-- <button class="remove delete-bill btn btn-danger" data-id="{{$bill->id}}" data-token="{{csrf_token()}}" data-href="{{route('account.deletebill', ['id' => $bill->id])}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button> --}}

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<!-- ADD PAYMENT MODAL -->
<div class="modal fade" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="addBranch" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form id="paymentForm" role="form" method="POST" action="{{route('account.viewbills')}}">
                            {{csrf_field()}}
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Amount to Pay</label>
                                        <div class="col-sm-7">
                                            <input name="amount" readonly type="number" class="form-control amount-to-pay" placeholder="0.00">
                                      
                                        </div>
                                        <input id="vendorid" name="vendorid" type="hidden" class="form-control amount-to-pay" placeholder="vendor id">
                                      

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Batch</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <select required name="batchId" class="form-control">
                                                            
                                                           @foreach($batchCycles as $batch)
                                                            <option>{{$batch->batch_id}}</option>
                                                           @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Receipt Number</label>
                                        <div class="col-sm-7">
                                            <input name="paymentCode" required type="number" class="form-control" id="" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Date</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input name="datePaid" required class="form-control example1" id="" autocomplete="off" placeholder="yyyy-mm-dd">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Mode of Payment</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <select required name="modeOfPayment" class="form-control" id="modepay" onchange="changeForm(this.value);">
                                                            <option></option>
                                                            <option value="cash">Cash</option>
                                                            <option value="cheque">Cheque</option>
                                                            <option value="momo">Mobile Money</option>
                                                            {{-- <option></option> --}}
                                                        </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Description</label>
                                        <div class="col-sm-7">
                                            <textarea name="description" required rows="3" class="form-control" id="formGroupExampleInput7"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="banktrans" style="display: none;">
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Cheque Number</label>
                                            <div class="col-sm-7">
                                                <input name="chequeNumber" type="number" class="form-control" id="" placeholder="Enter Cheque Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Bank Name</label>
                                            <div class="col-sm-7">
                                                <input name="bankName" type="text" class="form-control" id="" placeholder="Enter Bank's Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Date on Cheque</label>
                                            <div class="col-sm-7">
                                                <input name="dateOnCheque" autocomplete="off" type="text" class="form-control example1" id="" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="momotrans" style="display: none;">
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Transaction ID</label>
                                            <div class="col-sm-7">
                                                <input type="transactionId" class="form-control" id="" placeholder="Enter Transaction ID">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Vendor's Name</label>
                                            <div class="col-sm-7">
                                                <input type="vendorName" class="form-control" id="" placeholder="Enter Vendor's Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Operator Type</label>
                                            <div class="col-sm-7">
                                                <select name="operatorType" class="form-control">
 
                                                        <option>MTN MOBILE MONEY</option>
                                                        <option>AIRTELTIGO</option>
                                                        <option>VODAFONE CASH</option>
                                                        
                                                    </select>
                                            </div>
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


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Bill deleted successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
<script>
    // add a new post
        $(document).on('click', '#edit', function() { 
                console.log("HI");
                var id =    $(this).data('id');
                var url  = '{{route('account.billpayment')}}'+'/'+id;
                console.log(url);
                $('#paymentForm').attr("action", url);
                });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- <script src="{{url('/')}}/assestdash/js/app.js"></script> --}}
<script src="{{url('/')}}/assestdash/js/custom.js"></script>

<script>
    function changeForm(val)   
{   
   
    if(val=='cash')   
    {   
        document.getElementById("banktrans").style.display = 'none';
         document.getElementById("momotrans").style.display = 'none';
   
    }   
    else if (val=='cheque')   
    {   
     
        document.getElementById("banktrans").style.display = 'block';
        document.getElementById("momotrans").style.display = 'none';   
          
    }
    else if (val=='momo')   
    {   
        
        document.getElementById("momotrans").style.display = 'block';
        document.getElementById("banktrans").style.display = 'none';   
          
    }
    else{
         document.getElementById("banktrans").style.display = 'none';
         document.getElementById("momotrans").style.display = 'none'

    }
    document.getElementById("payment").onclick = function(){
            console.log("HIs")
    };
   
   
}   



    document.getElementById("btnadd").onclick = function () {
        location.href = "{{url('account/createbillrecords')}}";
    };

</script>
@endsection