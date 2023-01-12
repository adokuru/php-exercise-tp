<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class RapidApiCompanyHistoryDataTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_has_company_history_data()
    {
        $companies = new \App\Services\RapidAPIService('AAPL');

        $this->assertIsArray($companies->getCompanyData()->prices);

        $this->assertGreaterThan(0, count($companies->getCompanyData()->prices));
    }
}