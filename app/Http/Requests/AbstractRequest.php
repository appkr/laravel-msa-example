<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    abstract public function getDtoClass();

    public function toDto()
    {
        $mapper = new \JsonMapper();
        $json = json_decode(json_encode($this->all()));

        return $mapper->map((object)$json, $this->getDtoClass());
    }

    public function authorize(): bool
    {
        return true;
    }
}
