<?php

namespace common\helpers;

trait CommaSeparatedTrait
{

    /**
     * Helps to get pretty list of attributes
     * @param $model
     * @param $attribute
     * @return string
     */
    public function getStringFromArray($attribute)
    {
        if(is_array($this->{$attribute})) {
            return implode(', ', $this->{$attribute});
        }
    }
}