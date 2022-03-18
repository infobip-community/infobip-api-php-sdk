<?php

declare(strict_types=1);

namespace Tests\Support\Laravel;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Foundation\Application;
use Infobip\Support\Laravel\InfobipServiceProvider;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Tests\TestCase;

final class InfobipServiceProviderTest extends TestCase
{
    /** @var LegacyMockInterface|MockInterface */
    private $application;

    /** @var LegacyMockInterface|MockInterface */
    private $config;

    /** @var InfobipServiceProvider */
    private $infobipServiceProvider;

    protected function setUp(): void
    {
        $this->application = Mockery::mock(Application::class);
        $this->config = Mockery::mock(Config::class);
        $this->infobipServiceProvider = new InfobipServiceProvider($this->application);

        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset(
            $this->application,
            $this->config,
            $this->infobipServiceProvider
        );

        parent::tearDown();
    }

    public function testBootMethodIsCalled(): void
    {
        // arrange
        $this->application
            ->shouldReceive('configPath')
            ->once()
            ->withAnyArgs()
            ->andReturn([]);

        // act
        $this->infobipServiceProvider->boot();

        // assert
        $this->assertTrue(true);
    }

    public function testRegisterMethodIsCalled(): void
    {
        // arrange
        $this->application
            ->shouldReceive('make')
            ->once()
            ->withAnyArgs()
            ->andReturn($this->config);

        $this->config
            ->shouldReceive('get')
            ->once()
            ->withAnyArgs()
            ->andReturn([]);

        $this->config
            ->shouldReceive('set')
            ->once()
            ->withAnyArgs()
            ->andReturnNull();

        $this->application
            ->shouldReceive('singleton')
            ->once()
            ->withAnyArgs()
            ->andReturnNull();

        // act
        $this->infobipServiceProvider->register();

        // assert
        $this->assertTrue(true);
    }
}
