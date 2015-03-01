<?php namespace BishNish\Tests;

use BishNish\BishNish;

class BishNishTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_return_empty_array_given_empty_array()
    {
        $rules = [];
        $data = [];
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals([], $bishNish->generate());
    }

    /** @test */
    public function it_should_return_data_with_no_rules_given()
    {
        $rules = [];
        $data = ['A', 'B', 'C'];
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals(['A', 'B', 'C'], $bishNish->generate());
    }

    /** @test */
    public function it_can_use_a_rule()
    {
        $rules = ['B' => 'Bish'];
        $data = ['A', 'B', 'C'];
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals(['A', 'Bish', 'C'], $bishNish->generate());
    }

    /** @test */
    public function it_can_use_multiple_rules()
    {
        $rules = ['B' => 'Bish', 'C' => 'Cish'];
        $data = ['A', 'B', 'C'];
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals(['A', 'Bish', 'Cish'], $bishNish->generate());
    }

    /** @test */
    public function it_can_handle_more_matches_in_an_item()
    {
        $rules = ['B' => 'Bish', 'C' => 'Cish'];
        $data = ['A', 'BC', 'C'];
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals(['A', 'BishCish', 'Cish'], $bishNish->generate());
    }

    /** @test */
    public function it_outputs_results_in_order_of_rules_not_matching_order()
    {
        $rules = ['B' => 'Bish', 'C' => 'Cish'];
        $data = ['A', 'BC', 'CB'];
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals(['A', 'BishCish', 'BishCish'], $bishNish->generate());
    }

    /** @test */
    public function it_is_not_case_sensitive()
    {
        $rules = ['B' => 'Bish', 'c' => 'Cish'];
        $data = ['a', 'bc', 'CB'];
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals(['a', 'BishCish', 'BishCish'], $bishNish->generate());
    }

    /** @test */
    public function it_works_with_country_code_format()
    {
        $rules = ['B' => 'Bish', 'N' => 'Nish'];
        $data = ['aze', 'bhs', 'btn'];
        $bishNish = new BishNish($data, $rules);

        $this->assertEquals(['aze', 'Bish', 'BishNish'], $bishNish->generate());
    }
}
