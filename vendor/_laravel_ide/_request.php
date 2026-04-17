<?php

namespace Illuminate\Http;

interface Request
{
    /**
     * @return \App\Models\accounts\User|null
     */
    public function user($guard = null);
}