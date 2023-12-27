<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahumumModel extends Model
{
    use HasFactory;
    protected $table = 'sejarah_umum';
    protected $fillable = ['description'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

}
