<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faqs extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'status',
        'title',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
