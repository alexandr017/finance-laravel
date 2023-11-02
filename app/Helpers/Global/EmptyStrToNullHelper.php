<?php

if (! function_exists('empty_str_to_null')) {
    /**
     *
     * @return mixed
     */
    function empty_str_to_null($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if($value == '') {
                    $data[$key] = null;
                }
            }

        } elseif (gettype($data) == 'string') {
            if ($data == '') {
                $data = null;
            }
        }

        return $data;
    }
}
