<?php

namespace Bolt\Extension\SahAssar\Editcontentcustomtabs;

use Bolt\Extension\SimpleExtension;
use Silex\Application;

/**
 * Editcontentcustomtabs extension class.
 *
 * @author Svante Richter <svante.richter@gmail.com>
 */
class EditcontentcustomtabsExtension extends SimpleExtension
{
    /**
     * @inheritdoc
     */
    protected function registerServices(Application $app)
    {
        $app['storage.request.edit'] = $app->share(
            function ($app) {
                $cr = new ContentRequest\CustomEdit(
                    $app['storage'],
                    $app['config'],
                    $app['users'],
                    $app['filesystem'],
                    $app['logger.system'],
                    $app['logger.flash']
                );
                // @deprecated Temporary and to be removed circa Bolt 3.5.
                $cr->setQueryHandler($app['query']);
                return $cr;
            }
        );
    }


    protected function registerTwigPaths()
    {
        return [
            'templates' => ['position' => 'prepend', 'namespace' => 'bolt']
        ];
    }
}
