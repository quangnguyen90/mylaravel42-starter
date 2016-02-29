<?php
class Product extends Eloquent {
 
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';
    public $timestamps = false;
    protected $guarded = array();

    public function cate()
    {
        return $this->belongsTo('Cate');
    }
}