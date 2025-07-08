<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getDistricts($state)
    {
        $data = json_decode(file_get_contents(public_path('states_districts.json')), true);
        return response()->json($data[$state] ?? []);
    }
}

