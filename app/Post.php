<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $table = 'posts2';
    protected $primarykey = 'id';
    protected $fillable = ['title', 'slug', 'body', 'image','category_id'];

        public function getImageUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $imagePath = public_path() . "/blog/img/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("blog/img/" . $this->image);
        }

        return $imageUrl;
    }


public function author(){
    return $this->belongsTo(User::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function scopePopular($query)
{
    return $query->orderBy('view_count','desc');
}




}
