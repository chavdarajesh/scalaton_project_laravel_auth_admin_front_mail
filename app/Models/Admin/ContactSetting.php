<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactSetting extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'map_iframe',
        'location',
        'email',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function get_contact_us_details()
    {
        return ContactSetting::where('static_id', 1)->where('status', 1)->first();
    }
}
