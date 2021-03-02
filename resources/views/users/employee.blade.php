@extends('users/layouts.employeemaster') 
@section('employee')
<article class="content forms-page">
    <div class="title-block">
        <!-- @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif -->
        <div class="title">
            <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#addEmployee">Add Employee</button>
        </div>
        <h3 class="title"> List of farm employees</h3>

      
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
                                            <th>Name </th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Employment Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                         <tr id="{{$employee->id}}">
                                            <td>{{$employee->created_at}}</td>
                                            <td>{{$employee->last_name}} {{$employee->first_name}}</td>
                                            <td>{{$employee->primary_contact}}<br>{{$employee->secondary_contact}}</td>
                                            <td>{{$employee->email}}</td>
                                            <td>{{$employee->employment_type}}</td>
                                            <td>
                                                <button class="btn btn-success">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            <button class="btn btn-info edit-employee" data-firstname="{{$employee->first_name}}" 
                                                data-lastname="{{$employee->last_name}}" data-region="{{$employee->region}}" data-primarycontact="{{$employee->primary_contact}}"
                                                data-secondarycontact="{{$employee->secondary_contact}}" data-toggle="modal" data-target="#editEmployee"
                                                data-email="{{$employee->email}}"  data-residence="{{$employee->residence}}"
                                                 data-salary="{{$employee->salary}}" data-employmenttype="{{$employee->employment_type}}" data-href="{{route('account.updateemployee',['id'=>$employee->id])}}">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button href="" class=" btn btn-danger delete-employee"  data-id="{{$employee->id}}"
                                                data-href="{{route('account.deleteemployee', ['id'=>$employee->id])}}" data-toggle="modal" data-target="#deleteCustomerModal" data-token="{{csrf_token()}}">
                                                    <i class="fa fa-trash"></i>
                                            </button>
                                            </td>
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
                    <h4 class="modal-title" id="modelTitleId">Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-content">
                    <div class="card card-block sameheight-item">
                        <form method="POST" id="employeeForm" action="{{route('account.employee')}}">
                            {{csrf_field()}}
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">FirstName<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input name="first_name" required type="text" class="form-control" placeholder="First name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">LastName<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input name="last_name" required type="text" class="form-control" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Contact<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input name="primary_contact" required type="number" class="form-control" placeholder="024XXXXXXXX">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=" row">
                                        <label class="col-sm-4 form-control-label">Contact</label>
                                        <div class="col-sm-8">
                                            <input name="secondary_contact" type="number" class="form-control" placeholder="024XXXXXXXX">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Email <label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input name="email" required type="text" class="form-control" placeholder="employee@example.com">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Residence<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input name="residence" required type="text" class="form-control" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Position<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <input name="employment_type" type="text" class="form-control" placeholder="Enter employment type">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-sm-4 form-control-label">Region<label style="color: red;">*</label></label>
                                        <div class="col-sm-8">
                                            <select name="region" class="form-control" required>
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
                                            <input name="salary" type="text" class="form-control" placeholder="Enter employee's salary">
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
