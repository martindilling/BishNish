<?php namespace BishNish;

class BishNish
{
    protected $data;
    protected $rules;

    function __construct(array $data, array $rules)
    {
        $this->data  = $data;
        $this->rules = $rules;
    }

    public function generate()
    {
        if (empty($this->rules)) {
            return $this->data;
        }

        $result = array_map(function ($item) {
            $replaceWith = [];
            foreach ($this->rules as $match => $alternative) {
                if (mb_strpos(mb_strtoupper($item), mb_strtoupper($match)) !== false) {
                    $replaceWith[] = $alternative;
                }
            }

            if (!empty($replaceWith)) {
                return implode('', $replaceWith);
            }

            return $item;
        }, $this->data);

        return $result;
    }
}
