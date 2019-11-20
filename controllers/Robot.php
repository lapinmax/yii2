<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 19.11.2019
 * Time: 13:04
 */

namespace app\controllers;

use yii\base\Component;
use yii\httpclient\Client;
use Exception;


use keltstr\simplehtmldom\SimpleHTMLDom;

class Robot extends Component
{

    const DEFAULT_URL = 'http://kgd.gov.kz/ru/app/culs-taxarrear-search-web';

    public $lastResponse;
    public $lastRequest;
    public $client;

    /**
     * Robot constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        parent::init();
        $this->client = $client = new Client(
            [
                'transport' => 'yii\httpclient\CurlTransport',
                'baseUrl'   => self::DEFAULT_URL,
            ]
        );
    }

    public function getPage($url = self::DEFAULT_URL)
    {
        try {
            $request            = $this->client->get($url);
            $this->lastResponse = $request->send();
            $page               = SimpleHTMLDom::str_get_html($this->lastResponse->content);

            foreach ($page->find('<div class="container"></div>') as $value) {

                $valueResult = $value->find('<div id="content-wrap"></div>');

                foreach ($valueResult as $title) {
                    echo $title;
                }

                echo $valueResult;
            };

        } catch (Exception $e) {
            echo $e->getMessage() . ' ' . $e->getCode() . ' ' . $e->getLine();
        };
    }
}