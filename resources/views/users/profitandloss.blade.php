@extends('users/layouts.profitandlossmaster')



@section('profitandloss')

 <article class="content dashboard-page">
        <div class="title-block">
                <div class="title">
                   
                </div>
                <h3 class="title">Profit and loss account of farm</h3>
                {{-- <p class="title-description"> List Of Collections. </p> --}}
            </div>

    <section class="section">
        <div class="row sameheight-container">
 

  
    
        </div>
    </section>



    <section class="section">
        <div class="row sameheight-container"> 

            <div class="col col-12 col-sm-12 col-md-6 col-xl-12 stats-col">

 

                                            <section class="section">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-block">  

                                                                <section class="example">  







                
                       
                        <div class="card-header card-header-sm bordered">
                            <div class="header-block">
                                <h3 class="title"> {{Auth::user()->name}}'s farm, profit and loss account</h3>
                            </div>
                            <ul class="nav nav-tabs pull-right" role="tablist">
{{-- 
                                <li class="nav-item">
                                    <a class="nav-link" href="#Today" role="tab" data-toggle="tab">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Weekly" role="tab" data-toggle="tab">Weekly</a>
                                </li>

                                --}}
                                <li class="nav-item">
                                        <a class="nav-link" href="#Selection" role="tab" data-toggle="tab">Date Selection</a>
                                    </li> 

                                    
                                    <li class="nav-item">
                                            <a class="nav-link active" href="#AllTime" role="tab" data-toggle="tab">AllTime</a>
                                        </li>
                            </ul>
                        </div>

              

                            <div class="tab-content">
                                <div role="tabpanel" class="nav-link" id="Today">
                          
                                    <div style="display :none" class="table-responsive">
                                        <table class="payrollTable table1 table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th> 
                                                    <th>Amount</th>
                                                    <th>Date Due</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Kwame Asante</td>
                                                    <td>¢5000</td>
                                                    <td>23/08/18</td>
                                                </tr> 
                                                <tr>
                                                    <td>Joycelyn Danquah</td>
                                                    <td>¢15000</td>
                                                    <td>17/05/18</td>
                                                </tr> 
                                                <tr>
                                                    <td>Ruth Mankatah</td>
                                                    <td>¢23000</td>
                                                    <td>11/02/18</td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="Weekly">
                             
                                    <div class="table-responsive">
                                        <table class="payrollTable table1 table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th> 
                                                    <th>Amount</th>
                                                    <th>Date Due</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Emmanuel Owusu</td>
                                                    <td>¢23000</td>
                                                    <td>16/02/18</td>
                                                </tr> 
                                                <tr>
                                                    <td>Aben Agyekum</td>
                                                    <td>¢5030</td>
                                                    <td>9/11/18</td>
                                                </tr> 
                                                <tr>
                                                    <td>Josh Robinson</td>
                                                    <td>¢21400</td>
                                                    <td>30/6/18</td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="Monthly">
                         
                                        <div class="table-responsive">
                                            <table class="payrollTable table1 table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Customer</th> 
                                                        <th>Amount</th>
                                                        <th>Date Due</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Emmanuel Owusu</td>
                                                        <td>¢23000</td>
                                                        <td>16/02/18</td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Aben Agyekum</td>
                                                        <td>¢5030</td>
                                                        <td>9/11/18</td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Josh Robinson</td>
                                                        <td>¢21400</td>
                                                        <td>30/6/18</td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    <div role="tabpanel" class="tab-pane active fade show" id="AllTime">
    <p class="title-description"> Income </p>  
 
    <div class="table-responsive">
        <table class="payrollTable table1 table-hover">
            <thead>
                <tr>
                    <th>Account name</th> 
                    <th>CR</th>
                    <th>DR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getAllIncomeOfFarmFromJournal as $pen)
                                   
                <tr>
                   
                    <td> {{$pen->acc_name}} </td>
                    <td> {{$pen->SUMCREDIT}} </td>
                    <td>{{$pen->SUMDEBIT}} </td>
                    
                </tr>
                @endforeach
                <tr>
                   
                    <td> Farm sales account </td>
                    <td> 0.00  </td>
                    <td> {{$bb}} </td>
                    
                </tr>


                <tr>
                   
                    <td class="title-description"> Expense </td>
                    <td>   </td>
                    <td>  </td>
                    
                </tr>



                @foreach ($getAllExpenseOfFarmFromJournal as $pene)
                                   
                <tr>
                   
                    <td> {{$pene->acc_name}} </td>
                    <td> {{$pene->SUMCREDITE}} </td>
                    <td>{{$pene->SUMDEBITE}} </td>
                    
                </tr>
                @endforeach

                <tr>
                   
                    <td> Farm payables account </td>
                    <td> {{$aa}}  </td>
                    <td> 0.00 </td>
                    
                </tr>

                <tr>
                   
                    <td> TOTAL INCOME </td>
                    <td> {{$total_income}}  </td>
                    <td>  </td>
                    
                </tr>


                <tr>
                   
                    <td> TOTAL EXPENSE </td>
                    <td> {{$total_expense}}  </td>
                    <td>  </td>
                    
                </tr>

                <tr>
                   
                    <td>  </td>
                    <td>   </td>
                    <td>  </td>
                    
                </tr>

                <tr>
                   
                    <td> NET PROFIT AND LOSS </td>
                    <td> {{$get_balance_paid}}  </td>
                    <td>  </td>
                    
                </tr>
                    
            </tbody>
        </table>
    </div>
