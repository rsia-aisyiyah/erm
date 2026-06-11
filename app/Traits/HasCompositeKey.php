<?php
namespace App\Traits;
trait HasCompositeKey
{
    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->getKeyName() as $key) {
            $query->where(
                $key,
                $this->getAttribute($key)
            );
        }

        return $query;
    }
}