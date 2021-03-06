<?php namespace BoundedContext\Collection;

use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Collection\Collection as CollectionContract;
use BoundedContext\ValueObject\Integer;

class Collection implements CollectionContract
{
    private $key;
    private $items;

    public function __construct(array $items = [])
    {

        $this->reset();

        foreach ($items as $item) {
            $this->append($item);
        }
    }

    public function count()
    {
        return new Integer(count($this->items));
    }

    public function reset()
    {
        $this->items = [];
        $this->rewind();
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function is_empty()
    {
        return (count($this->items) == 0);
    }

    public function append(Collectable $c)
    {
        $this->items[] = $c;
    }

    public function append_collection(CollectionContract $other)
    {
        foreach($other as $item)
        {
            $this->items[] = $item;
        }
    }

    public function current()
    {
        return $this->items[$this->key];
    }

    public function key()
    {
        return $this->key;
    }

    public function has_next()
    {
        return isset($this->items[$this->key]);
    }

    public function next()
    {
        $this->key = $this->key + 1;
    }

    public function valid()
    {
        return isset($this->items[$this->key]);
    }

    public function serialize()
    {
        $serialized = [];

        foreach($this as $item)
        {
            $serialized[] = $item->serialize();
        }

        return $serialized;
    }
}
