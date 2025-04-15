<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommandeDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Define the relationship with the Commande model
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
    // Define the relationship with the Article model
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
