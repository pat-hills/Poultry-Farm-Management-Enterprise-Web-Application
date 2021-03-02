@extends('users/layouts.dashmaster')


@section('dashboard')

 <article class="content dashboard-page">
    <section class="section">
        <div class="row sameheight-container">


{{-- 

            <div class="col col-12 col-sm-12 col-md-6 col-xl-5 stats-col">
                <div class="card sameheight-item stats" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title"> Metrics </h4>
                            <p class="title-description"> Current Month
                               
                            </p>
                        </div>

                        <div class="row row-sm stats-container">
                            <div class="col-12 col-sm-6 stat-col">
                                <div class="stat-icon">
                                
                                    
			                    <img width="50" height="50"  src="{{ URL::to('egg_c.png') }}"/>
                                </div>
                                <div class="stat">
                                    <div class="value">789</div>
                                    <div class="name"> Eggs Collected(Trays) </div>
                                </div>
                                <div class="progress stat-progress">
                                    <div class="progress-bar" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 stat-col">
                                <div class="stat-icon">
                                    <img width="50" height="50"  src="{{ URL::to('egg_s.png') }}"/>
                                </div>
                                <div class="stat">
                                    <div class="value"> 1000 </div>
                                    <div class="name"> Eggs Sold </div>
                                </div>
                                <div class="progress stat-progress">
                                    <div class="progress-bar" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6  stat-col">
                                <div class="stat-icon">
                                    <img width="50" height="50"  src="{{ URL::to('income.png') }}"/>
                                </div>
                                <div class="stat">
                                    <div class="value"> ¢6350 </div>
                                    <div class="name"> Monthly Income </div>
                                </div>
                                <div class="progress stat-progress">
                                    <div class="progress-bar" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6  stat-col">
                                <div class="stat-icon">
                                    <img width="50" height="50"  src="{{ URL::to('money2.png') }}"/>
                                </div>
                                <div class="stat">
                                    <div class="value"> ¢7890 </div>
                                    <div class="name"> Monthly Expense  </div>
                                </div>
                                <div class="progress stat-progress">
                                    <div class="progress-bar" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12  stat-col">
                                <!-- <div class="text-center"> -->
                                    <div class="stat-icon">
                                        <i class="fa fa-balance-scale"></i>
                                    </div>
                                    <div class="stat">
                                        <div  style="color:red; font-size:25px;">NET BALANCE: ¢1540</div>
                                        <!-- <div class="name"> Tickets closed </div> -->
                                    </div>
                                <!-- </div> -->
                                <div class="progress stat-progress stu">
                                    <div class="progress-bar" style="width: 100%;"></div>
                                </div> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>

 --}}


 <div class="col col-12 col-sm-12 col-md-6 col-xl-5 stats-col">
        <div class="card sameheight-item stats" data-exclude="xs">  
               
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h3 class="title">Metrics</h3>
                    </div>
                    <ul class="nav nav-tabs pull-right" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#Today" role="tab" data-toggle="tab">Today</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Weekly" role="tab" data-toggle="tab">Weekly</a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="#Monthly" role="tab" data-toggle="tab">Monthly</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="#All" role="tab" data-toggle="tab">All Time</a>
                                </li>
                    </ul>
                </div>


                <div class="card-block">
                    <div class="tab-content">


                        <div role="tabpanel" class="tab-pane active fade show" id="Today">
                         <div class="row row-sm stats-container">
                                            <div class="col-12 col-sm-6 stat-col">
                                                <div class="stat-icon">
                                                
                                                    
                                                <img width="50" height="50"  src="{{ URL::to('egg_c.png') }}"/>
                                                </div>
                                                <div class="stat">
                                                    <div class="value">
                                                        
                                                            @if(!$getSumOfEggsToday) 
                                                            No records yet
                                                         @else 
                                                         {{$getSumOfEggsToday}} 
                                                         @endif 


                                                    </div>

                                                    <div class="name"> Eggs Collected(Trays) </div>
                                               
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 stat-col">
                                                <div class="stat-icon">
                                                    <img width="50" height="50"  src="{{ URL::to('egg_s.png') }}"/>
                                                </div>
                                                <div class="stat">

                                                        <div class="value">
                                                        
                                                                @if(!$getSumOfEggsSoldToday) 
                                                                No records yet
                                                             @else 
                                                             {{$getSumOfEggsSoldToday}} 
                                                             @endif 
    
    
                                                        </div>
    
                                                        <div class="name"> Eggs Sold </div>
                                                       
                                               
                                                    </div>
                                               
                                               
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6  stat-col">
                                                <div class="stat-icon">
                                                    <img width="50" height="50"  src="{{ URL::to('income.png') }}"/>
                                                </div>
                                                <div class="stat">

                                                        <div class="value">
                                                          
                                                                @if(!$get_total_daily_income) 
                                                                No records yet
                                                             @else 
                                                             {{'GHS '.$get_total_daily_income}} 
                                                             @endif
                                                             <div class="name"> Daily Income </div>
                                                                </div>                                                    
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6  stat-col">
                                                <div class="stat-icon">
                                                    <img width="50" height="50"  src="{{ URL::to('money2.png') }}"/>
                                                </div>
                                                <div class="stat">
                                                    <div class="value"> 
                                                        
                                                    
                                                            @if(!$get_total_daily_expense) 
                                                            No records yet
                                                         @else 
                                                         {{'GHS '.$get_total_daily_expense}} 
                                                         @endif
                                                    
                                                    </div>
                                                    <div class="name"> Daily Expense  </div>
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12  stat-col">
                                                <!-- <div class="text-center"> -->
                                                    <div class="stat-icon">
                                                        <i class="fa fa-balance-scale"></i>
                                                    </div>
                                                    <div class="stat">
                                                        <div  style="color:red; font-size:20px;">NET BAL: 

                                                            <b>
                                                                @if(!$daily_net_balance) 
                                                               0.00
                                                             @else 
                                                             {{'GHS '.$daily_net_balance}} 
                                                             @endif
                                                            </b>
                                                        
                                                        
                                                        </div>
                                                        <!-- <div class="name"> Tickets closed </div> -->
                                                    </div>
                                                <!-- </div> -->
                                                <div class="progress stat-progress stu">
                                                    <div class="progress-bar" style="width: 100%;"></div>
                                                </div> 
                                            </div>
                                        </div>

                         
                        </div>




                        <div role="tabpanel" class="tab-pane fade" id="Weekly">
                                <div class="row row-sm stats-container">
                                                   <div class="col-12 col-sm-6 stat-col">
                                                       <div class="stat-icon">
                                                       
                                                           
                                                       <img width="50" height="50"  src="{{ URL::to('egg_c.png') }}"/>
                                                       </div>
                                                       <div class="stat">
                                                           <div class="value">
                                                               
                                                                @if(!$getSumOfEggsWeekly) 
                                                                No records yet
                                                             @else 
                                                             {{$getSumOfEggsWeekly}} 
                                                             @endif 


                                                           </div>
                                                           <div class="name"> Eggs Collected(Trays) </div>
                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6 stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('egg_s.png') }}"/>
                                                       </div>
                                                       <div class="stat">

                                                            <div class="value">
                                                          
                                                            @if(!$getSumOfEggsSoldWeekly) 
                                                            No records yet
                                                         @else 
                                                         {{$getSumOfEggsSoldWeekly}} 
                                                         @endif
                                                         <div class="name"> Eggs sold </div>
                                                            </div>

                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6  stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('income.png') }}"/>
                                                       </div>
                                                       <div class="stat">
                                                           <div class="value"> 
                                                               
                                                                @if(!$get_total_week_income) 
                                                                No records yet
                                                             @else 
                                                             {{'GHS '.$get_total_week_income}} 
                                                             @endif 


                                                           </div>
                                                           <div class="name"> Weekly Income </div>
                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6  stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('money2.png') }}"/>
                                                       </div>
                                                       <div class="stat">
                                                           <div class="value">
                                                                @if(!$get_total_week_expense) 
                                                                No records yet
                                                             @else 
                                                             {{'GHS '.$get_total_week_expense}} 
                                                             @endif 
                                                               
                                                        </div>
                                                           <div class="name"> Weekly Expense  </div>
                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-12  stat-col">
                                                       <!-- <div class="text-center"> -->
                                                           <div class="stat-icon">
                                                               <i class="fa fa-balance-scale"></i>
                                                           </div>
                                                           <div class="stat">
                                                               <div  style="color:red; font-size:20px;">NET BAL:
                                                                
                                                                
                                                            <b>
                                                                    @if(!$week_net_balance) 
                                                                    0.00
                                                                 @else 
                                                                 {{'GHS '.$week_net_balance}} 
                                                                 @endif
                                                                </b>
                                                            
                                                                
                                                                </div>
                                                               <!-- <div class="name"> Tickets closed </div> -->
                                                           </div>
                                                       <!-- </div> -->
                                                       <div class="progress stat-progress stu">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div> 
                                                   </div>
                                               </div></div>



 

 



                        <div role="tabpanel" class="tab-pane fade" id="Monthly">
                                <div class="row row-sm stats-container">
                                                   <div class="col-12 col-sm-6 stat-col">
                                                       <div class="stat-icon">
                                                       
                                                           
                                                       <img width="50" height="50"  src="{{ URL::to('egg_c.png') }}"/>
                                                       </div>
                                                       <div class="stat">
                                                       <div class="value">

                                                            @if(!$getSumOfEggsMonthly) 
                                                            No records yet
                                                         @else 
                                                         {{$getSumOfEggsMonthly}} 
                                                         @endif 

  </div>
                                                           <div class="name"> Eggs Collected(Trays) </div>
                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6 stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('egg_s.png') }}"/>
                                                       </div>
                                                       <div class="stat">

                                                            <div class="value">
                                                          
                                                                    @if(!$getSumOfEggsSoldMonthly) 
                                                                    No records yet
                                                                 @else 
                                                                 {{$getSumOfEggsSoldMonthly}} 
                                                                 @endif
                                                                 <div class="name"> Eggs sold </div>
                                                                    </div>

                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6  stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('income.png') }}"/>
                                                       </div>
                                                       <div class="stat">

                                                           <div class="value">
                                                                @if(!$get_total_month_income) 
                                                                No records yet
                                                             @else 
                                                             {{'GHS '.$get_total_month_income}} 
                                                             @endif 
                                                               
                                                        
                                                        </div>
                                                           <div class="name"> Monthly Income </div>


                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6  stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('money2.png') }}"/>
                                                       </div>
                                                       <div class="stat">
                                                           <div class="value"> 
                                                               
                                                                @if(!$get_total_month_expense) 
                                                                No records yet
                                                             @else 
                                                             {{'GHS '.$get_total_month_expense}} 
                                                             @endif  


                                                           </div>
                                                           <div class="name"> Monthly Expense  </div>
                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-12  stat-col">
                                                       <!-- <div class="text-center"> -->
                                                           <div class="stat-icon">
                                                               <i class="fa fa-balance-scale"></i>
                                                           </div>
                                                           <div class="stat">
                                                               <div  style="color:red; font-size:20px;">NET BAL: 
                                                            
                                                                    <b>
                                                                            @if(!$month_net_balance) 
                                                                            0.00
                                                                         @else 
                                                                         {{'GHS '.$month_net_balance}} 
                                                                         @endif
                                                                        </b>
                                                            
                                                            </div>
                                                               <!-- <div class="name"> Tickets closed </div> -->
                                                           </div>
                                                       <!-- </div> -->
                                                       <div class="progress stat-progress stu">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div> 
                                                   </div>
                                               </div></div>


                                    
                                               

                           



                        <div role="tabpanel" class="tab-pane fade" id="All">
                                <div class="row row-sm stats-container">
                                                   <div class="col-12 col-sm-6 stat-col">
                                                       <div class="stat-icon">
                                                       
                                                           
                                                       <img width="50" height="50"  src="{{ URL::to('egg_c.png') }}"/>
                                                       </div>
                                                       <div class="stat">
                                                       <div class="value"> 
                                                        @if(!$totaleggs) 
                                                          No Eggs
                                                       @else 
                                                       {{$totaleggs}} 
                                                       @endif 

                                                       </div>
                                                           <div class="name"> Eggs Collected(Trays) </div>
                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6 stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('egg_s.png') }}"/>
                                                       </div>
                                                       <div class="stat">

                                                            <div class="value">
                                                          
                                                                    @if(!$getSumOfEggsSoldAllTime) 
                                                                    No records yet
                                                                 @else 
                                                                 {{$getSumOfEggsSoldAllTime}} 
                                                                 @endif
                                                                 <div class="name"> Eggs sold </div>
                                                                    </div>

                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6  stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('income.png') }}"/>
                                                       </div>
                                                       <div class="stat">
                                                           <div class="value">
                                                               
                                                                @if(!$get_total_alltime_income) 
                                                                No records yet
                                                             @else 
                                                             {{'GHS '.$get_total_alltime_income}} 
                                                             @endif  


                                                           </div>
                                                           <div class="name"> All Income </div>
                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-6  stat-col">
                                                       <div class="stat-icon">
                                                           <img width="50" height="50"  src="{{ URL::to('money2.png') }}"/>
                                                       </div>
                                                       <div class="stat">
                                                           <div class="value"> 
                                                               
                                                                @if(!$get_total_alltime_expense) 
                                                                No records yet
                                                             @else 
                                                             {{'GHS '.$get_total_alltime_expense}} 
                                                             @endif  
                                                        
                                                        </div>
                                                           <div class="name"> All Expense  </div>
                                                       </div>
                                                       <div class="progress stat-progress">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div>
                                                   </div>
                                                   <div class="col-12 col-sm-12  stat-col">
                                                       <!-- <div class="text-center"> -->
                                                           <div class="stat-icon">
                                                               <i class="fa fa-balance-scale"></i>
                                                           </div>
                                                           <div class="stat">
                                                               <div  style="color:red; font-size:20px;">NET BAL: 
                                                                    <b>
                                                                            @if(!$alltime_net_balance) 
                                                                            0.00
                                                                         @else 
                                                                         {{'GHS '.$alltime_net_balance}} 
                                                                         @endif
                                                                        </b>
                                                               
                                                            
                                                            </div>
                                                               <!-- <div class="name"> Tickets closed </div> -->
                                                           </div>
                                                       <!-- </div> -->
                                                       <div class="progress stat-progress stu">
                                                           <div class="progress-bar" style="width: 100%;"></div>
                                                       </div> 
                                                   </div>
                                               </div></div>                    
 


                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div> 


            
            <div class="col col-12 col-sm-12 col-md-6 col-xl-7 history-col">
                <div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
                    <div class="card-header card-header-sm bordered">
                        <div class="header-block">
                            <h3 class="title">Things you can do</h3>
                        </div>
                        <ul class="nav nav-tabs pull-right" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#visits" role="tab" data-toggle="tab">Task</a>
                            </li>
{{-- 
                            <li class="nav-item">
                                <a class="nav-link" href="#downloads" role="tab" data-toggle="tab">Health Status</a>
                            </li>
                        --}}
                        </ul>
                    </div>
                    <div class="card-block">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active fade show" id="visits">
                                {{-- <p class="title-description"> Things you can do. </p> --}}
                                <div class="toDoList">
                                        <a href="{{url('birds/feedgiven')}}">
                                            <div class="col-12 col-sm-12 stat-col stats">
                                                <div class="value">Give Feed</div>
                                            </div>
                                        </a>

                                        <a href="{{url('account/collectlist')}}">
                                                <div class="col-12 col-sm-12 stat-col stats">
                                                    <div class="value">Collect Eggs</div>
                                                </div>
                                            </a>

                                        <a href="{{url('birds/drugtaking')}}">
                                            <div class="col-12 col-sm-12 stat-col stats">
                                                <div class="value">Give Drugs </div>
                                            </div>
                                        </a>
                                        <a href="{{url('account/billrecords')}}">
                                            <div class="col-12 col-sm-12 stat-col stats">
                                                <div class="value">  Add Bill (Record feed and drug as expense) </div>
                                            </div>
                                        </a>
                                        <a href="{{url('account/sales')}}">
                                            <div class="col-12 col-sm-12 stat-col stats">
                                                <div class="value"> Record a Sale (Egg, Bird, Litter, etc.) </div>
                                            </div>
                                        </a>
                                    </div>
                                

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="downloads">
                                <p class="title-description"> Number of mortalities over the last 3 months </p>
                                    <div id="dashboard-downloads-chart"></div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </section>



