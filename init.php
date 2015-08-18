<?php

use Bolt\Extension\Locastic\InfiniteScroll\Extension;

if (isset($app)) {
    $app['extensions']->register(new Extension($app));
}
