<?php

namespace Service;

class CsvLoader
{
    public function getData(string $file, int $length = 0, string $separator = ',', string $enclosure = "\"", string $escape = "\\")
    {
        $data = [];

        if (($handle = fopen($file, 'rb')) !== false) {
            while (($row = fgetcsv($handle, $length, $separator, $enclosure, $escape)) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }

        return $data;
    }
}