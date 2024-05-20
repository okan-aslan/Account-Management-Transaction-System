<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutomaticPayment extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'amount', 'frequency', 'start_date', 'end_date'];

    public function account():BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
