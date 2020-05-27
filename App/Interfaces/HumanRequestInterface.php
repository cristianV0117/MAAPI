<?php

namespace App\Interfaces;

interface HumanRequestInterface
{
    public function humanReuqestValidation($request);

    public function noDataInRequestValidation();
}