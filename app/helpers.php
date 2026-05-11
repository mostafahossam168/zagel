<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('store_file')) {
    function store_file($file, $path)
    {
        $name = time() . $file->getClientOriginalName();
        return $file->storeAs($path, $name, 'uploads');
    }
}

if (!function_exists('delete_file')) {
    function delete_file($file)
    {
        if ($file != '' and !is_null($file) and Storage::disk('uploads')->exists($file)) {
            unlink('uploads/' . $file);
        }
    }
}

if (!function_exists('display_file')) {
    function display_file($name)
    {
        return asset('uploads') . '/' . $name;
    }
}

if (!function_exists('countUser')) {
    function countUser()
    {
        return App\Models\User::count();
    }
}
