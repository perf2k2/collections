<?php

namespace perf2k2\collections;

class ListCollection extends Collection
{
    public function contains(int $index): bool
    {
        return \array_key_exists($index, $this->data);
    }

    public function remove(int $index): void
    {
        if ($this->contains($index) === false) {
            throw new \OutOfRangeException("Элемент с индексом {$index} не найден в коллекции");
        }
        
        unset($this->data[$index]);
    }

    public function removeValue($value): void
    {
        if ($this->containsValue($value) === false) {
            throw new \OutOfRangeException("Элемент со значением {$value} не найден в коллекции");
        }

        $index = array_search($value, $this->data, true);
        $this->remove($index);
    }

    public function add($value): void
    {
        $this->data[] = $value;
    }

    public function set(int $index, $value): void
    {
        $this->data[$index] = $value;
    }

    public function get(int $index)
    {
        if ($this->contains($index) === false) {
            throw new \OutOfRangeException("Элемент с индексом {$index} не найден в коллекции");
        }
        
        return $this->data[$index];
    }
}