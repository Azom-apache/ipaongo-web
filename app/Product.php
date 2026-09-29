<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hassize' => 'boolean',
        'hascolor' => 'boolean',
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'order' => 'integer',
        'discount_type' => 'boolean',
        'hasdeliverydays' => 'boolean',
        'addedby_id' => 'integer',
        'editedby_id' => 'integer',
        'sale_price' => 'integer'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $with = ['parent','ratings','images','categories','tags','stocks'];
    protected $appends = ['url','feature_image','related_product_count','total_rating','average_rating'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getFeatureImageAttribute()
    {
        return asset('img/products/'.$this->image);
    }
    public function getUrlAttribute()
    {
        return route('products.show',[$this->id,$this->slug]);
    }
    public function getRelatedProductCountAttribute()
    {
        return static::where('code',$this->code)->count();
    }


    public function getTotalRatingAttribute()
    {
        return $this->ratings()->whereNotNull('rating')->count();
    }
    public function getAverageRatingAttribute()
    {
        return round($this->ratings->average('rating'),2);
    }

    public function getTotalReviewAttribute()
    {
        return $this->ratings()->whereNotNull('review')->count();
    }

    public function getTextReviewAttribute()
    {
        return $this->ratings()->latest()->whereNotNull('review')->get();
    }
    public function getReviewImagesAttribute()
    {
        return $this->ratings()->whereNotNull('image')->get();
    }

    public function getFiveStarAttribute()
    {
        return $this->ratings()->where('rating','=',5)->count();
    }
    public function getFourStarAttribute()
    {
        return $this->ratings()->where('rating','=',4)->count();
    }
    public function getThreeStarAttribute()
    {
        return $this->ratings()->where('rating','=',3)->count();
    }
    public function getTwoStarAttribute()
    {
        return $this->ratings()->where('rating','=',2)->count();
    }
    public function getOneStarAttribute()
    {
        return $this->ratings()->where('rating','=',1)->count();
    }

    public function getHighestStarCountAttribute()
    {
        $highest_value = $this->ratings()->where('rating','=',1)->count();
        for($i=2;$i<=5;$i++)
        {
            $value= $this->ratings()->where('rating','=',$i)->count();
            if ($value > $highest_value) {
                $highest_value = $value;
            }
        }
        return $highest_value;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class)->orderByDESC('id');
    }


    // each product might have many product images
    public function stocks()
    {
        return $this->hasMany(Stock::class,'product_id');
    }

    //each product might have one parent category
    public function parent() {
        return $this->belongsTo('App\Category', 'category_id');
    }


    //each product might have one parent category
    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class); //since its a manytomany relation
    }

    public function relatedProducts()
    {
        // return $this->hasMany(static::class,'code');
        // return $this->hasMany(static::class, 'code');
        // return $this->hasMany(Product::class)->where('type','other');
    }


    public function getRelatedProducts() {
        return \App\Product::where('code',$this->code)->get();
    }

    public function getRelatedProductsCount() {
        return \App\Product::where('code',$this->code)->count();
    }

    // each product might have one feature image
    // public function featureImage()
    // {
    //     return $this->hasOne(ProductImage::class,'product_id')->where('type','feature');
    // }

    // each product might have many product images
    // public function productImages()
    // {
    //     return $this->hasMany(ProductImage::class,'product_id')->where('type','other');
    // }

    // public function sliderImage() {
    //     return $this->hasOne('App\ProductImage', 'product_id')->where('type','slider');
    // }

    //each product might have one brand
    public function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    // each product might belongs to an user
    public function addedBy()
    {
        return $this->belongsTo('App\User','addedby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo('App\User','editedby_id');
    }

    // each product might have many Product_Sizes
    // public function productSizes()
    // {
    //     return $this->hasMany(ProductSize::class,'product_id');
    // }

    // each product might have many Product_Colors
    // public function productColors()
    // {
    //     return $this->hasMany(ProductSize::class,'product_id');
    // }

    // //each category might have one parent
    // public function parent() {
    //     // return $this->belongsTo(static::class, 'category_parent_id');
    //     return $this->belongsTo(Category::class,'category_parent_id')->with('parent');
    // }

    // public function sliders()
    // {
    //     return $this->belongsToMany(Slider::class); //since its a manytomany relation
    // }

}
