<?php

namespace App\Traits;

use Hashids\Hashids;

trait HasHashedId
{
    /**
     * Get the hashed ID for this model
     */
    public function getHashedIdAttribute()
    {
        $hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
        return $hashids->encode($this->id);
    }

    /**
     * Find model by hashed ID
     */
    public static function findByHashedId($hashedId)
    {
        $id = static::decodeHashedId($hashedId);
        return $id ? static::find($id) : null;
    }

    /**
     * Find model by hashed ID or fail
     */
    public static function findByHashedIdOrFail($hashedId)
    {
        $id = static::decodeHashedId($hashedId);
        if (!$id) {
            abort(404);
        }
        return static::findOrFail($id);
    }

    /**
     * Decode hashed ID to real ID
     */
    public static function decodeHashedId($hashedId)
    {
        $hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
        $decoded = $hashids->decode($hashedId);
        return !empty($decoded) ? $decoded[0] : null;
    }

    /**
     * Encode real ID to hashed ID
     */
    public static function encodeId($id)
    {
        $hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
        return $hashids->encode($id);
    }

    /**
     * Get route key for model binding
     */
    public function getRouteKey()
    {
        return $this->hashed_id;
    }

    /**
     * Resolve route binding
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $id = static::decodeHashedId($value);
        return $id ? $this->where($this->getKeyName(), $id)->first() : null;
    }
}
