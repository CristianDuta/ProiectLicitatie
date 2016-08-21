<?php

namespace BusinessLogic;

use BusinessLogic\Interfaces\PageRenderSettings;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuctionPageRenderSettings implements PageRenderSettings
{
    /**
     * @var string
     */
    private $pageValue;
    /**
     * @var array
     */
    private $config;

    /**
     * AuctionPageRenderSettings constructor.
     * @param array $config
     * @param string $pageValue
     */
    public function __construct($config, $pageValue)
    {
        $this->pageValue = $pageValue;
        $this->config = $config;
    }

    /**
     * @return array
     * @throws NotFoundHttpException
     */
    public function getRenderParams()
    {
        if (empty($this->pageValue)) {
            throw new NotFoundHttpException();
        }

        return array(
            'inputArray' => $this->config['addOrEditSection'],
            'auction' => $this->getAuction(),
        );
    }

    private function getAuction()
    {
        $getAuctionProcess = new GetAuctionProcess();
        return $getAuctionProcess->getOne($this->pageValue)->toArray();
    }
}
