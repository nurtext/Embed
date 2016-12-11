<?php

namespace Embed\Adapters;

use Embed\Utils;
use Embed\Request;

/**
 * Adapter to get the embed code from play.cadenaser.com.
 */
class Cadenaser extends Webpage implements AdapterInterface
{
    /**
     * {@inheritdoc}
     */
    public static function check(Request $request)
    {
        return $request->isValid() && $request->getResponse()->getUri()->match([
            'https?://play.cadenaser.com/audio/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        $uri = $this->getResponse()->getUri();

        return Utils::iframe($uri->withPath('/widget/'.$uri->getPath()), $this->width, $this->height);
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return 620;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight()
    {
        return 100;
    }
}
