<?php

namespace Slexx\AssetsManager;

class InlineStyleAsset extends AbstractAsset
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<style>' . $this->getHref() . '</style>';
    }
}
