<?php namespace BoundedContext\Sourced\Aggregate\Stream;

use BoundedContext\Contracts\Sourced\Aggregate\Stream\Factory as StreamFactory;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Integer as Integer_;

class Builder implements \BoundedContext\Contracts\Sourced\Aggregate\Stream\Builder
{
    private $stream_factory;

    private $id;
    private $version;
    private $limit;
    private $chunk_size;

    public function __construct(
        IdentifierGenerator $generator,
        StreamFactory $stream_factory
    )
    {
        $this->stream_factory = $stream_factory;

        $this->id = $generator->null();
        $this->version = new Integer_();
        $this->limit = new Integer_(1000);
        $this->chunk_size = new Integer_(1000);
    }

    public function after(Integer_ $version)
    {
        $this->version = $version;

        return $this;
    }

    public function with(Identifier $id)
    {
        $this->id = $id;

        return $this;
    }

    public function limit(Integer_ $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    public function chunk(Integer_ $size)
    {
        $this->chunk_size = $size;

        return $this;
    }

    public function stream()
    {
        return $this->stream_factory->create(
            $this->id,
            $this->version,
            $this->limit,
            $this->chunk_size
        );
    }
}
