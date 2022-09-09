<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = [
        'payments'
    ];
    

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}