<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanFeatures extends Model
{
    use HasFactory;

    public function featureDetails() {
        return $this->belongsTo(SubscriptionFeature::class, 'subscription_feature_id', 'id');
    }
}
