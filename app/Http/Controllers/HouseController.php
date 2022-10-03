<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    public function getAllHouses(Request $request){
         $houses = House::all();
        return response(['status' => 'success', 'status_code' => 200, 'message' => 'Houses  Fetched Successfully', 'data' => '']);
    }
    public function createHouse(Request $request){
        $houseValidation = \Validator::make($request->all(), [
            'house_name' => 'required|string',
            'owner_name' => 'required|string',
            'price' => 'required|int|min:100000',
        ]);
        if ($houseValidation->fails()) {
            return response()->json(['data' => $houseValidation->errors(), 'message' => 'Data is given invalid', 'status' => 'error', 'status_code' => 401]);
        } else {
            $input_house = $request->all();
            $house = House::create($input_house);
            return response(['status' => 'success', 'status_code' => 200, 'message' => 'Houses  Created Successfully', 'data' => $house]);

        }

    }
}
