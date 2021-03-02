@extends('users/layouts.trialbalancemaster')



@section('trialbalance')

<article class="content dashboard-page">
        <div class="title-block">
                <div class="title">
                   
                </div>
                <h3 class="title">Trial balance account of farm</h3>
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
                                <h3 class="title"> {{Auth::user()->name}}'s farm, Trial balance account</h3>
                            </div>
                            <ul class="nav nav-tabs pull-right" role="tablist">
{{-- 
                                <li class="nav-item">
                                    <a class="nav-link" href="#Today" role="tab" data-toggle="tab">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Weekly" role="tab" data-toggle="tab">Weekly</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="#Monthly" role="tab" data-toggle="tab">Monthly</a>
                                    </li> --}}

                                    
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
    {{-- <p class="title-description"> Income </p>   --}}
 
    <div class="table-responsive">
        <table class="payrollTable table1 table-hover">
            <thead>
                <tr>
                    <th>Account name</th> 
                    <th>CR</th>
                    <th>DR</th>
                    <th>BAL</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($getAllAccountsOfFarmFromJournal as $pen) 
                                   
                <tr>
                   
                    <td> {{$pen->acc_name }} </td>
                    <td> {{number_format($pen->SUMCREDIT, 2, ".", ",")}} </td>
                    <td>{{number_format($pen->SUMDEBIT, 2, ".", ",")  }} </td>
                    <td>{{number_format($pen->SUMBAL, 2, ".", ",")}} </td>
                    
                </tr>
                 @endforeach
                <tr>
                   
                    <td> Farm sales account </td>
                    <td> {{number_format($bb, 2, ".", ",")}}  </td>
                    <td>   </td>
                    
                </tr>


             


 

                <tr>
                   
                    <td> Farm payables account </td>
                    <td>  {{number_format($aa, 2, ".", ",")}}  </td>
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
      

@endsection