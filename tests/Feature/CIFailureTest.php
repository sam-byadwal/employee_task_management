<?php

namespace Tests\Feature;

use Tests\TestCase;

class CIFailureTest extends TestCase
{
    public function test_ci_failure_demo(): void
    {
        $this->assertTrue(false);
    }
}