<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class BaseModel
{
    protected array $where = [];
    protected array $withModels = [];

    public function getWhereParams(): array
    {
        return $this->where;
    }

    public function defaultEndPoint(): string
    {
        $class_name = explode('\\', get_called_class());
        $class_name = $class_name[count($class_name) - 1];
        return Str::lower(Str::plural($class_name));
    }

    public function getEndPoint(): string
    {
        if (isset($this->endpoint)) {
            return $this->endpoint;
        }
        return $this->defaultEndPoint();
    }

    public function getFileContent(): string
    {
        return file_get_contents(env('MOCK_SERVICE') . '/' . $this->getEndPoint());
    }

    public function get(): Collection
    {
        $content = $this->getFileContent();
        $data = collect(json_decode($content));
        foreach($this->getWhereParams() as $key => $value) {
            $data = $data->where($key, $value);
        }
        return $data;
    }

    public function where(string $key, $value): self
    {
        $this->where[$key] = $value;
        return $this;
    }

    public static function all(): Collection
    {
        $model = new static;
        return $model->get();
    }
}
