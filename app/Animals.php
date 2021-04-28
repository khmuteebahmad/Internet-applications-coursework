<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
    protected $fillable = ['name', 'dob', 'description', 'image',];
    
    /**
     * [files description]
     * @return [type] [description]
     */
    public function files()
    {
    	return $this->hasMany(File::class,'animal_id');
    }

    public function firstFile()
    {
    	return $this->files->first()->file;
    }

    /**
     * [requested description]
     * @return integer [description]
     */
    public function requested()
    {
        return $this->requests()->where('username',Auth()->user()->username)->where('accepted','!=','Rejected')->count();
    }

    public function requests()
    {
        return $this->hasMany(AdoptionRequest::class,'animalId');
    }
}
