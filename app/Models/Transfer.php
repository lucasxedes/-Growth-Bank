<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transfer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id_account',
        'value',
        'account_received'
    ];
    

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
