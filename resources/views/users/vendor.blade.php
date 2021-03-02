@extends('users/layouts.vendormaster')

@section('vendor')


<article class="content forms-page">
            <div class="title-block">
            	<div class="title">
				    <button type="button" class="btn btn-primary" id="btnadd" data-toggle="modal" data-target="#addVendor">Add Creditor</button>
                    
				</div>  
                <h3 class="title"> List of credtiors</h3>

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
                                                    <th>Date Created</th>
                                                    <th>Name </th>
                                                    <th>Contact</th>
                                                    <th>Email</th>
                                                    <!-- <th>Location</th> -->
                                                    {{-- <th>Action</th>        --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($vendors as $vendor)
                                                <tr>
                                                    <td>{{\Carbon\Carbon::parse($vendor->created_at)->format('jS \o\f F, Y')}}</td>
                                                    <td>{{$vendor->name}}</td>
                                                    <td>{{$vendor->contact}}</td>
                                                    <td>{{$vendor->email}}</td>
                                                    <!-- <td>{{$vendor->location}}</td> -->

                                                    {{-- <td>
                                                         
                                                        <button class="btn btn-info">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td> --}}

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



 <!-- ADD P MODAL -->
    <div class="modal fade" id="addVendor" tabindex="-1" role="dialog" aria-labelledby="addVendor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <section class="section">
                <div class="col-md-12">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Creditor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-content">
                        <div class="card card-block sameheight-item">
                            <form method="POST" action="{{route('account.vendor')}}">
                                {{csrf_field()}} 
                                <div class="row form-group">
                                    <div class="col-7">
                                        <div class="form-group row">
                                            <label class="col-sm-5 form-control-label">Name of Creditor <label style="color: red;">*</label></label>
                                            <div class="col-sm-7">
                                                <input required type="text" name="name" class="form-control" id="" placeholder="Creditor's name"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group row">
                                            <label {{-- for="inputEmail3" --}} class="col-sm-4 form-control-label">Contact<label style="color: red;">*</label></label>
                                            <div class="col-sm-8">
                                                <input type="number" name="contact" class="form-control" id="" placeholder="024XXXXXXXX"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-7">
                                        <div class="form-group row">
                                            <label class="col-sm-5 form-control-label">Location<label style="color: red;">*</label></label>
                                            <div class="col-sm-7">
                                                <input required type="text"  name="location" class="form-control" id="" placeholder="Enter Creditor's location"> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-5">
                                        <div class="form-group row">
                                            <label class="col-sm-4 form-control-label">Email<label style="color: red;">*</label></label>
                                            <div class="col-sm-8">
                                                <input  type="text"  name="email" class="form-control" id="" placeholder="Creditor@example.com"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-7">
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-5 form-control-label">Address</label>
                                            <div class="col-sm-7">
                                                <input required type="text"  name="address" class="form-control" id="" placeholder="Enter Creditor's address"> 
                                            </div>
                                        </div>

                                    </div> 
                                </div>

                                <div class="row form-group">
                                    <div class="col-7"> 
                                       <div class="form-group row">
                                            <label class="col-sm-5 form-control-label">Country</label>
                                            <div class="col-sm-7">
                                                <input required type="text"  name="country" class="form-control" id="" placeholder="Enter Creditor's country"> 
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
@endsection