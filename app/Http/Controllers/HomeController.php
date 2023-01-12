<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        // get available options
        $path = public_path('data');
        $data = File::get($path . '/companies.json');

        // if no data, return empty array
        if (!$data) {
            return view('home', [
                'companies' => []
            ]);
        }

        // decode json data
        $companies = json_decode($data);
        return view('home', [
            'companies' => $companies
        ]);
    }

    public function showData(Request $request)
    {
        // Validate request
        $request->validate([
            'symbol' => 'required:alpha',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'email' => 'required|email',
        ]);

        // get data from RapidAPI
        $rapidAPI = new \App\Services\RapidAPIService($request->symbol);
        $data = $rapidAPI->getCompanyData();

        dd($data);

        // if no data, return empty array
        if (!$data) {
            return view('home', [
                'companies' => []
            ]);
        }

        return view('view-history', [
            'companies' => $data
        ]);
    }
}