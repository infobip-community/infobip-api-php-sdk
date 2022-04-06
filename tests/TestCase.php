<?php

declare(strict_types=1);

namespace Tests;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /** @var FakerGenerator */
    protected $faker;

    protected function setUp(): void
    {
        $this->faker = FakerFactory::create();

        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->faker);

        parent::tearDown();
    }
}
