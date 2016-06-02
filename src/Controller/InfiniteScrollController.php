<?php
/**
 * Created by PhpStorm.
 * User: Paula
 * Date: 29/07/15
 * Time: 11:15
 */
namespace Bolt\Extension\Locastic\InfiniteScroll\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class InfiniteScrollController implements ControllerProviderInterface
{
    private $app;

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $this->app = $app;
        $ctr = $app['controllers_factory'];
        $ctr->match('/{contenttypeslug}', [$this, 'infiniteScroll'])
            ->method('GET');

        return $ctr;
    }

    public function infiniteScroll($contenttypeslug, Request $request)
    {
        $contenttype = $this->app['storage']->getContenttype($contenttypeslug);
        if(empty($contenttype)) {
            return 'Not a valid contenttype';
        }

        if ($request->isMethod('GET')) {
            $page = $request->request->get('page');

            $amount = (!empty($contenttype['listing_records']) ? $contenttype['listing_records'] : $this->app['config']->get('general/listing_records'));
            $order = (!empty($contenttype['sort']) ? $contenttype['sort'] : $this->app['config']->get('general/listing_sort'));
            $content = $this->app['storage']->getContent($contenttype['slug'], array('limit' => $amount, 'order' => $order, 'page' => $page, 'paging' => true));

            if(empty($contenttype['infinitescroll_template'])) {
                $this->app['twig.loader.filesystem']->addPath(dirname(__DIR__) . '/templates');
                $template = 'listing_ajax.html.twig';
            } else {
                $template = $contenttype['infinitescroll_template'];
            }

            $globals = [
                'records' => $content,
                $contenttype['slug'] => $content,
                'contenttype' => $contenttype['name']
            ];

            if($content) {

                return $this->app['render']->render($template, [], $globals);
            } else {
                return 'No more posts';
            }
        }
    }
}
