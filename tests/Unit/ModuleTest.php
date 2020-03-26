<?php

namespace Tests\Unit;

use App\Http\Controllers\Admin\ModuleController;
use App\Models\Module;
use PHPUnit\Framework\TestCase;

class ModuleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function test_if_correct_period_given_by_block()
    {
        $module = new Module();
        // expected 1
        $module->block = 4;
        $period = $module->getPeriodAttribute();
        $this->assertEquals($period, 1);

        // expected 2
        $module->block = 8;
        $period = $module->getPeriodAttribute();
        $this->assertEquals($period, 2);

        // expected 3
        $module->block = 12;
        $period = $module->getPeriodAttribute();
        $this->assertEquals($period, 3);

        // expected 4
        $module->block = 16;
        $period = $module->getPeriodAttribute();
        $this->assertEquals($period, 4);

        // expected 0 or null
        $module->block = 17;
        $period = $module->getPeriodAttribute();
        $this->assertEquals($period, 0);
    }
}
