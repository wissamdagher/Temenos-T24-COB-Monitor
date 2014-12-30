<?php

class Batch extends \Eloquent {
	protected $fillable = [];

	public function scopeApplication($query)
    {
	return $query->where('batch_stage', 'LIKE', 'A%');
    }

    public function scopeSystem($query)
    {
	return $query->where('batch_stage', 'LIKE', 'S%');
    }

    public function scopeReporting($query)
    {
	return $query->where('batch_stage', 'LIKE', 'R%');
    }

    public function scopeStartofDay($query)
    {
		return $query->where('batch_stage', 'LIKE', 'D%');
    }

    public function scopeOnline($query)
    {
	return $query->where('batch_stage', 'LIKE', 'O%');
    }
}
