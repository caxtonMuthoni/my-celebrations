<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class SubscriptionPlan extends Model
{
    use HasFactory, AsSource;

    public function features() {
        return $this->hasMany(SubscriptionPlanFeatures::class);
    }
}
