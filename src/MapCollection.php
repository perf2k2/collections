<?php

namespace perf2k2\collections;

/**
 * Хеш-таблица
 * @package app\core\domain\collections
 */
class MapCollection extends Collection
{
    public function add($key, $value): void
    {
        if ($this->contains($key)) {
            throw new \UnexpectedValueException('Элемент с ключом ' . $key . ' уже есть в коллекции');
        }
        
        $this->set($key, $value);
    }

    public function set($key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function get($key)
    {
        if (!$this->contains($key)) {
            throw new \OutOfRangeException("Элемент с ключом {$key} не найден в коллекции");
        }

        return $this->data[$key];
    }

    public function remove($key): void
    {
        if (!$this->contains($key)) {
            throw new \OutOfRangeException("Элемент с индексом {$key} не найден в коллекции");
        }

        unset($this->data[$key]);
    }

    public function removeValue($value): void
    {
        if ($this->containsValue($value) === false) {
            throw new \OutOfRangeException("Элемент со значением {$value} не найден в коллекции");
        }

        $index = array_search($value, $this->data, true);
        $this->remove($index);
    }

    public function contains($key): bool
    {
        return \array_key_exists($key, $this->data);
    }
}