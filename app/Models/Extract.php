<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extract extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = [
        'extracts'
    ];
    

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
