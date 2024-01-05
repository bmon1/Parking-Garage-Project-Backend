<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'garages';

    // Specify the primary key of the table
    protected $primaryKey = 'id';

    // Define the fillable attributes for mass assignment
    protected $fillable = ['name', 'address', 'total_parking_spots', 'open_parking_spots'];

    // If you don't want timestamps (created_at, updated_at) for this model
    public $timestamps = true;
}