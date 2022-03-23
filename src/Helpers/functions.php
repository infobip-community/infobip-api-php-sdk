<?php

declare(strict_types=1);

if (false === function_exists('array_filter_recursive')) {
    function array_filter_recursive(array $input): array
    {
        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = array_filter_recursive($value);
            }
        }

        return array_filter($input, function ($value) {
            if (true === is_null($value)) {
                return false;
            }

            if (
                true === is_array($value)
                && true === empty($value)
            ) {
                return false;
            }

            return true;
        });
    }
}
