<?php

namespace Bolt\Extensions\Locastic\InfiniteScroll\Tests;

use Bolt\BaseExtension;
use Bolt\Extension\Locastic\InfiniteScroll\Controller\InfiniteScrollController;
use Bolt\Extension\Locastic\InfiniteScroll\Extension;
use Bolt\Tests\BoltUnitTest;
use Symfony\Component\HttpFoundation\Request;

class InfiniteScrollControllerTest extends BoltUnitTest
{
    public function setUp()
    {
        $this->resetDb();
        $app = $this->getApp();
        $this->addDefaultUser($app);
    }

    public function testInvalidContentType()
    {
        $app = $this->getApp();
        $extension = new Extension($app);
        $app['extensions']->register($extension);

        $controller = new InfiniteScrollController();
        $controller->connect($app);

        $request = Request::create('/infinitescroll/koalas');
        $app['request'] = $request;

        $response = $controller->infiniteScroll('koalas', $request);

        $this->assertSame('Not a valid contenttype', $response);
    }

    public function testGet()
    {
        $app = $this->getApp();
        $app['storage']->prefill(['pages']);
        $app['storage']->prefill(['pages']);
        $app['storage']->prefill(['pages']);
        $extension = new Extension($app);
        $app['extensions']->register($extension);

        $controller = new InfiniteScrollController();
        $controller->connect($app);

        $request = Request::create('/infinitescroll/pages');
        $app['request'] = $request;

        $response = $controller->infiniteScroll('pages', $request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
    }

    public function testGetEmpty()
    {
        $app = $this->getApp();
        $app['storage']->prefill(['pages']);
        $app['storage']->prefill(['pages']);
        $app['storage']->prefill(['pages']);
        $extension = new Extension($app);
        $app['extensions']->register($extension);

        $storage = $this->getMock('\Bolt\Storage', ['getContent'], [$app]);
        $storage->expects($this->once())
            ->method('getContent')
            ->willReturn(false);
        $app['storage'] = $storage;

        $controller = new InfiniteScrollController();
        $controller->connect($app);

        $request = Request::create('/infinitescroll/pages');
        $app['request'] = $request;

        $response = $controller->infiniteScroll('pages', $request);

        $this->assertSame('No more posts', $response);
    }
}
