<?php namespace Jacob\Hair\Models;

use Model;

/**
 * Enquiry Model
 */
class Enquiry extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'jacob_hair_enquiries';

    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'comment' => 'required'  
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['id'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}