<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 21-Aug-16
 * Time: 6:48 PM
 */

namespace BusinessLogic;

use BusinessLogic\Interfaces\PageRenderSettings;
use Silex\Application;

class PageRenderSettingsFactory
{
    /** @var Application */
    private $app;

    /**
     * PageRenderSettingsFactory constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $pageName
     * @param string $pageValue
     * @return PageRenderSettings
     */
    public function create($pageName, $pageValue)
    {
        /** @var PageRenderSettings $pageRenderSettings */
        $pageRenderSettings = null;

        switch ($pageName) {
            case 'auctions':
                $pageRenderSettings = new AuctionsPageRenderSettings();
                break;
            case 'auction':
                $pageRenderSettings = new AuctionPageRenderSettings($this->app['config'], $pageValue);
                break;
            case 'home':
                $pageRenderSettings = new HomePageRenderSettings();
                break;
            case 'news':
                $pageRenderSettings = new NewsPageRenderSettings($pageValue);
                break;
        }

        return $pageRenderSettings;
    }
}