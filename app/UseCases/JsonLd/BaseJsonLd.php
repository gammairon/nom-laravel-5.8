<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\UseCases\JsonLd;


use Illuminate\Support\Arr;

abstract class BaseJsonLd implements JsonLdInterface
{

    protected $schema = [];

    public function getId(): string
    {
        return $this->get('@type');
    }

    public function get(string $key)
    {
        return Arr::get($this->schema, $key);
    }

    public function set(string $key, ?string $value)
    {
        Arr::set($this->schema, $key, $value);
    }

    public function remove(string $key)
    {
        Arr::forget($this->schema, $key);
    }


    public function toJson(): ?string
    {
        return json_encode($this->schema, JSON_UNESCAPED_UNICODE);
    }

    public function generate(): ?string
    {
        $script = '<script type="application/ld+json">';

        $script .= $this->toJson();

        $script .= '</script>';

        return $script;
    }
}