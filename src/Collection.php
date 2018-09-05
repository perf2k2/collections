<?php

namespace perf2k2\collections;

/**
 * Базовый класс для хранения коллекций разных типов
 * @package app\core\domain\collections
 */
abstract class Collection implements \IteratorAggregate
{
    protected $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    public function count(): int
    {
        return \count($this->data);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function first()
    {
        return \reset($this->data);
    }

    public function last()
    {
        return \end($this->data);
    }

    public function each(): \Generator
    {
        foreach ($this->data as $key => $value) {
            yield $key => $value;
        }
    }

    public function sortByValues(): void
    {
        \asort($this->data);
    }

    public function sortByKeys(): void
    {
        \ksort($this->data);
    }

    public function getRandom()
    {
        return \array_rand($this->data);
    }

    public function getSlice(int $start, int $size): array
    {
        return \array_slice($this->data, $start, $size);
    }
    
    public function slice(int $start, int $size, bool $preserveKeys = false): void
    {
        $this->data = \array_slice($this->data, $start, $size, $preserveKeys);
    }
    
    public function batch($size = 100, $preserveKeys = false): \Generator
    {
        $chunks = \array_chunk($this->data, $size, $preserveKeys);

        foreach ($chunks as $number => $chunk) {
            yield $number => new static($chunk);
        }
    }
    
    public function asArray(): array
    {
        return $this->data;
    }

    public function getKeys(): array
    {
        return \array_keys($this->data);
    }
    
    public function getValues(): array
    {
        return \array_values($this->data);
    }

    public function containsValue($value): bool
    {
        return \in_array($value, $this->data, true);
    }

    public function merge(Collection $collection): void
    {
        $this->data = array_merge($this->data, $collection->asArray());
    }

    public function clear(): void
    {
        $this->data = [];
    }
}