<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Casts\AsEncryptedArrayObject;
use Illuminate\Database\Eloquent\Casts\AsEncryptedCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    protected $casts = [
        'name' => 'encrypted',
        'description' => 'encrypted',
        'array' => 'encrypted:array',
        'collection' => 'encrypted:collection',
        'object' => 'encrypted:object',
        'as_encrypted_array_object' => AsEncryptedArrayObject::class,
        'as_encrypted_collection' => AsEncryptedCollection::class,
    ];
}
