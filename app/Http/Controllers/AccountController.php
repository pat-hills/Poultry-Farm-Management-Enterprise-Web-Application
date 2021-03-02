<?php

namespace App\Http\Controllers;

use App\Repositories\PenHouseRepository;
use App\Repositories\PenHouseStockingRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProfitAndLossRepository;
use App\Repositories\EggsRepository;
use App\Repositories\FarmItemRepository;
use Illuminate\Support\Facades\Auth;


 

class AccountController extends Controller
{

    protected $pen_house_repository;
    protected $user_repository;
    protected $pen_house_stock_repository;
    protected $eggs_repository;
    protected $farmitems_repository;
    protected $profitandloss_repository;

    public function __construct(PenHouseRepository $pen_house_repository,
        UserRepository $user_repository,
        PenHouseStockingRepository $pen_house_stock_repository,
        EggsRepository $eggs_repository,
        FarmItemRepository  $farmitems_repository,
        ProfitAndLossRepository  $profitandloss_repository
        
        ) {
        $this->pen_house_repository = $pen_house_repository;
        $this->user_repository = $user_repository;
        $this->pen_house_stock_repository = $pen_house_stock_repository;
        $this->eggs_repository = $eggs_repository;
        $this->farmitems_repository = $farmitems_repository;
        $this->profitandloss_repository = $profitandloss_repository;

    }

    
    public function index()
    {
        //getSumOfEggsSoldWeekly
        $totaleggs = $this->eggs_repository->getSumOfEggs();
        $getSumOfEggsMonthly = $this->eggs_repository->getSumOfEggsMonthly();
        $getSumOfEggsMonthly = $this->eggs_repository->getSumOfEggsMonthly();
        $getSumOfEggsToday = $this->eggs_repository->getSumOfEggsToday();
        $getSumOfEggsWeekly = $this->eggs_repository->getSumOfEggsWeekly();
        $getSumOfEggsSoldToday = $this->eggs_repository->getSumOfEggsSoldToday();
        $getSumOfEggsSoldWeekly = $this->eggs_repository->getSumOfEggsSoldWeekly();
        $getSumOfEggsSoldMonthly = $this->eggs_repository->getSumOfEggsSoldMonthly();
        $getSumOfEggsSoldAllTime = $this->eggs_repository->getSumOfEggsSoldAllTime();
        $get_total_daily_income = $this->profitandloss_repository->get_total_daily_income();
     //   $get_daily_income_from_farmpayments = $this->profitandloss_repository->get_daily_income_from_farmpayments();
     $daily_net_balance = $this->profitandloss_repository->daily_net_balance();
     $get_total_daily_expense = $this->profitandloss_repository->get_total_daily_expense();
     $get_total_week_income = $this->profitandloss_repository->get_total_week_income();
     $get_total_week_expense = $this->profitandloss_repository->get_total_week_expense();
     $week_net_balance = $this->profitandloss_repository->week_net_balance();
     $month_net_balance = $this->profitandloss_repository->month_net_balance();
     $get_total_month_expense = $this->profitandloss_repository->get_total_month_expense();
     $get_total_month_income = $this->profitandloss_repository->get_total_month_income();
     $alltime_net_balance = $this->profitandloss_repository->alltime_net_balance();
     $get_total_alltime_expense = $this->profitandloss_repository->get_total_alltime_expense();
     $get_total_alltime_income = $this->profitandloss_repository->get_total_alltime_income(); 
     
     
     $response = [
        'get_total_daily_expense' =>$get_total_daily_expense , 
        'get_total_alltime_income' =>$get_total_alltime_income , 
        'get_total_alltime_expense' =>$get_total_alltime_expense , 
        'alltime_net_balance' =>$alltime_net_balance , 
        'get_total_month_income' =>$get_total_month_income , 
        'get_total_month_expense' =>$get_total_month_expense , 
        'month_net_balance' =>$month_net_balance , 
        'week_net_balance' =>$week_net_balance , 
        'get_total_week_expense' => number_format($get_total_week_expense, 2, ".", ","), 
        'get_total_daily_income' => number_format($get_total_daily_income, 2, ".", ","),    
        
        'get_total_week_income' => $get_total_week_income,
        'daily_net_balance' => $daily_net_balance, 

            'get_total_daily_income' => number_format($get_total_daily_income, 2, ".", ","),    
            'getSumOfEggsSoldToday' => $getSumOfEggsSoldToday,    
        'getSumOfEggsSoldWeekly' => $getSumOfEggsSoldWeekly,
        'getSumOfEggsSoldMonthly' => $getSumOfEggsSoldMonthly,
        'getSumOfEggsSoldAllTime' => $getSumOfEggsSoldAllTime,
        'totaleggs' => $totaleggs,'getSumOfEggsMonthly'=>$getSumOfEggsMonthly,'getSumOfEggsToday'=>$getSumOfEggsToday,'getSumOfEggsWeekly'=>$getSumOfEggsWeekly];
        

        return view('users.dashboard',$response);
    }

    public function onboarding()
    {
        $user = Auth::user();
        $farm_account = $this->user_repository->getUserFarmAccount($user);
        $pen_house = $this->pen_house_repository->get_pen_house($user);
        $pen_house_stocking = $this->pen_house_stock_repository->get_pen_house_stocking($user);
        return view('users.onboarding', ['farmaccount' => $farm_account,
            'pen_house' => $pen_house,
            'stocking' => $pen_house_stocking]);
    }

    public function create_farm_account(Request $request)
    {
        $farm_account = Auth::user()->farm_account;
        if ($farm_account) {
            $farm_account->farm_name = $request->farm_name;
        } else {

        }
    }

    public function forms()
    {
        return view('users.forms');
    }

    public function viewbills(){
        return view('users.viewbill');
    }

    public function createbills(){
        return view('users.createbill');
    }

    public function items(){
        return view('users.items');
    }

    public function vendor(){
        return view('users.vendor');
    }
    
    public function sales_record(){
        return view('users.salesrecords');
    }

    public function customer(){
        return view('users.customers');
    }

    public function product(){
        return view('users.products');
    }

    public function invoice(){
        return view('users.invoice');
    }

     public function onboard_complete(){
        return view('users.onboardingcomplete');
    }

     public function cycle_list(){
        return view('users.cyclelist');
    }

     public function drugs(){

      
        $farm_id = Auth::user()->farm_id;
        $farmdrugs = $this->farmitems_repository->getFarmDrugs($farm_id);

        $response = ['farmdrugs' => $farmdrugs,];
          return view('users.drugs',$response);
    } 
    
    public function eggs(){
        return view('users.eggscollection');
    }

     public function feed(){

 
        $farm_id = Auth::user()->farm_id;
        $farmfeed = $this->farmitems_repository->getFarmFeed($farm_id);

        $response = ['farmfeed' => $farmfeed,];

        return view('users.feed',$response);
    }

     public function mortality(){
        return view('users.mortality');
    }

     public function stock(){
        return view('users.stock');
    }
     public function employee(){
        return view('users.employee');
    }
     public function asset(){
        return view('users.farm_asset');
    }

    public function payroll(){
        return view('users.farm_payroll');
    }

    //  public function feedtaking(){
    //      return view('users.feedrecording');
    //  }

    //  public function drugtaking(){
    //      return view('users.drugrecording');
    //  }

    //   public function penhouse(){
    //      return view('users.penhouse');
    // }

    
}
