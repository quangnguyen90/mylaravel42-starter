<?php
class Role extends Eloquent{
		protected $table = 'roles';
		public $timestamps = false;
		protected $guarded = array();
		 
		public function users(){
			return $this->belongsToMany('User');
		}
	}
?>