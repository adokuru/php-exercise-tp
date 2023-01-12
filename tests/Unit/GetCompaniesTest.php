<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class GetCompanies extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_companies()
    {
        $companies = new \App\Http\Controllers\HomeController();
        $data = $companies->getCompanyData();

        $this->assertIsArray($data);
    }

    public function test_get_companies_with_symbol()
    {
        $companies = new \App\Http\Controllers\HomeController();
        $data = $companies->getCompanyData('AAPL');

        $this->assertIsArray($data);
    }
}