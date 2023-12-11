<?php

namespace App\DesignPatterns\Property;

abstract class Property implements IProperty
{
    protected array $errors = [];

    protected bool $multiple = false;

    protected int $id;

    protected string $name;

    protected string $slug;

    /**
     * @throws \Exception
     */
    public function __construct(array $info)
    {
        if (!isset($info['name'])) {
            $this->setError('name','name is required for property definition');
        }
        if (!isset($info['slug'])) {
            $this->setError('slug','slug is required for property definition');
        }
        if ($this->validateInfo($info)) {
            if (isset($info['multiple']))
                $this->multiple = (bool)$info['multiple'];
            $this->name = $info['name'];
            $this->slug = $info['slug'];
            $this->assignInfo($info);
        } else {
            throw new \Exception('Invalid Property requested');
        }
    }

    abstract public function assignInfo(array $info);

    public function setError(string $key, string $value): void
    {
        $this->errors[$key][] = $value;
    }

    public function setErrors(array $errors): void
    {
        foreach ($errors as $index => $error) {
            $this->errors[$index] = array_merge($this->errors[$index], $error);
        }
    }

    public function validateInfo(array $info): bool
    {
        return count($this->errors) === 0;
    }

}
