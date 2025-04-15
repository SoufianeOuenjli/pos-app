<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = ['date' => 'datetime'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function modeReglement()
    {
        return $this->belongsTo(ModeReglement::class);
    }

    public function details()
    {
        return $this->hasMany(CommandeDetail::class);
    }

    // Add these accessors
    public function getSubtotalAttribute()
    {
        return $this->details->sum(function($detail) {
            return $detail->prix_ht * $detail->quantite;
        });
    }

    public function getTotalVatAttribute()
    {
        return $this->details->sum(function($detail) {
            return ($detail->prix_ht * $detail->quantite) * ($detail->tva / 100);
        });
    }

    public function getTotalAmountAttribute()
    {
        return $this->subtotal + $this->total_vat - $this->remise;
    }
}
