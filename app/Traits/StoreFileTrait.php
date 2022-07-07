<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait StoreFileTrait
{
    public function storeFile($file): string
    {
        $randomString = Str::random(30);
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $filename = "{$name}_{$randomString}.{$file->getClientOriginalExtension()}";
        $file->storeAs("public/post_images", $filename);

        return $filename;
    }
}
