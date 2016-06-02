<?php

namespace Bolt\Extension\Locastic\InfiniteScroll;

use Bolt\Extension\Locastic\InfiniteScroll\Controller\InfiniteScrollController;
use Bolt\Extension\SimpleExtension;
use Bolt\Asset\File\JavaScript;
use Bolt\Asset\Target;
use Bolt\Controller\Zone;
use Twig_Markup;

class InfiniteScrollExtension extends SimpleExtension
{
    protected function registerFrontendControllers()
    {
        return [
            '/infinitescroll' =>  new InfiniteScrollController(),
        ];
    }

    protected function registerAssets()
    {
        $start = (new Javascript())
            ->setFileName('start.js')
            ->setLate(true)
            ->setZone(Zone::FRONTEND);

        $jscroll = (new Javascript())
            ->setFileName('jscroll/jquery.jscroll.min.js')
            ->setLate(true)
            ->setZone(Zone::FRONTEND);

        return [
            $start,
            $jscroll
        ];
    }

    protected function registerTwigFunctions()
    {
        return [
            'infiniteScroll' => 'twigInfiniteScroll',
        ];
    }

    public function twigInfiniteScroll()
    {
        $html = '<div id="infinite-scroll"></div>
                <div id="infinite-scroll-bottom"></div>';

        return new Twig_Markup($html, 'UTF-8');
    }

}
