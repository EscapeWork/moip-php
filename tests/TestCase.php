<?php

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

function dd()
{
    var_dump(func_get_args()); die;
}

class TestCase extends PHPUnitTestCase
{
}