{{-- 

    <section class="section">
        <div class="row sameheight-container"> 

            <div class="col col-12 col-sm-12 col-md-6 col-xl-12 stats-col">
                <div class="card sameheight-item stats" data-exclude="xs">  
                       
                        <div class="card-header card-header-sm bordered">
                            <div class="header-block">
                                <h3 class="title">Overdues</h3>
                            </div>
                            <ul class="nav nav-tabs pull-right" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#bills" role="tab" data-toggle="tab">Bills</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sales" role="tab" data-toggle="tab">Sales</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active fade show" id="bills">
                                 <p class="title-description"> Oustanding sales </p>  
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
                                <div role="tabpanel" class="tab-pane fade" id="sales">
                                 <p class="title-description">Outstanding bills</p>  
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
                            </div>
                        </div>
               
                </div>
            </div> 
</div></section>
 --}}



{{-- 

    <section class="section">
            <div class="row sameheight-container"> 
    
                <div class="col col-12 col-sm-12 col-md-6 col-xl-12 stats-col">
                    <div class="card sameheight-item stats" data-exclude="xs">  
                           
                            <div class="card-header card-header-sm bordered">
                                <div class="header-block">
                                    <h3 class="title">Eggs Analytics</h3>
                                </div>
                                <ul class="nav nav-tabs pull-right" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#Line" role="tab" data-toggle="tab">Line Chart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#Bar" role="tab" data-toggle="tab">Bar Chart</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-block">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active fade show" id="Line">
                                         {{-- <p class="title-description"> Oustanding sales </p> --}}

                                      

                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="Bar">
                                        {{-- <p class="title-description">Outstanding bills</p> --}}

                                      


                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                </div> 
    
              
    
            </div>
        </section> --}}
    
    




    <section class="section">
        <div class="row sameheight-container">

                {{-- <div class="col col-12 col-sm-12 col-md-6 col-xl-5 stats-col">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title"> Eggs Collected for This Week </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered table-hover"   style="width:100%; margin-top: 30px; ">
                                <thead>
                                    <tr>
                                        <th>Pen </th>
                                        <th>Size</th>
                                        <th>Type</th> 
                                        <th>Quantity</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2</td>
                                        <td>Small</td>
                                        <td>Good</td>
                                        <td>63</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Medium</td>
                                        <td>Good</td>
                                        <td>104</td> 
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Small</td>
                                        <td>Good</td>
                                        <td>63</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Medium</td>
                                        <td>Good</td>
                                        <td>104</td> 
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}


{{-- 

            <div class="col col-12 col-sm-12 col-md-6 col-xl-7 stats-col">
                <div class="card sameheight-item" data-exclude="xs" id="">
                    <div class="card-header card-header-sm bordered">
                        <div class="header-block">
                            <h3 class="title">Income</h3>
                        </div>
                    </div>
                        <div class="card-block">
                        <div class="tab-content">
                             
                                        <canvas id="canvas" width="450" height="250"></canvas>
     
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
                                        <script>
                                        var url = "{{url('account/printMonthlyCollection')}}";
                                        var DatesCollected = new Array();
                                        var TypeOfEgg = new Array();
                                        var QuantityOfTrays = new Array();
                                        $(document).ready(function(){
                                          $.get(url, function(response){
                                            response.forEach(function(data){
                                                DatesCollected.push(data.date_recorded);
                                                TypeOfEgg.push(data.type_of_egg);
                                                QuantityOfTrays.push(data.tray_quantity);

                                           console.log(data.date_recorded);

                                            });
                                            var ctx = document.getElementById("canvas").getContext('2d');
                                                var myChart = new Chart(ctx, {
                                                  type: 'line',
                                                  data: {
                                                      labels:DatesCollected,
                                                      datasets: [{
                                                          label: 'Montly Chart Eggs Collection',
                                                          data: QuantityOfTrays,
                                                          borderWidth: 1
                                                      }]
                                                  },
                                                  options: {
                                                      scales: {
                                                          yAxes: [{
                                                              ticks: {
                                                                  beginAtZero:true
                                                              }
                                                          }]
                                                      }
                                                  }
                                              });
                                          });
                                        });
                                        </script>  
                           
                        </div>
                    </div>
                </div>
            </div>

 --}}

            
        </div>
    </section>
 </article>
      

@endsection