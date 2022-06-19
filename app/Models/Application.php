<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [];
    protected $guarded = [];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function shops() {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function type_accidents() {
        return $this->belongsTo(TypeAccident::class, 'type_accident_id', 'id');
    }

    public function statuses() {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
