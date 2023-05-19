<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const roleStatus = [
        1 => "Active",
        0 => "Inactive",
    ];
    use HasFactory;
}
