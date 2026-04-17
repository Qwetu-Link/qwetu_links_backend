<?php

namespace Illuminate\Support\Facades;

interface Auth
{
    /**
     * @return \App\Models\accounts\User|false
     */
    public static function loginUsingId(mixed $id, bool $remember = false);

    /**
     * @return \App\Models\accounts\User|false
     */
    public static function onceUsingId(mixed $id);

    /**
     * @return \App\Models\accounts\User|null
     */
    public static function getUser();

    /**
     * @return \App\Models\accounts\User
     */
    public static function authenticate();

    /**
     * @return \App\Models\accounts\User|null
     */
    public static function user();

    /**
     * @return \App\Models\accounts\User|null
     */
    public static function logoutOtherDevices(string $password);

    /**
     * @return \App\Models\accounts\User
     */
    public static function getLastAttempted();
}