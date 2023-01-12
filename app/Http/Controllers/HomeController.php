<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $companies = $this->getCompanyData();

        // if no data, return empty array
        if (!$companies) {
            return view('home', [
                'companies' => []
            ]);
        }

        return view('home', [
            'companies' => $companies
        ]);
    }

    public function getCompanyData()
    {
        // get available options
        $data = File::get(public_path('data/companies.json'));
        $data = json_decode($data);
        return $data;
    }

    public function getCompanyDataBySymbol($symbol)
    {
        // get available options
        $data = File::get(public_path('data/companies.json'));
        $data = json_decode($data);

        $data = array_filter($data, function ($item) use ($symbol) {
            return $item->Symbol == $symbol;
        });

        return $data;
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

        try {
            // get data from RapidAPI
            $rapidAPI = new \App\Services\RapidAPIService($request->symbol);
            $data = $rapidAPI->getCompanyData();

            // if no data, return empty array
            if (!$data) {
                return redirect()->back()->withErrors('No data found');
            }


            // convert start and end date to timestamp
            $start_date = strtotime($request->start_date);
            $end_date = strtotime($request->end_date);

            // get prices data
            $data = $data->prices;

            // filter data by date range
            $data = array_filter($data, function ($item) use ($end_date, $start_date) {
                return $item->date >= $start_date && $item->date <= $end_date;
            });


            // convert date to readable format
            foreach ($data as $item) {
                $item->newDate = date('d-m-Y', $item->date);
            }

            $companyName = $this->getCompanyDataBySymbol($request->symbol)->{"Company Name"};


            // sort data by date
            usort($data, function ($a, $b) {
                return $a->date <=> $b->date;
            });

            // Send email
            Mail::to($request->email)->send(new \App\Mail\CompanyData($request->start_date, $request->end_date, $companyName));

            return view('view-history', [
                'companyData' => $data,
                'companyName' => $companyName
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}