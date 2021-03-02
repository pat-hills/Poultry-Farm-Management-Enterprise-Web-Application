@extends('users/layouts.salesmaster') 
@section('sales')
<article class="content forms-page">
    <div class="title-block">
            

        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        
        
        @if(Session::has('messagefailedduplicate'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('messagefailedduplicate') }}</p>
        @endif
        



        @if(Session::has('messagefailed'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('messagefailed') }}</p>
        @endif
        

        @if(Session::has('messagefailedempty'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('messagefailedempty') }}</p>
        @endif


        @if(Session::has('messagefailedpayment'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('messagefailedpayment') }}</p>
        @endif

        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd">Add Sales</button>
        </div>
        <h3 class="title"> Sales</h3>
        {{--
        <p class="title-description"> ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, </p> --}}
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="table-responsive">
                    <table class="" style="width: 100%;">
                        <tr>
                            <th>Outstanding Amount</th>
                            <th>Payments Today</th>
                            <th>Total Sales UnPaid</th>
                        </tr>

                        <tr>
                            <td>GHS {{$unpaidSum}}</td>
                            <td>GHS {{$paymentsToday}}</td>
                            <td>{{count($unpaidSales)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="col-md-12">
                    <div class="row form-group">
                        <div class="col-3">
                            <div class="form-group">
                                <select name="customer" class="form-control"> 
                                    <option>All Customer's</option>
                                    @if(isset($customers))
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                {{-- <select class="form-control">
                                    <option>Status</option>
                                    <option>Paid</option>
                                    <option>Partial</option>
                                    <option>Unpaid</option>
                                </select> --}}
                            </div>
                        </div>

                        <div class="col-3">

                            {{-- <input type="text" id="min" name="dateFrom" class="form-control" placeholder="From">
                        --}}
                        </div>
                        <div class="col-3">

                            {{-- <input type="text" id="max" name="dateTo" class="form-control" placeholder="To">
                             --}}
                        </div>
                    </div>
                </div>


                <div class="container mt-3">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a style="text-decoration: none;" class="nav-link active" data-toggle="tab" href="#unpaid">Unpaid</a>
                        </li>
                        <li class="nav-item">
                            <a style="text-decoration: none;" class="nav-link" data-toggle="tab" href="#paid">Paid</a>
                        </li>
                        <li class="nav-item">
                            <a style="text-decoration: none;" class="nav-link" data-toggle="tab" href="#all">All Sales</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="unpaid" class="container tab-pane active"><br>
                            <div class="table-responsive">
                                <table class="" rules="" style="width: 100%;">
                                    <tr>
                                        <th>Sales Info</th>
                                        {{-- <th>Expected Days to Pay</th> --}}
                                        {{-- <th>Days Overdue</th> --}}
                                        <th>Amount left</th>
                                      <th>Action</th> 
                                    </tr>
                                    @if(isset($unpaidSales)) @foreach($unpaidSales as $sale)
                                    <tr>
                                        <td>{{$sale->customer->name}}<br>{{$sale->created_at}} <br><br> </td>
                                        {{-- <td>3(days time)</td> --}}
                                        {{-- <td>2</td> --}}
                                        <td>{{$sale->sales_details->sum('total_amount')-$sale->farm_payments->sum('amount')}}</td>
                                        <td>




                                                <a href="" class="make-payment btn btn-success" data-href="{{route('account.salespayment', ['id' => $sale->id])}}" data-toggle="modal" data-target="#addPayment"
                                                        data-amounttopay="{{$sale->sales_details->sum('total_amount')-$sale->farm_payments->sum('amount')}}">
                                                        
                                                        <i class="fa fa-money"></i>
                                                    
                                                    </a>

                                            <a href="{{route('account.salesedit',['id'=>$sale->id])}}" class="make-payment btn btn-info">

                                              <i class="fa fa-pencil"></i>
                                            
                                            </a>
                                           

                                            {{-- <a href="" data-token="{{csrf_token()}}" class="delete-sales btn btn-danger" data-href="{{route('account.salesdelete', ['id' => $sale->id])}}">
                                                
                                                    <i class="fa fa-trash"></i>
                                            
                                            </a> --}}

                                        </td>
                                    </tr>
                                    @endforeach @else
                                    <label>No Records </label> @endif
                                </table>
                            </div>
                        </div>
                        <div id="paid" class="container tab-pane fade"><br>
                            <div class="table-responsive">
                                <table class="" rules="" style="width: 100%;">
                                    <tr>
                                        <th>Sales Info</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Amount</th>
                                        <th>Date Paid</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    @isset($paidSales) @foreach($paidSales as $sale)
                                    <tr>
                                        <td>{{$sale->customer->name}} <br> {{$sale->created_at}} <br><br> </td>
                                        {{-- <td>3(days time)</td> --}}
                                        <td>{{$sale->sales_details->sum('total_amount')}}</td>
                                        <td>{{$sale->farm_payments[0]->date_paid}}</td>
                                        <td></td>
                                        @endforeach @endisset @empty(count($paidSales))
                                        <td> <label>No Records </label></td>
                                        @endempty
                                </table>
                            </div>
                        </div>
                        <div id="all" class="container tab-pane fade"><br>
                            <div class="table-responsive">
                                <table class="" rules="" style="width: 100%;">
                                    <tr>
                                        <th>Sales Info</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Status</th>
                                        <th>Amt Remain</th>
                                        <th>Issue Date</th>
                                        <th>Due Date</th>
                                    </tr>
                                    @isset($allsales) @foreach($allsales as $sale)
                                    <tr>
                                        <td>{{$sale->customer->name}} <br> {{$sale->created_at}} <br><br> </td>
                                        {{-- <td>3(days time)</td> --}}
                                        <td>{{$sale->status}}</td>
                                        <td>{{$sale->sales_details->sum('total_amount')-$sale->farm_payments->sum('amount')}}</td>
                                        <td>{{\Carbon\Carbon::parse($sale->sales_date)->format('jS \o\f F, Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($sale->payment_due)->format('jS \o\f F, Y')}}</td>
                                    </tr>
                                    @endforeach @endisset @empty(count($allsales))
                                    <td><label>No Records</label></td>
                                    @endempty
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</article>

<!-- ADD PAYMENT MODAL -->
<div class="modal fade" id="addPayment" tabindex="-1" role="dialog" aria-labelledby="addBranch" aria-hidden="true">
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
                        <form id="paymentForm" role="form" method="POST">
                            {{csrf_field()}}
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Amount to Pay</label>
                                        <div class="col-sm-7">
                                            <input name="amount" type="number" class="form-control amount-to-pay" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Receipt Number</label>
                                        <div class="col-sm-7">
                                            <input name="receipt" readonly type="number" class="form-control" id="" placeholder="" value="{{$receipt}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 form-control-label">Date</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input autocomplete="off" name="datePaid" class="form-control example1" id="" placeholder="YYYY/MM/DD">
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
                                            <textarea name="description" rows="3" class="form-control" id="formGroupExampleInput7"></textarea>
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
                                                <input name="dateOnCheque" type="text" class="form-control" id="" placeholder="">
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
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Operator Type</label>
                                            <div class="col-sm-7">
                                                <select name="operatorType" class="form-control">
                                                        <option></option>
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


<script src="{{url('/')}}/assestdash/js/custom.js"></script>
<script src="{{url('/')}}/cdn.datatables.net/plug-ins/1.10.19/filtering/row-based/range_dates.js"></script>


<link rel="stylesheet" href="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.css')}}">

<script src="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.js')}}"></script> 


<script type="text/javascript">


   
//delete a sale
$(".delete-sales").click(function (e) {
    e.preventDefault();
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
                   // alert(data);
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
        location.href = "{{url('account/addinvoice')}}";
    };

</script>
@endsection