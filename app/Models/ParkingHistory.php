<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingHistory extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'parking_history';

    // Specify the primary key of the table
    protected $primaryKey = 'id';

    // Define the fillable attributes for mass assignment
    protected $fillable = [];

    // If you don't want timestamps (created_at, updated_at) for this model
    public $timestamps = true;
}
