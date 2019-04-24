<?php

namespace Slexx\AssetsManager;

abstract class AbstractAsset implements AssetInterface
{
    /**
     * @var string
     */
    protected $href;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string[]
     */
    protected $requires;

    /**
     * AbstractAsset constructor.
     * @param string $name
     * @param string $href
     * @param string[] $requires
     */
    public function __construct(string $name, string $href, array $requires = [])
    {
        $this->name = $name;
        $this->href = $href;
        $this->requires = $requires;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return $this
     */
    public function setHref(string $href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getRequires(): array
    {
        return $this->requires;
    }

    /**
     * @param array $requires
     * @return $this
     */
    public function setRequires(array $requires)
    {
        $this->requires = $requires;
        return $this;
    }

    /**
     * @return string
     */
    abstract public function render(): string;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}

