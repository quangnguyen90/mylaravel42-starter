<?php
class Cate extends Eloquent{
 
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cates';
    public $timestamps = false;
    protected $guarded = array();
     
    public function products(){
        return $this->hasMany('Product');
    }
}