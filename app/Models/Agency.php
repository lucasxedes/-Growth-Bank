<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agency extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        
        'id_agencia',
        
    ];

    protected $table = [
        'agencies',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public function account(){
        return $this->hasOne(Account::class);
    }
}
