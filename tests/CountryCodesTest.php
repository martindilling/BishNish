<?php namespace BishNish\Tests;

use BishNish\CountryCodes;

class CountryCodesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BishNish\CountryCodes
     */
    protected $countryCodes;

    public function setUp()
    {
        $dataFile           = __DIR__ . '/../src/country_codes.php';
        $countryCodes       = new CountryCodes($dataFile);
        $this->countryCodes = $countryCodes;
    }

    /** @test */
    public function it_should_fail_with_missing_file()
    {
        $this->setExpectedException('InvalidArgumentException');

        $dataFile = __DIR__ . '/../src/missing_file.php';

        $countryCodes = new CountryCodes($dataFile);
    }

    /** @test */
    public function it_should_return_country_codes()
    {
        $codes = $this->countryCodes->getCodes();

        $this->assertNotEmpty($codes);
    }

    /** @test */
    public function it_can_convert_to_uppercase()
    {
        $codes = $this->countryCodes->getCodes();

        $this->assertNotUppercased($codes);

        $codes = $this->countryCodes->uppercased()->getCodes();

        $this->assertUppercased($codes);
    }

    /** @test */
    public function it_can_sort_the_codes()
    {
        $codes = $this->countryCodes->getCodes();

        $this->assertNotSorted($codes);

        $codes = $this->countryCodes->sorted()->getCodes();

        $this->assertSorted($codes);
    }

    /** @test */
    public function it_can_sort_and_convert_to_uppercase()
    {
        $codes = $this->countryCodes->getCodes();

        $this->assertNotSorted($codes);
        $this->assertNotUppercased($codes);

        $codes = $this->countryCodes->sorted()->uppercased()->getCodes();

        $this->assertSorted($codes);
        $this->assertUppercased($codes);
    }


    /**
     * @param array  $codes
     * @param string $message
     */
    public function assertUppercased($codes, $message = 'Failed asserting that codes are all uppercase.')
    {
        $this->assertTrue($this->isUppercase($codes), $message);
    }

    /**
     * @param array  $codes
     * @param string $message
     */
    public function assertNotUppercased($codes, $message = 'Failed asserting that codes are not uppercase.')
    {
        $this->assertFalse($this->isUppercase($codes), $message);
    }

    /**
     * @param array $codes
     * @return bool
     */
    protected function isUppercase($codes)
    {
        return ctype_upper(implode('', $codes));
    }


    /**
     * @param array  $codes
     * @param string $message
     */
    public function assertSorted($codes, $message = 'Failed asserting that codes are sorted.')
    {
        $this->assertTrue($this->isSorted($codes), $message);
    }

    /**
     * @param array  $codes
     * @param string $message
     */
    public function assertNotSorted($codes, $message = 'Failed asserting that codes are not sorted.')
    {
        $this->assertFalse($this->isSorted($codes), $message);
    }

    /**
     * @param array $codes
     * @return bool
     */
    protected function isSorted($codes)
    {
        $sorted = $original = array_values($codes);
        sort($sorted);

        return $sorted === $original;
    }
}
