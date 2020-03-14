<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class product
 * @package App\Models
 * @version March 14, 2020, 1:40 am UTC
 *
 * @property string name
 * @property number price
 * @property string description
 */
class product extends Model
{

    public $table = 'products';
    



    public $fillable = [
        'name',
        'price',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'price' => 'required'
    ];

    
}
