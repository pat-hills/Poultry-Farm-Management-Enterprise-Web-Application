@extends('users/layouts.chartsofaccountsmaster') 
@section('chartsofaccounts')
<article class="content forms-page">
    <div class="title-block">
        <!-- @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif -->
        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#addEmployee">Add chart account</button>
        </div>
        <h3 class="title"> List of farm charts of accounts (Add income,expense etc manually)</h3>


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
                                <table id="emplyoyeeTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date Created</th>
                                            {{-- <th>Item Name </th> --}}
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Sub Category</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($chartaccounts as $accs)
                                         <tr id="{{$accs->id}}">
                                                <td>{{\Carbon\Carbon::parse($accs->created_at)->format('jS \o\f F, Y g:ia')}}</td>

                                                {{-- <td>{{$accs->created_at	}}</td> --}}


                                            {{-- <td>{{$accs->item_name}}</td> --}}
                                            <td>{{$accs->acc_name}}</td>
                                            <td>{{$accs->acc_type}}</td>
                                            <td>{{$accs->sub_category}}</td>
{{--                                             
                                        
                                            <td>
                                               
                                            <button class="btn btn-info edit-employee">
                                                    
                                                 <i class="fa fa-pencil"></i>
                                                </button>

                                                <button href="" class=" btn btn-danger delete-employee">
                                                   
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            </td>
 --}}

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







<!-- ADD MODAL -->
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Add Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST"  action="{{route('account.createaccounts')}}">
                            {{csrf_field()}}
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Item name<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input name="item_name" autocomplete="off" required type="text" class="form-control" placeholder="Item name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Item name account<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input name="acc_name" autocomplete="off" required type="text" class="form-control" placeholder="Item name account">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Account type<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                                <select name="acc_type" class="form-control" required>
                                                        <option></option> 
                                                        <option>Income</option>
                                                        <option>Asset</option>
                                                        <option>Equity</option>
                                                        <option>Expense</option>
                                                        <option>Liability</option>
                                                       
                                                                                                 
                                                    </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=" row">
                                        <label class="col-sm-4 form-control-label">Account sub category</label>
                                        <div class="col-sm-8">
                                                <select name="sub_category" class="form-control">
                                                        <option></option>
                                                        @foreach ($chartaccounts as $accc)
                                                
                                                        <option value="{{$accc->acc_name}}">{{$accc->acc_name}}</option>
                                                        @endforeach 
                                                                                            
                                                    </select>
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

<!-- EDIT MODAL -->
<div class="modal fade" id="editEmployee" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <section class="section">
            <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Edit Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" id="editemployeeForm">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">FirstName<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input id="firstName" name="first_name" required type="text" class="form-control" placeholder="First name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">LastName<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input id="lastName" name="last_name" required type="text" class="form-control" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Contact<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input id="primaryContact" name="primary_contact" required type="number" class="form-control" placeholder="024XXXXXXXX">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=" row">
                                        <label class="col-sm-4 form-control-label">Contact</label>
                                        <div class="col-sm-8">
                                            <input id="secondaryContact" name="secondary_contact" type="number" class="form-control" placeholder="024XXXXXXXX">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Email <label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input id="email" name="email" required type="text" class="form-control" placeholder="employee@example.com">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Residence<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input id="residence" name="residence" required type="text" class="form-control" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Position<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input id="employmentType" name="employment_type" type="text" class="form-control" placeholder="Enter employment type">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Region<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <select id="region" name="region" class="form-control" required>
                                                <option>Region</option> 
                                                <option>Upper East</option>
                                                <option>Upper West</option>
                                                <option>Northern</option>
                                                <option>Brong Ahafo</option>
                                                <option>Ashanti</option>
                                                <option>Eastern</option>
                                                <option>Western</option>
                                                <option>Central</option>
                                                <option>Greater Accra</option>
                                                <option>Volta</option>                                          
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Salary<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input id="salary" name="salary" type="text" class="form-control" placeholder="Enter employee's salary">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{url('/')}}/assestdash/js/custom.js"></script>

@endsection
