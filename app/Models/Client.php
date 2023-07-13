<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Fillable field in the model (database table)
    protected $fillable = ["numCompte", "nom", "solde", "observation"];

    protected $table = "clients";
}
