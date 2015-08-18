<?php

namespace Bolt\Extension\Locastic\InfiniteScroll;

use Bolt;
use InfiniteScroll\Controller\InfiniteScrollController;
use Symfony\Component\HttpFoundation\Request;

class Extension extends Bolt\BaseExtension
{
    public function initialize()
    {
        $this->app->mount('/infinitescroll/{contenttypeslug}', new InfiniteScrollController());

        $this->addJavascript('assets/start.js', true);
        $this->addJavascript('assets/jscroll/jquery.jscroll.js', true);
        $this->addJavascript('assets/jscroll/jquery.jscroll.min.js', true);

        $this->addTwigFunction('infiniteScroll', 'twigInfiniteScroll');

    }

    function twigInfiniteScroll()
    {
        $html = '<div id="infinite-scroll"></div>
                <div id="infinite-scroll-bottom"></div>';

        return new \Twig_Markup($html, 'UTF-8');
    }


    public function getName()
    {
        return "InfiniteScroll";
    }
}






