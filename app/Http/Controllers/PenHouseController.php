<?php

namespace App\Http\Controllers;

use App\Models\PenHouse;
use App\Repositories\PenHouseRepository;
use Illuminate\Http\Request;
//use App\PenHouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PenHouseController extends Controller
{
    //
    protected $penHouseRepository;
    public function __construct(PenHouseRepository $penHouseRepository)
    {
        $this->penHouseRepository = $penHouseRepository;
    }

    public function penHouseView()
    {
        $farm_id = Auth::user()->farm_id;
        $penHouse = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $maxPenNumber = $this->penHouseRepository->getMaxPenNumber($farm_id);
        return view('users.onboard-penhouse', ['penHouse' => $penHouse, 'penNum' => $maxPenNumber]);
    }

    public function penHouseViewUpdate($id)
    {
        if ($id) {
            $penHouseUpdate = $this->penHouseRepository->findPenHouseById($id);
        }
        $farm_id = Auth::user()->farm_id;
        $penHouse = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $maxPenNumber = $this->penHouseRepository->getMaxPenNumber($farm_id);
        return view('users.onboard-penhouse', ['penHouse' => $penHouse, 'penNum' => $maxPenNumber]);
    }

    // public function createPenHouse(Request $request)
    // {
    //     $this->penHouseRepository->createPenHouse(
    //         $request->penHouse, $request->penNumber
    //     );
    //     // return view('users.penhouse');
    //     return redirect(route('onboarding.penhouse'));
    // }
    public function createPenHouse(Request $request)
    {
        $user = $request->user();
        $penhouseExist = $this->penHouseRepository->findByPenhouseNumber($request->penNumber, $user);
        if ($penhouseExist) {
            Session::flash('message', "Pen Number already exists");
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        } else {
            $penhouse = ['pen_name' => $request->penHouse, 'farm_id' => $user->farm_id, 'stocked' => 'NO',
                'pen_number' => $request->penNumber, 'created_by' => $user->id];
            $saved = $this->penHouseRepository->createPenHouse($penhouse);
            Session::flash('message', "Penhouse created successfully");
            Session::flash('alert-class', 'alert-success');
            return redirect(route('onboarding.penhouse'));
        }
    }
//     public function UpdatePenHouse(Request $request)
    //     {

//         $notification = array(
    //             'message' => 'Pen house successfully edited!',
    //             'alert-type' => 'success',
    //         );

//         $notification2 = array(
    //             'message' => 'Pen house failed to edit!',
    //             'alert-type' => 'warning',
    //         );
    // //strcmp("YES", $paid)
    //         //$request->updatecheck==="upt"

//         if ($request->updatecheck === "upt") {
    //             $penHouse = PenHouse::findOrFail($request->penhouseid);
    //             $penHouse->pen_name = $request->penHouse;
    //             $penHouse->pen_number = $request->penNumber;
    //             if ($penHouse->save()) {
    //                 return redirect(route('onboarding.penhouse'))->with($notification);
    //             } else {
    //                 return redirect(route('onboarding.penhouse'))->with($notification2);
    //             }
    //         } else {
    //             //delete is not logical delete and should be checked
    //             $penHouse = PenHouse::findOrFail($request->penhouseid);
    //             if (strcasecmp($penHouse->stocked, "NO") == 0) {
    //                 $penHouse->delete();
    //             } else {
    //                 Session::flash('message', 'Pen house could not be deleted!');
    //                 Session::flash('alert-class', 'alert-warning');
    //             }
    //             return redirect(route('onboarding.penhouse'));

//         }

//     }
    public function UpdatePenHouse(Request $request)
    {
        $user = $request->user();
        //check if pen number already exist
        $penhouseExist = $this->penHouseRepository->findByPenhouseNumber($request->penNumber, $user);
        if ($penhouseExist && $penhouseExist->id != $request->penhouseid) {
            Session::flash('message', "Pen Number already exists");
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        } else {
            $penhouse = ['pen_name' => $request->penHouse, 'farm_id' => $user->farm_id,
                'pen_number' => $request->penNumber, 'created_by' => $user->id];
            $saved = $this->penHouseRepository->updatePenhouse($request->penhouseid, $user, $penhouse);
            Session::flash('message', "Created new penhouse successfully");
            Session::flash('alert-class', 'alert-success');
            return redirect(route('onboarding.penhouse'));
        }
    }

    public function deletePenHouse(Request $request)
    {
        $user = $request->user();
        //check if pen number already exist
        $deleted = $this->penHouseRepository->deletePenhouse($request->penhouseid, $user);
        if ($deleted) {
            Session::flash('message', "Pen house deleted successfully");
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', "Pen house could not be deleted, Penhouse has been stocked");
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect(route('onboarding.penhouse'));
    }

    // public function DelPenhouse(Request $request)
    // {

    //     $notification = array(
    //         'message' => 'Pen house successfully deleted!',
    //         'alert-type' => 'success',
    //     );

    //     $notification2 = array(
    //         'message' => 'Pen house failed to delete!',
    //         'alert-type' => 'warning',
    //     );

    //     $penHouse = PenHouse::findOrFail($request->penhouseid);
    //     //  $penHouse->pen_name = $request->penHouse;
    //     // $penHouse->pen_number = $request->penNumber;
    //     if ($penHouse->delete()) {
    //         return redirect(route('onboarding.penhouse'))->with($notification);
    //     } else {
    //         return redirect(route('onboarding.penhouse'))->with($notification2);
    //     }

    // }

    public function DelPenhouse(Request $request)
    {

        $user = $request->user();
        $penhouseExist = $this->penHouseRepository->findByPenhouseNumber($request->penNumber, $user);
        if ($penhouseExist) {
            Session::flash('message', "Pen Number already exists");
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        } else {
            $penhouse = ['pen_name' => $request->penHouse, 'farm_id' => $user->farm_id,
                'pen_number' => $request->penNumber, 'created_by' => $user->id];
            $saved = $this->penHouseRepository->updatePenhouse($penhouse);
            Session::flash('message', "Created new penhouse successfully");
            Session::flash('alert-class', 'alert-success');
            return redirect(route('onboarding.penhouse'));
        }

    }

    public function dashPenhouseView()
    {
        $farm_id = Auth::user()->farm_id;
        $penHouse = $this->penHouseRepository->getAllPenHouseForFarm($farm_id);
        $maxPenNumber = $this->penHouseRepository->getMaxPenNumber($farm_id);
        return view('users.penhouse', ['penHouse' => $penHouse, 'penNum' => $maxPenNumber]);
    }

    public function createDashPenHouse(Request $request)
    {
        $user = $request->user();
        $penshouse = ['pen_number' => $request->penNumber,
            'pen_name' => $request->penHouse, 'farm_id' => $user->farm_id,
            'created_by' => $user->id, 'stocked' => 'NO'];
        $this->penHouseRepository->createPenHouse($penshouse);
        Session::flash('message', 'Your Penhouse has been created successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect(route('birds.penhouses'));

    }

}
