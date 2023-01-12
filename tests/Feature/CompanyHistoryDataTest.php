<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyHistoryDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_company_history_data_is_available()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_form_validation_with_no_symbol()
    {
        $response = $this->post('/view-history', [
            'start_date' => '2020-01-01',
            'end_date' => '2020-01-01',
            'email' => 'david@gmail.com',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'symbol' => 'The symbol field is required.'
        ]);
    }

    public function test_form_validation_with_no_start_date()
    {
        $response = $this->post('/view-history', [
            'symbol' => 'AAPL',
            'end_date' => '2020-01-01',
            'email' => 'david@gmail.com',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'start_date' => 'The start date field is required.'
        ]);
    }

    public function test_form_validation_with_no_end_date()
    {
        $response = $this->post('/view-history', [
            'symbol' => 'AAPL',
            'start_date' => '2020-01-01',
            'email' => 'david@gmail.com',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'end_date' => 'The end date field is required.'
        ]);
    }

    public function test_form_validation_with_no_email()
    {
        $response = $this->post('/view-history', [
            'symbol' => 'AAPL',
            'start_date' => '2020-01-01',
            'end_date' => '2020-01-01',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'email' => 'The email field is required.'
        ]);
    }

    public function test_form_validation_with_invalid_email()
    {
        $response = $this->post('/view-history', [
            'symbol' => 'AAPL',
            'start_date' => '2020-01-01',
            'end_date' => '2020-01-01',
            'email' => 'davidgmail.com',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'email' => 'The email must be a valid email address.'
        ]);
    }

    public function test_form_success()
    {
        $response = $this->post('/view-history', [
            'symbol' => 'AAPL',
            'start_date' => '2020-01-01',
            'end_date' => '2020-01-01',
            'email' => 'david@gmail.com',
        ]);

        $response->assertStatus(200);

        $response->assertSessionHasNoErrors();

        $response->assertSee('Apple Inc.');
    }
}