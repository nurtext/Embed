<?php

namespace Embed\Adapters;

use Embed\Request;
use Embed\Utils;

/**
 * Adapter to generate embed code from ideone.com.
 */
class Ideone extends Webpage implements AdapterInterface
{
    /**
     * {@inheritdoc}
     */
    public static function check(Request $request)
    {
        return $request->isValid() && $request->getResponse()->getUri()->match([
            'https?://ideone.com/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        $this->width = null;
        $this->height = null;

        $uri = $this->getResponse()->getUri();
        $path = '/e.js'.$uri->getPath();

        return Utils::script($uri->create($path));
    }
}
