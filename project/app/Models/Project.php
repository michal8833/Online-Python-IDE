<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    use HasFactory;

    public function files() {

        return $this->hasMany(File::class);
    }

    public function user() {

        return $this->belongsTo(User::class);
    }
}
