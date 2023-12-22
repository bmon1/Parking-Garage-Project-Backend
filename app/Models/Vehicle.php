<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;
    // Specify the table associated with the model
    protected $table = 'vehicles';

    // Specify the primary key of the table
    protected $primaryKey = 'id';

    // Define the fillable attributes for mass assignment
    protected $fillable = ['make', 'model', 'year'];

    // If you don't want timestamps (created_at, updated_at) for this model
    public $timestamps = false;
}