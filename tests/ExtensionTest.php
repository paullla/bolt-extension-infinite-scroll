<?php

namespace Bolt\Extensions\Locastic\InfiniteScroll\Tests;

use Bolt\BaseExtension;
use Bolt\Extension\Locastic\InfiniteScroll\Extension;
use Bolt\Tests\BoltUnitTest;
use Symfony\Component\HttpFoundation\Request;

class ExtensionTest extends BoltUnitTest
{
    public function testExtensionInitialize()
    {
        $app = $this->getApp();
        $extension = new Extension($app);
        $app['extensions']->register($extension);
        $name = $extension->getName();
        $this->assertSame($name, 'InfiniteScroll');
        $this->assertSame($extension, $app["extensions.$name"]);
    }

    public function testAssetInsertion()
    {
        $this->resetDb();
        $app = $this->getApp();
        $this->addDefaultUser($app);
        $app['request'] = Request::create('/');

        $extension = new Extension($app);
        $app['extensions']->register($extension);

        $response = $app->handle($app['request']);
        $html = (string) $response;

        $this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
        $this->assertRegExp('#<script src="\S+assets/start.js\S+></script>#', $html);
        $this->assertRegExp('#<script src="\S+assets/jscroll/jquery.jscroll.min.js\S+></script>#', $html);
    }

    public function testTwigCallback()
    {
        $app = $this->getApp();
        $extension = new Extension($app);

        $twig = $extension->twigInfiniteScroll();
        $html = (string) $twig;

        $this->assertInstanceOf('\Twig_Markup', $twig);
        $this->assertRegExp('#<div id="infinite-scroll"></div>#', $html);
        $this->assertRegExp('#<div id="infinite-scroll-bottom"></div>#', $html);
    }
}
