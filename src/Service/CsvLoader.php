<?php

namespace Service;

class CsvLoader
{
    public function getData($file, $length = 1000, string $separator = ',', string $enclosure = "\"", string $escape = "\\")
    {
        $handle = fopen($file, 'rb');
        $data = fgetcsv($handle, $length, $separator, $enclosure, $escape);
        fclose($handle);

        return $data;
    }
}