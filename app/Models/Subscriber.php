<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Subscriber extends Model
{
    use HasFactory, AsSource;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function subscriptionPlan() {
        return $this->belongsTo(SubscriptionPlan::class);
    }
}
