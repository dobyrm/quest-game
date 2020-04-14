<?php

namespace Services\Storage;

interface StorageInterface
{
    public function set(string $key = '', array $data = []): bool;

    public function destroy(string $key): bool;
}