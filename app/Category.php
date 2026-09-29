<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'integer',
        'level' => 'integer',
        'order' => 'string',
        'haschild' => 'boolean',
        'hasgrand' => 'boolean',
        'addedby_id' => 'integer',
        'editedby_id' => 'integer',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Each category may have one parent
    public function parent() {
        return $this->belongsTo(static::class, 'parent_id');
    }

    // Each category may have one parent
    public function offers() {
        return $this->hasMany('App\Offer', 'display_after','id');
    }
    // Each category may have multiple children
    public function children() {
        return $this->hasMany(static::class, 'parent_id');
    }

    // Each category may have multiple products
    public function products()
    {
        return $this->belongsToMany(Product::class)->with(['stocks','images','tags','category']); //since its a manytomany relation
    }
    public function oldestProducts()
    {
        return $this->belongsToMany(Product::class)->oldest()->with(['stocks','images','tags','category']); //since its a manytomany relation
    }
    public function costlyProducts()
    {
        return $this->belongsToMany(Product::class)->orderBy('sale_price')->with(['stocks','images','tags','category']); //since its a manytomany relation
    }
    public function cheapProducts()
    {
        return $this->belongsToMany(Product::class)->with(['stocks','images','tags','category'])->orderByDesc('sale_price'); //since its a manytomany relation
    }

    public function getRootParent()
    {
        if ($this->parent)
            return $this->parent->getRootParent();

        return $this;
    }

    // // Each category may have multiple children
    // public function childrens() {
    //     return $this->doesntHave('children')->get();
    // }

    // public function products()
    // {
    //     return $this->hasManyThrough('App\Product', 'App\Category','parent_id', 'category_id', 'id');
    // }

    public function getParentsNames() {
        if($this->parent) {
            return $this->title. " > " . $this->parent->getParentsNames() ;
        } else {
            return $this->title;
        }
    }

    public function getParentsNamesWithComma() {
        if($this->parent) {
            return $this->title. ", " . $this->parent->getParentsNamesWithComma() ;
        } else {
            return $this->title;
        }
    }
    public function getParentsSlugWithComma() {
        if($this->parent) {
            return $this->slug. ", " . $this->parent->getParentsSlugWithComma() ;
        } else {
            return $this->slug;
        }
    }

    public function getParentsID() {
        if($this->parent) {
            return $this->id. ", " . $this->parent->getParentsID() ;
        } else {
            return $this->id;
        }
    }

    public static function getAllProducts($category, $products = null)
    {
        if ($products == null) {
            $products = collect();
        }
        $products = $products->merge($category->products);

        foreach($category->children as $child){
            $products = self::getAllProducts($child, $products);
        }

        return $products;
    }

    // public function scopeAllProducts($query)
    // {
    //     return $query->doesntHave('children')->with('products')->get();
    // }


    public function addedBy()
    {
        return $this->belongsTo('App\User','addedby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo('App\User','editedby_id');
    }

    public static function getCategories()
    {
        return static::with('children.children')
        ->whereNull('parent_id')
        ->orderBy('order', 'asc')
        ->get();
    }

    public static function getChildren()
    {
        return static::with('children')
        ->whereNull('parent_id')
        ->orderBy('order')
        ->get();
    }

    public function sliderImages() {
        return $this->hasMany('App\Slider', 'category_id')->where('slider_type','category');
    }
}
