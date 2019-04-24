<?php

namespace Slexx\AssetsManager;

class ScriptAsset extends AbstractAsset
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<script src="' . htmlspecialchars($this->getHref()) . '"></script>';
    }
}

