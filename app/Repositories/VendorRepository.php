<?php

namespace App\Repositories;

use App\Models\Vendor;

class VendorRepository
{
     
    public function __construct()
    {
        
    }

    public function createVendor($user, $name, $email=NULL, $contact=NULL, $location=NULL)
    {
        $vendor = Vendor::firstOrCreate(
            ['name' => $name, 'farm_id' => $user->farm_id], ['created_by' => $user->id]
        );
        $vendor->email = $email;
        $vendor->contact = $contact;
        $vendor->location = $location; 
        $vendor->save();
        return $vendor->id;
    }

    public function getAllVendorForFarm($farmId)
    {
        return Vendor::where('farm_id', $farmId)->get();
    }

    // public function updateOrCreateVendorForFarm($farmId,$name)
    // {
    //     return Vendor::updateOrCreate(['name'=>$name,'farm_id'=>$farmId]);
    // }
}
