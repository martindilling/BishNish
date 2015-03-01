<?php namespace BishNish;

class CountryCodes
{
    /**
     * @var array
     */
    protected $codes = [];

    /**
     * @var bool
     */
    protected $uppercase = false;

    /**
     * @var bool
     */
    protected $sort = false;

    /**
     * @param string $dataFile File containing an array of all country codes.
     */
    public function __construct($dataFile = 'country_codes.php')
    {
        if (!file_exists($dataFile)) {
            throw new \InvalidArgumentException("The file [{$dataFile}] does not exist!");
        }

        $this->codes = require $dataFile;
    }

    /**
     * Get the country codes in Alpha-3 format.
     */
    public function getCodes()
    {
        $codes = $this->codes;

        if ($this->uppercase) {
            $codes = $this->makeAllItemsUppercase($codes);
        }

        if ($this->sort) {
            sort($codes);
        }

        return $codes;
    }

    /**
     * Set flag that the codes should be uppercased.
     *
     * @return $this
     */
    public function uppercased()
    {
        $this->uppercase = true;

        return $this;
    }

    /**
     * Set flag that the codes should be sorted.
     *
     * @return $this
     */
    public function sorted()
    {
        $this->sort = true;

        return $this;
    }

    /**
     * @param array $codes
     * @return array
     */
    protected function makeAllItemsUppercase($codes)
    {
        $codes = array_map('strtoupper', $codes);

        return $codes;
    }
}
