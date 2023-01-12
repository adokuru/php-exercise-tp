<?php

namespace Tests\Unit;

use Tests\TestCase;

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

        $this->assertGreaterThan(0, count($data));

        $this->assertTrue(true);
    }

    public function test_get_companies_with_symbol()
    {
        $companies = new \App\Http\Controllers\HomeController();
        $data = $companies->getCompanyDataBySymbol('AAPL');
        $this->assertIsObject($data);
        $this->assertEquals('AAPL', $data->Symbol);
    }

    public function test_get_companies_with_symbol_not_found()
    {
        $companies = new \App\Http\Controllers\HomeController();
        $data = $companies->getCompanyDataBySymbol('NOTFOUND');

        $this->assertNull($data);
    }
}