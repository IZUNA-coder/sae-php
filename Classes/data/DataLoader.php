<?php

namespace data;

class DataLoader
{
    public static function load(string $file)
    {
        $file = file_get_contents($file);
        return json_decode($file, true);
    }
}