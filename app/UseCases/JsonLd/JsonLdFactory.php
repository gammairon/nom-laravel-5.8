<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\UseCases\JsonLd;


class JsonLdFactory implements JsonLdInterface
{
    /**
     * @var string
     */
    private $json;

    /**
     * @var string
     */
    private $scripts;

    /**
     * @var array
     */
    private $items = [];


    /**
     * @param JsonLdInterface $item
     */
    public function add(JsonLdInterface $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return string
     */
    public function toJson(): ?string
    {

        foreach ($this->items as $item) {
            $this->json .= $item->toJson();
        }

        return $this->json;
    }

    public function generate(): ?string
    {
        foreach ($this->items as $item) {
            $this->scripts .= $item->generate();
        }

        return $this->scripts;
    }
}