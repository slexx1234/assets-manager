<?php

namespace Slexx\AssetsManager;

interface AssetInterface
{
    public function __construct(string $name, string $href, array $requires = []);
    public function getName(): string;
    public function setName(string $name);
    public function getHref(): string;
    public function setHref(string $name);
    public function getRequires(): array;
    public function setRequires(array $requires);
    public function render(): string;
    public function __toString(): string;
}