</div>





<div role="tabpanel" class="tab-pane fade show" id="Selection">

<div class="center">

        <form method="POST" action="{{route('account.profitandloss')}}" class="mt-5">


        <div class="row form-group">
                <div class="col-4">
                    <div class="row">
                        <label class="col-sm-4 form-control-label">From</label>
                        <div class="col-sm-8">
                            <input required autocomplete="off" type="text" class="form-control example1" name="FromDate" placeholder="dd/mm/yy">
                       
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <label class="col-sm-4 form-control-label">To</label>
                        <div class="col-sm-7">

                                <input required autocomplete="off" type="text" class="form-control example1" name="ToDate" placeholder="dd/mm/yy">
                       
                        </div>
                    </div>
                </div>


                <div class="col-4">
                        <div class="row">
                            
                            <div class="col-sm-7">
    
                                    <input value="SEARCH" type="submit" class="btn btn success" name="dateIssued">
                           
                            </div>
                        </div>
                    </div>
            </div>

        </form>


</div>




    <p class="title-description"> Income </p>  
 
    <div class="table-responsive">
        <table class="payrollTable table1 table-hover">
            <thead>
                <tr>
                    <th>Account name</th> 
                    <th>CR</th>
                    <th>DR</th>
                </tr>
            </thead>
            <tbody>
                    @if(!$getAllIncomeOfFarmFromJournalDateSelect)
                    <tr>
                        <td> No Records </td>
                    </tr>
                    @else
                @foreach ($getAllIncomeOfFarmFromJournalDateSelect as $pen)
                                   
                <tr>
                   
                    <td> {{$pen->acc_name}} </td>
                    <td> {{$pen->SUMCREDIT}} </td>
                    <td>{{$pen->SUMDEBIT}} </td>
                    
                </tr>
                @endforeach @endif


                <tr>
                   
                    <td> Farm sales account </td>
                    <td> 0.00  </td>
                    <td> {{$bb}} </td>
                    
                </tr>


                <tr>
                   
                    <td class="title-description"> Expense </td>
                    <td>   </td>
                    <td>  </td>
                    
                </tr>



                @foreach ($getAllExpenseOfFarmFromJournal as $pene)
                                   
                <tr>
                   
                    <td> {{$pene->acc_name}} </td>
                    <td> {{$pene->SUMCREDITE}} </td>
                    <td>{{$pene->SUMDEBITE}} </td>
                    
                </tr>
                @endforeach

                <tr>
                   
                    <td> Farm payables account </td>
                    <td> {{$aa}}  </td>
                    <td> 0.00 </td>
                    
                </tr>

                <tr>
                   
                    <td> TOTAL INCOME </td>
                    <td> {{$total_income}}  </td>
                    <td>  </td>
                    
                </tr>


                <tr>
                   
                    <td> TOTAL EXPENSE </td>
                    <td> {{$total_expense}}  </td>
                    <td>  </td>
                    
                </tr>

                <tr>
                   
                    <td>  </td>
                    <td>   </td>
                    <td>  </td>
                    
                </tr>

                <tr>
                   
                    <td> NET PROFIT AND LOSS </td>
                    <td> {{$get_balance_paid}}  </td>
                    <td>  </td>
                    
                </tr>
                    
            </tbody>
        </table>
    </div>
</div>


                            </div>

 



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>  


            </div> 

        

        </div>
    </section>


 

 
 </article>



 <link rel="stylesheet" href="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.css')}}">
 {{-- <script src="{{ URL::to('vendor/jquery/jquery.min.js') }}"></script>
 <script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ URL::to('vendor/jquery/bootstrap.min.js')}}"></script>  --}}
 <script src="{{ URL::to('vendor/jquery/bootstrap-datepicker.min.js')}}"></script> 


 <script>



 $(document).ready(function () {
                
                $('.example1').datepicker({
                    // format: 'yyyy-mm-dd hh:ii'
                    format: "yyyy-mm-dd",
                    showDropdowns: true
                });  
            
            });

 </script>     



@endsection