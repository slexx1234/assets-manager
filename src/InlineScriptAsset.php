<?php

namespace Slexx\AssetsManager;

class InlineScriptAsset extends AbstractAsset
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<script>' . $this->getHref() . '</script>';
    }
}

