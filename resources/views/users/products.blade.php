@extends('users/layouts.prodmaster')

@section('product')

<article class="content forms-page">
        <div class="title-block">
            <div class="title">
                <button type="button" data-href="" data-token="{{csrf_token()}}" data-toggle="modal" data-target="#addItem"
                    class="set-additem-url btn btn-primary" id="btnadd">Add Product</button>
            </div>
            <h3 class="title"> Products</h3>
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
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                {{-- <th>Type</th> --}}
                                                <th>Type</th>
                                              
                                                <th>Active</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
 
                                            @foreach($farmItems as $item)

                                            <tr id="{{$item->id}}">
                                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('jS \o\f F, Y')}}</td> 
                                                <td>{{$item->item_name}}</td>
                                                <td>{{$item->price}}</td>
                                                {{-- <td>{{$item->expense_category}}</td> --}}
                                                <td>{{$item->item_category}}</td>
                                             
                                                
                                                <td>{{$item->active}}</td>
    
                                              {{-- <td>
                                                     
                                                    <button class="update-item btn btn-info" data-toggle="modal" data-target="#editItem" data-item="{{$item}}"
                                                        data-href="{{route('account.itemupdate', ['id'=>$item->id])}}">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="delete-billitem-record btn btn-danger" data-id="{{$item->id}}" data-token="{{csrf_token()}}" data-href="{{route('account.deleteBillItem2', ['id'=>$item->id])}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>  --}}
    
    
                                            </tr>
                                            @endforeach
                                             

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
     
    
    <!-- ADD PRODUCT OR SERVICE MODAL -->
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addItem" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <section class="section">
                <div class="col-md-12">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-content">
                        <div class="card card-block sameheight-item">
                            <form method="POST" id="" action="{{route('account.createFarmItem')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Name of product</label>
                                            <div class="col-sm-7">
                                                    <input required autocomplete="off" type="text" id="itemName" name="item_name" class="form-control" id="" placeholder="Enter Item Name">
                                           
                                                {{-- <input autocomplete="off" type="text" value="Sale" id="status_bill_sale" name="status_bill_sale" class="form-control" id="" placeholder="Enter Item Name">
                                            --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Product</label>
                                            <div class="col-sm-7">
                                                <select required id="expenseCategory" name="expense_category" class="form-control">
                                                    <option></option>
                                                    <option value="Product">Product</option>
                                                 <option value="Service">Service</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
    
                                    <div class="col-md-12 col-lg-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Price</label>
                                            <div class="col-sm-7">
                                                <input required autocomplete="off" id="price" type="decimal" name="price" class="form-control" id="" placeholder="0.00">
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-12 col-lg-6" id="prodCat" style="display: none;">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 form-control-label">Farm Product Type</label>
                                            <div class="col-sm-7">
                                                <select required id="" name="item_category" class="form-control">
                                                    {{-- <option></option> --}}
                                                    <option value="Egg">Egg</option>
                                                    <option value="Bird">Bird</option> 
                                                    <option value="Feed Mill">Feed Mill</option>
                                                    <option value="Litter">Litter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-12 col-lg-6">
                                        <div class="row">
                                            <label class="col-sm-5 form-control-label">Description</label>
                                            <div class="col-sm-7">
                                                <fieldset class="form-group">
                                                    <textarea required rows="2" id="description" name="description" class="form-control" id="formGroupExampleInput7"></textarea>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-12 col-lg-6">
                                        <div class="row">
                                            <label class="col-sm-5 form-control-label">Active</label>
                                            <div class="col-sm-7">
                                                    <select id="" name="active" class="form-control">
                                                           
                                                            <option value="YES">YES</option>
                                                            <option value="NO">NO</option> 
                                                        </select>
    
                                                {{-- <input type="radio" name="active" value="YES" checked> Yes<br>
                                                <input type="radio" name="active" value="NO"> No
    
                                                 --}}
                                            </div>
                                        </div>
                                    </div>
    
    
                                    <div class="col-md-12 col-lg-6" id="drugcat" style="display: none;">
                                        <div class="form-group row">
                                            <label class="col-sm-5 form-control-label">Drug Category</label>
                                            <div class="col-sm-7">
                                                <select id="drugCategory" name="drug_category" class="form-control">
                                                    <option></option>
                                                    <option>Drug Cat A</option>
                                                    <option>Drug Cat B</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
    
                                    
                                   
                                    <div id="feedcat" style="display: none;">
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 form-control-label">Feed Category</label>
                                                    <div class="col-sm-7">    
                                                        <select id="feedCategory" name="feed_category" class="form-control">
                                                            <option></option>
                                                            <option value="CAT A"> CAT A </option> 
                                                            <option value="CAT B"> CAT B </option>
                                                            <option value="CAT C"> CAT C </option> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-md-12 col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 form-control-label">Weight</label>
                                                    <div class="col-sm-7">
                                                        <input id="weight" name="weight" type="number" class="form-control" id="" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-md-12 col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 form-control-label">Unit</label>
                                                    <div class="col-sm-7">
                                                        <select id="unit" name="unit_of_measurement" class="form-control">
                                                            <option></option>
                                                            <option>g</option>
                                                            <option>Kg</option>
                                                            <option>Tons</option>
                                                        </select>
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
    
    
    
    
    
    
    
    <!-- ADD PRODUCT OR SERVICE MODAL -->
    <div class="modal fade" id="editItem" tabindex="-1" role="dialog" aria-labelledby="editItem" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <section class="section">
                    <div class="col-md-12">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelTitleId">Edit Product or Service</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-content">
                            <div class="card card-block sameheight-item">
                                <form method="POST" id="" action="{{route('account.createBillItem')}}">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 form-control-label">Name of product or service</label>
                                                <div class="col-sm-7">
                                                    <input autocomplete="off" type="text" id="itemName" name="item_name" class="form-control" id="" placeholder="Enter Item Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 form-control-label">Product or service</label>
                                                <div class="col-sm-7">
                                                    <select id="expenseCategory" name="expense_category" class="form-control">
                                                        <option></option>
                                                        <option value="Product">Product</option>
                                                        <option value="Service">Service</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
        
                                        <div class="col-md-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 form-control-label">Price</label>
                                                <div class="col-sm-7">
                                                    <input id="price" type="number" name="price" class="form-control" id="" placeholder="0.00">
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-md-12 col-lg-6" id="prodCat" style="display: none;">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 form-control-label">Drug or feed</label>
                                                <div class="col-sm-7">
                                                    <select id="" name="item_type" class="form-control">
                                                        <option></option>
                                                        <option value="Feed">Feed</option>
                                                        <option value="Drug">Drug</option> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-md-12 col-lg-6">
                                            <div class="row">
                                                <label class="col-sm-5 form-control-label">Description</label>
                                                <div class="col-sm-7">
                                                    <fieldset class="form-group">
                                                        <textarea rows="2" id="description" name="description" class="form-control" id="formGroupExampleInput7"></textarea>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-md-12 col-lg-6">
                                            <div class="row">
                                                <label class="col-sm-5 form-control-label">Active</label>
                                                <div class="col-sm-7">
                                                        <select id="" name="active" class="form-control">
                                                               
                                                                <option value="YES">YES</option>
                                                                <option value="NO">NO</option> 
                                                            </select>
        
                                                    {{-- <input type="radio" name="active" value="YES" checked> Yes<br>
                                                    <input type="radio" name="active" value="NO"> No
        
                                                     --}}
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
    
    <!---------------------------------- ------------------------------------------->
    <!---------------------------------- ------------------------------------------->
                        <!-- DO NOT ACCEPT THIS CHANGE -->
    <!---------------------------------- ------------------------------------------->
    <!---------------------------------- ------------------------------------------->
    <script>
        $('#expenseCategory').change(function(){
            var expense = $('#expenseCategory').val();
            if (expense == 'Product'){
                $('#prodCat').show();
            }
            else{
                $('feedcat').hide();
                $('#prodCat').hide();
                $('#drugcat').hide();
            }
        });
    
        // var expense = $('#expenseCategory').val();
        // var itemCat = $('#itemCategory').val();
        $('#itemCategory').change(function(){
            var itemCat = $('#itemCategory').val();
            if (itemCat == 'feed'){
                $('#feedcat').show();
                $('#drugcat').hide();
            }
            else if (itemCat == 'drug'){
                $('#drugcat').show();
                $('#feedcat').hide();
            }
            else{
                $('#drugcat').hide();
                $('feedcat').hide();
            }
        });
    
    </script>
    
    
    
    <script>
    
      $(".delete-billitem-record").click(function () {
               var r = confirm("Are you sure you want to delete farm item record?");
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
                               console.log("data " + data);
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
               <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
              
@endsection