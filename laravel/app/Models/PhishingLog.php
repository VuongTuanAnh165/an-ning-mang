<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhishingLog extends Model
{
    use HasFactory;

    protected $table = 'phishing_logs';

    public $timestamps = true;

    protected $guarded = [];
}
