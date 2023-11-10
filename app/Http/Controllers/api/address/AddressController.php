<?php

namespace App\Http\Controllers\api\address;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function view($user_id)
    {
        $address = Address::where('users_id', $user_id)->get();
        return response()->json(['status' => 'success', 'data' => $address]);
    }

    public function add(Request $request)
    {
        $request->validate([
            "name" => 'required|string',
            'users_id' => 'required|integer',
            'city' => 'required|string',
            'street' => 'required|string',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);
        $address = new Address();
        $address->name = $request->name;
        $address->users_id = $request->users_id;
        $address->city = $request->city;
        $address->street = $request->street;
        $address->lat = $request->lat;
        $address->long = $request->long;
        $address->save();
        return response()->json([
            'status' => 'success', 'data' => $address]);
    }
    public function edit(Request $request, $user_id, $address_id)
    {
        $address = Address::where('users_id', $user_id)
            ->where('id', $address_id)
            ->first();
        if (!$address) {
            return response()->json([
                'status' => 'error',
                'message' => 'Address not found for the specified user_id and address_id'
            ], 404);
        }
        if ($request->has('name')) {
            $address->name = $request->name;
        }
        if ($request->has('city')) {
            $address->city = $request->city;
        }
        if ($request->has('street')) {
            $address->street = $request->street;
        }
        if ($request->has('lat')) {
            $address->lat = $request->lat;
        }
        if ($request->has('long')) {
            $address->long = $request->long;
        }
        $address->save();
        return response()->json(['status' => 'success', 'data' => $address]);
    }

    public function delete($user_id, $address_id)
    {
        $address = Address::where('users_id', $user_id)->where('id', $address_id)->first();
        $address->delete();
        return response()->json(['status' => 'success', 'data' => $address]);
    }
}
