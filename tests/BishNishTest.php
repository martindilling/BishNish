<?php namespace BishNish\Tests;

use BishNish\BishNish;

class BishNishTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_return_empty_array_given_empty_array()
    {
        $data     = [];
        $rules    = [];
        $result   = [];

        $this->assertBishNished($data, $rules, $result);
    }

    /** @test */
    public function it_should_return_data_with_no_rules_given()
    {
        $data     = ['A', 'B', 'C'];
        $rules    = [];
        $result   = ['A', 'B', 'C'];

        $this->assertBishNished($data, $rules, $result);
    }

    /** @test */
    public function it_can_use_a_rule()
    {
        $data     = ['A', 'B', 'C'];
        $rules    = ['B' => 'Bish'];
        $result   = ['A', 'Bish', 'C'];

        $this->assertBishNished($data, $rules, $result);
    }

    /** @test */
    public function it_can_use_multiple_rules()
    {
        $data     = ['A', 'B', 'C'];
        $rules    = ['B' => 'Bish', 'C' => 'Cish'];
        $result   = ['A', 'Bish', 'Cish'];

        $this->assertBishNished($data, $rules, $result);
    }

    /** @test */
    public function it_can_handle_more_matches_in_an_item()
    {
        $data     = ['A', 'BC', 'C'];
        $rules    = ['B' => 'Bish', 'C' => 'Cish'];
        $result   = ['A', 'BishCish', 'Cish'];

        $this->assertBishNished($data, $rules, $result);
    }

    /** @test */
    public function it_outputs_results_in_order_of_rules_not_matching_order()
    {
        $data     = ['A', 'BC', 'CB'];
        $rules    = ['B' => 'Bish', 'C' => 'Cish'];
        $result   = ['A', 'BishCish', 'BishCish'];

        $this->assertBishNished($data, $rules, $result);
    }

    /** @test */
    public function it_is_not_case_sensitive()
    {
        $data     = ['a', 'bc', 'CB'];
        $rules    = ['B' => 'Bish', 'c' => 'Cish'];
        $result   = ['a', 'BishCish', 'BishCish'];

        $this->assertBishNished($data, $rules, $result);
    }

    /** @test */
    public function it_works_with_country_code_format()
    {
        $data   = ['aze', 'bhs', 'btn'];
        $rules  = ['B' => 'Bish', 'N' => 'Nish'];
        $result = ['aze', 'Bish', 'BishNish'];

        $this->assertBishNished($data, $rules, $result);
    }

    /**
     * Assert that a data array is BishNished correctly based on given rules.
     *
     * @param array $data
     * @param array $rules
     * @param array $result
     */
    protected function assertBishNished(array $data, array $rules, array $result)
    {
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals($result, $bishNish->generate());
    }
}
