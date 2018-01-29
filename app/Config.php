<?php

namespace App;

class Config
{
    public static function getPeriods() 
    {
        return env("APP_LESSON_PERIODS", 7);
    }
}