<?php

namespace Tests\Unit;

use App\Models\Exam;
use PHPUnit\Framework\TestCase;

class ExamsTest extends TestCase
{

    /**@test*/
    public function test_if_types_not_null()
    {
        $exam = new Exam();
        $types = $exam->getPossibleTypes();

        $this->assertNotNull($types);
    }

    /**@test*/
    public function test_if_tags_not_null()
    {
        $exam = new Exam();
        $tags = $exam->getPossibleTags();

        $this->assertNotNull($tags);
    }
}
