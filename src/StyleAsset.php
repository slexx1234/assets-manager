<?php

namespace Slexx\AssetsManager;

class StyleAsset extends AbstractAsset
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<link href="' . htmlspecialchars($this->getHref()) . '" rel="stylesheet"/>';
    }
}

