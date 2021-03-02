@extends('users/layouts.invoicemaster') 
@section('invoice')

<article class="content forms-page" style="margin-right: 40px; margin-left: 40px;">
	<div class="title-block">
		@if(Session::has('message'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
		@endif
		<h3 class="title"> New Sale</h3>
	</div>
	<form method="Post" action="{{route('account.addSales')}}">
		{{csrf_field()}}
		<div class="col-lg-12">
			<div class="card">
				<div class="card-block">
					<div class="row form-group">

						<div class="col-md-4" {{-- style="float: right;" --}}>

							<label class="form-control-label">Invoice #</label>

							<input required type="number " name="invoiceNumber" class="form-control" placeholder="Invoice  number" value="{{$invoiceNumber}}">

						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<label class=" form-control-label">Sales Date</label>
								<div>
									<input autocomplete="off" value="{{old('salesDate')}}" required name="salesDate" class="form-control example1" placeholder="Sales Date">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="form-control-label">Payment Due</label>
								<div>
									<input autocomplete="off" required type="text" value="{{old('paymentDue')}}" name="paymentDue" class="form-control example1" id="" placeholder="dd/mm/yy">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class=" form-control-label">Batch Id</label>
								<div>
									<select required name="batchId" class="form-control" value="{{old('batchId')}}" required>
								<option value=""></option>
									@foreach($batches as $batch)
								<option value="{{$batch->id}}">{{$batch->batch_id}}</option>
					                 @endforeach
					            </select>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<label class="form-control-label">Customer</label>
							<select required name="customer" class="form-control" value="{{old('customer')}}" required> 
								<option value=""></option>
								@if(isset($customers))
									@foreach($customers as $customer)
									<option value="{{$customer->id}}">{{$customer->name}}</option>
									@endforeach
									@endif
							</select>
						</div>
						<div class="col-lg-4">
							<div>
								<label class="form-control-label">Description</label>
								<div>
									<textarea required value="{{old('description')}}" rows="2" name="description" class="form-control"></textarea>
								</div>
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
											<tr>
												<td>
													<select required name="billItem[]" class="form-control">
											<option value="">   </option>
											@foreach($items as $item)
												<option value="{{$item->id}}">{{$item->item_name}}</option>
											 @endforeach
										</select>
												</td>
												<td><input autocomplete="off" value="{{old('quantity[]')}}" min="0" type="decimal" name="quantity[]" class="form-control" required placeholder="Item Quantity"></td>
												<td><input autocomplete="off" value="{{old('amount[]')}}" min="0" type="decimal" name="amount[]" class="form-control" required placeholder="Item Amount"></td>
												<td></td>
											</tr>
										</thead>
										<tr class="new-item" style="display: none">
											<td style="display: none"><input class="bill-id" /></td>
											<td>
												<select class="bill-item form-control" value="{{old('billItem[]')}}">
										@foreach($items as $item)
										<option value="{{$item->id}}">{{$item->item_name}}</option>
										@endforeach
										</select> </td>
											<td><input autocomplete="off" value="{{old('quantity[]')}}" class="form-control quantity" type="decimal" placeholder="Item Quantity"></td>
											<td><input autocomplete="off" value="{{old('amount[]')}}" class="form-control amount" type="decimal" placeholder="Item Amount"></td>
											<td> </td>
											<td><button type="button" class="btn btn-danger remove" onclick="$(this).parents()[1].remove()">Remove</button></td>
										</tr>

										<tbody class="sales_row">

										</tbody>
									</table>
									<button type="button" class="btn btn-primary addSales" id="addSales">Add Item</button>
								</div>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-4">
						</div>
						<div class="col-4">
							<button type="submit" class="btn btn-danger form-control" id="savebtn">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
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