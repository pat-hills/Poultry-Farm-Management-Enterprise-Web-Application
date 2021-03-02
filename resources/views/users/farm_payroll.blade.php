@extends('users/layouts.farm_payroll_master') 
@section('payroll')
<article class="content forms-page">
<div class="title-block">
    <h3 class="title"> Payoll</h3>      
</div>

        <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <!-- Nav tabs -->
                        <div class="container mt-3">
                            <!-- <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a style="text-decoration: none;" class="nav-link active" data-toggle="tab" href="#bills">Payroll</a>
                                </li>
                            </ul> -->

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="bills" class="container tab-pane active"><br>
                                
                                    <div class="table-responsive">
                                        <table class="payrollTable table1 table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Add<br><button class="text-right btnall" id="check_all">All</button></th>
                                                    <th>Employee Name</th> 
                                                    <th>Amount To Be Paid</th>
                                                    <th>Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="checkbox" name="vehicle"></td>
                                                    <td>Kwame Asante</td>
                                                    <td>
                                                        <input type="number" class="form-control" id="" value="5000" style="width:200px;">
                                                    </td>
                                                    <td>Active</td> 
                                                </tr> 
                                                <tr>
                                                    <td><input type="checkbox" name="vehicle"></td>
                                                    <td>Kwame Asante</td>
                                                    <td><input type="number" class="form-control" id="" value="5000" style="width:200px;"> </td>
                                                    <td>Active</td> 

            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <!-- Nav tabs -->
                                <div class="container mt-3">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a style="text-decoration: none;" class="nav-link active" data-toggle="tab" href="#bills">Payroll</a>
                                        </li>
                                    </ul>
            
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="bills" class="container tab-pane active"><br>
                                            <div class="table-responsive">
                                            <form method="POST" action="{{route('account.payroll')}}">
                                                    {{csrf_field()}}
                                                <table class="payrollTable table1 table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Employee Name</th> 
                                                            <th>Amount To Be Paid</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($employees as $employee)
                                                        <tr class="">
                                                        <td style="display: none"><input name="employeeid[]"  value="{{$employee->id}}" /></td>
                                                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                                                        <td><input name="amount[]" type="number" class="form-control" id="" value="{{$employee->salary}}"> </td>
                                                            <td>Active</td> 
                                                            <td>
                                                                <button class="make-payment btn btn-success">
                                                                    <i class="fa fa-money"></i>
                                                                </button>
                                                        </tr>  
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="text-right">
                                                    <button class="text-right btn btn-primary" data-toggle="modal" data-target="#payment">Pay Salary</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>   
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

<!-- Modal -->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Total Amount to be paid: </p>
                <p>You are making payment to 25 employees</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" data-dismiss="modal" data-token="{{csrf_token()}}" class="delete-customer btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script></script>
<script>
    $('#check_all').click(function() {
        $('input[name=vehicle]').prop('checked', true);
    });

    $('#check_all').click(function() {
        $('input[name=vehicle]').prop('checked', false);
    });

</script>

@endsection