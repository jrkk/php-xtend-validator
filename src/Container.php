<?php

namespace Xtend\Validator;


use Psr\Container\ContainerInterface;

class Container implements ContainerInterface {

    public array $bucket = [];

    public function all(): array 
    {
        return $this->bucket;
    }

    public function set(mixed $id, mixed $value): self 
    {
        $this->bucket[$id] = $value;
        return $this;
    }

    public function has(mixed $id): bool
    {
        return isset($this->bucket[$id]);
    }

    public function get(mixed $id): mixed
    {
        return $this->bucket[$id];
    }

    public function delete(mixed $id): self
    {
        if(isset($this->bucket[$id])) { 
            unset($this->bucket[$id]); 
        }
        return $this;   
    }

    public function flush(): self 
    {
        $this->bucket = [];
        return $this;
    }

}