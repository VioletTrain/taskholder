<?php

namespace Framework\Contract;

interface EntityManager
{
    public function persist($object): void;

    public function flush(): void;

    public function select($select = null): self;

    public function from($from, $alias, $indexBy = null): self;

    public function orderBy($sort, $order = null): self;

    public function paginate(int $perPage, int $currentPage): array;
}