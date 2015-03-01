<?php namespace BishNish;

class BishNish
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $rules;

    /**
     * @param array $data
     * @param array $rules
     */
    function __construct(array $data, array $rules)
    {
        $this->data  = $data;
        $this->rules = $rules;
    }

    /**
     * Generate an array where the rules are applied.
     *
     * @return array
     */
    public function generate()
    {
        if ($this->isRulesEmpty()) {
            return $this->data;
        }

        $result = $this->applyRulesToArray($this->data);

        return $result;
    }

    /**
     * @return bool
     */
    protected function isRulesEmpty()
    {
        return empty($this->rules);
    }

    /**
     * @param array $dataArray
     * @return array
     */
    protected function applyRulesToArray(array $dataArray)
    {
        return array_map(function ($item) {
            return $this->getNewItemName($item);
        }, $dataArray);
    }

    /**
     * @param string $item
     * @return string
     */
    function getNewItemName($item)
    {
        $matches = $this->getMatchesForItem($item);

        if (empty($matches)) {
            return $item;
        }

        return implode('', $matches);
    }

    /**
     * @param string $item
     * @return array
     */
    protected function getMatchesForItem($item)
    {
        $matches = [];

        foreach ($this->rules as $match => $replacement) {
            if ($this->isStringContaining($item, $match)) {
                $matches[] = $replacement;
            }
        }

        return $matches;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    function isStringContaining($haystack, $needle)
    {
        $uppercaseHaystack = mb_strtoupper($haystack);
        $uppercaseNeedle   = mb_strtoupper($needle);

        return mb_strpos($uppercaseHaystack, $uppercaseNeedle) !== false;
    }
}
