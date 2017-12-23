<?php

namespace App\Domains;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

trait ArrayCopyable
{
    public function copyFromArray(array $fields): void
    {
        foreach ($fields as $name => $value) {
            if (!property_exists($this, $name)) {
                throw new InvalidArgumentException("$name does not exist");
            }

            $this->$name = $value;
        }
    }

    public static function createFromArray(array $fields): self
    {
        $instance = new static();
        $instance->copyFromArray($fields);
        return $instance;
    }

    public static function createFromEloquent(Model $model): self
    {
        return static::createFromArray($model->toArray());
    }
}
