<?php

use Ytake\LaravelAspect\RayAspectKernel;

class RayAspectKernelTest extends AspectTestCase
{
    /** @var RayAspectKernel */
    protected $kernel;

    public function setUp(): void
    {
        parent::setUp();
        $aspectConfigure = $this->app['config']->get('ytake-laravel-aop.aspect.drivers');
        $this->kernel = new RayAspectKernel(
            $this->app,
            $this->app['files'],
            $aspectConfigure['ray']
        );
    }

    public function testExceptionCaseNotFoundClassRegister()
    {
        $this->expectException(Exception::class);
        $this->kernel->register('NotFoundClass');
    }
}

