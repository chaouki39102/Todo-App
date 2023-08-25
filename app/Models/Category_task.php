<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'task_id',
        'category_id',
    ];
}
