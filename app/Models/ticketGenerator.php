<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ticketGenerator extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id_account',
        'ticket_generator',
        'value',
        'account_number_generator'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
