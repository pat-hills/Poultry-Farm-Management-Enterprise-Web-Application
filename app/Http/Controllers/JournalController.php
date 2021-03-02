<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Repositories\JournalsRepository;
use App\Repositories\ChartsOfAccountRepository;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//ChartsOfAccountRepository

class JournalController extends Controller
{
    private $journalrepository;
    private $chartofaccountrepository;

    public function __construct(JournalsRepository $journalrepository,ChartsOfAccountRepository $chartofaccountrepository)
    {
        $this->journalrepository = $journalrepository;
        $this->chartofaccountrepository = $chartofaccountrepository;
    }

    public function index()
    {
        $user = Auth::user();
        $journals = $this->journalrepository->getAllJournal($user->farm_id);
        $chartaccounts = $this->chartofaccountrepository->getAllAccounts($user->farm_id);
        return view('users.journal', ['journals' => $journals,'chartaccounts' => $chartaccounts]);
    }





    public function createjournals(Request $request)
    {
        $user = $request->user();
      //  if ($request->isMethod('post')) {
            $balance = 0;
            $farm_id = $request->user()->farm_id;
            $created_by = $request->user()->id;
           

            $acc_type= $this-> chartofaccountrepository->getAccountTypeByname($request->user()->farm_id,$request->acc_name);
          
            if($acc_type == "Income"){
                  $balance =  (-$request->debit+$request->credit);
   
        }elseif($acc_type == "Liability"){
            $balance =  (-$request->debit+$request->credit);
    
    
     }elseif($acc_type == "Equity"){
        $balance =  (-$request->debit+$request->credit);
    
    
     }elseif($acc_type == "Expense"){
        $balance =  ($request->debit-$request->credit);
    
    
     } else{
    
        $balance =  ($request->debit-$request->credit);
      }

      $journalssave = $this->journalrepository->saveJournal($farm_id,$request->acc_name,$acc_type,$request->description,$request->debit,$request->credit,$balance,$created_by);
 
           
        
            if ($journalssave) {
                Session::flash('message', 'Accounts have been saved successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'An error occured!');
                Session::flash('alert-class', 'alert-danger');
            }
       // }

        return redirect(route('account.journals'));
    }
}
