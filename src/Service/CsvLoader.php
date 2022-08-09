<?php

namespace Service;

class CsvLoader
{
    public function getData($file, $length = 1000, $separator = ',')
    {
        $handle = fopen($file, 'rb');
        $data = fgetcsv($handle, $length, $separator);
        fclose($handle);

        return $data;
    }
}