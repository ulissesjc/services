<?php

use Carbon\Carbon;

function formateDate($date, $format = 'd/m/Y')
{
    return Carbon::parse($date)->format($format);
}
