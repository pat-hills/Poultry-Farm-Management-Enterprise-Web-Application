@extends('users/layouts.invoicemaster') 
@section('invoice')

<article class="content forms-page" style="margin-right: 40px; margin-left: 40px;">
	<div class="title-block">
		<div class="row">
			<div class="col-lg-10 col-md-6 col-sm-6">
				<h3 class="title"> View Sale</h3>
			</div>
			<div class="col-lg-2 col-md-6 col-sm-6 pull-right">

				{{-- <button type="button" class="btn btn-success make-payment" data-href="{{route('account.salespayment', ['id' => $sales->id])}}"
				 data-toggle="modal" data-target="#addPayment" data-amounttopay="{{$sales->sales_details->sum('total_amount')-$sales->farm_payments->sum('amount')}}"
				 class="form-control btn-danger">Add Payment</button>
			 --}}
				</div>

		</div>

	</div>
	<form method="POST" action="{{route('account.salesedit',['id'=>$sales->id])}}">
		{{csrf_field()}}
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<div class="row form-group">
						{{--
						<div class="col-7">
							<button class="col-9" type="button" style="height: 170px;">Add Customer</button>
						</div> --}}

						<div class="col-lg-4" {{-- style="float: right;" --}}>
							<div class="form-group">
								<label class="form-control-label">Invoice #</label>
								<input required type="text" value="{{$sales->invoice_number}}" name="invoiceNumber" class="form-control" placeholder="Invoice  number">
							</div>
						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<label class="form-control-label">Sales Date</label>
								<input required name="salesDate" value="{{\Carbon\Carbon::parse($sales->sales_date)->format('Y-m-d')}}" class="form-control example1"
								 placeholder="Sales Date">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="form-control-label">Payment Due</label>
								<input required type="text" value="{{\Carbon\Carbon::parse($sales->payment_due)->format('Y-m-d')}}" name="paymentDue" class="form-control example1"
								 id="" placeholder="dd/mm/yy">
							</div>
						</div> 
						<div class="col-lg-4">
							<div class="form-group">
								<label class="form-control-label">Batch Id</label>
								<select name="batchId" class="form-control">
									<option >Select BatchId</option> 
									@foreach($batches as $batch)
 										<option value="{{$batch->id}}" {{($batch->id === $sales->batch_id) ? 'selected="selected"':''}}>{{$batch->batch_id}}</option> 
					                 @endforeach
					            </select>
							</div>
						</div>
						<div class="col-lg-4">
							<label class="form-control-label">Customers</label>
							<select name="customer" class="form-control"> 
									<option>All Customer's</option>
									@isset($customers))
										@foreach($customers as $customer)
										<option value="{{$customer->id}}" {{($customer->id === $sales->customer_id) ? 'selected="selected"':''}}>{{$customer->name}}</option>
										@endforeach
									@endisset
								</select>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="col-sm-5 form-control-label">Notes</label>
								<textarea rows="2" name="description" class="form-control"></textarea>
							</div>
						</div>

						{{--
						<div class="container mt-3">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs">
								<li class="nav-item" style="width: 100px;">
									<a style="text-decoration: none;" class="nav-link active" data-toggle="tab" href="#unpaid"></a>
								</li>
							</ul> --}}

							<!-- Tab panes -->
							<div class="tab-content">
								<div id="unpaid" class="container tab-pane active"><br>
									<table class="table table-responsive" id="sales-table">
										<thead>
											<tr>
												<th>Item</th>
												<th>Quantity</th>
												<th>Amount</th>
												<th>Total</th>
												<th></th>
											</tr>
											@foreach($sales->sales_details as $sale)

											<tr>
												<td style="display: none"><input name="itemId[]" value="{{$sale->id}}" /></td>
												<td>
													<select name="billItem[]" class="form-control">
											<option> Pick Item </option>
											@foreach($items as $item)
														<option value="{{$item->id}}" {{($item->id === $sale->item_id) ? 'selected="selected"':''}}>{{$item->item_name}}</option> 
											 @endforeach
										</select>
												</td>
												<td><input type="number" value="{{$sale->quantity}}" name="quantity[]" class="form-control" required placeholder="Item Quantity"></td>
												<td><input type="number" value="{{$sale->amount}}" name="amount[]" class="form-control" required placeholder="Item Amount"></td>
 											  <td><input type="number" value="{{$sale->quantity * $sale->amount}}" name="amount[]" class="form-control" required placeholder="Item Amount"></td>
{{-- 											 
												PREVENTING EDIT OF SALE ITEM
												<td><button type="button" class="btn btn-danger remove-sales-item" data-token="{{csrf_token()}}" data-href="{{route('account.salesitemdelete', ['id' => $sale->id])}}">Remove</button></td>
											 --}}
											
											</tr>
											@endforeach
										</thead>
										<tr class="new-item" style="display: none">
											<td style="display: none"><input class="item-id" /></td>
											<td>
												<select class="bill-item form-control">
										@foreach($items as $item)
										<option value="{{$item->id}}">{{$item->item_name}}</option>
										@endforeach
										</select> </td>
											<td><input class="form-control quantity" type="number" placeholder="Item Quantity"></td>
											<td><input class="form-control amount" type="number" placeholder="Item Amount"></td>
											<td> </td>
											
{{--                                             
											<td><button type="button" class="btn btn-danger remove" onclick="$(this).parents()[1].remove()">Remove</button></td>
										 --}}
										</tr>

										<tbody class="sales_row">

										</tbody>
									</table>
                                       
                                      {{-- PREVENTING EDIT OF SALE BY ADDING ITEM FOR NOW
									<button type="button" class="btn btn-primary add-sales-item" id="addSales">Add Item</button>
								 --}}
								
								</div>
							</div>
						</div>
					</div>
					<div id="payments" class="container tab-pane"><br>
						<div class="table-responsive">
							<table class="table table-responsive" id="sales-table">

								<tr>
									<td>Payment Date</td>
									<td>Payment Method</td>
									<td>Amount</td>
									<td>Receipt #</td>
								</tr>

								<tbody id="sales-log">
									@isset($sales->farm_payments) @foreach($sales->farm_payments as $payment)
									<tr>
										<td>{{\Carbon\Carbon::parse($payment->date_paid)->format('jS \o\f F, Y')}}</td>
										<td>{{$payment->mode_of_payment}}</td>
										<td>{{$payment->amount}}</td>
										<td>{{$payment->receipt}}</td>


										{{-- <td><button type="button" class="btn btn-danger delete-sale-item-payment" data-href="{{route('account.salespaymentdelete', ['id' => $payment->id])}}"
											 data-token="{{ csrf_token() }}"> Delete</button></td>
									
											  --}}
											</tr>
									@endforeach @endisset
									<tr id="norecords" style="display: none">
										<td>No Records</td>
									</tr>
									@empty($sales->farm_payments->count())
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

							{{-- <button type="submit" class="btn btn-danger form-control" id="savebtn">Save</button>
						 --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
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
											<input name="receipt" type="number" class="form-control" id="" placeholder="">
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-5 form-control-label">Date</label>
										<div class="col-sm-7">
											<div class="form-group">
												<input name="datePaid" class="form-control example1" id="" placeholder="Enter batch number">
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
												<select name="modeOfPayment" class="form-control" id="modepay" onchange="changeForm(this.value);">
						      <option>Select Mode of Payment</option>
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
						  <option>Select Operator Type</option>
						  <option>fldls</option>
						  <option>mfdkdo</option>
						  <option>dfmdld</option>
						  <option>nvkejii</option> 
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