<?php

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Return the test suite to its original state.
     *
     * @return void
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
