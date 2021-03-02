<?php

namespace App\Http\Controllers;

use App\Repositories\VendorRepository;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    protected $vendorRepository;

    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }

    public function rendorVendor(Request $request)
    {
        $user = $request->user();
        $vendors = $this->vendorRepository->getAllVendorForFarm($user->farm_id);
        return view('users.vendor', ['vendors' => $vendors]);
    }

    public function createVendor(Request $request)
    {
        $user = $request->user();
        $this->vendorRepository->createVendor($request->user(), $request->name,
        $request->email, $request->contact, $request->location);
        $vendors = $this->vendorRepository->getAllVendorForFarm($user->farm_id);
        return view('users.vendor', ['vendors' => $vendors]);
    }
}
