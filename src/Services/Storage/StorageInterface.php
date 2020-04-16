<?php

namespace Services\Storage;

interface StorageInterface
{
    public function set(string $key = '', $data = null): bool;

    public function destroy(string $key): bool;
}