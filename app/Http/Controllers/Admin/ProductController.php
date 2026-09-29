<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Brand;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->with(['stocks','images','tags'])->get();

        // return $products[0]->stocks;

        // return $products[0]->stocks->implode('qty size', ', ');


        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('parent.parent')->withCount('children')
        ->orderBy('title', 'asc')
        ->get()
        ->filter(function ($value, $key) {
            return $value->children_count == 0;
         });

        $brands = Brand::latest()->get();

        return view('admin.products.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'tag' => 'nullable|max:1000',
            'code' => 'required|max:255',
            'color' => 'required|max:255',
            'total_qty' => 'required|integer|max:100000',
            "stock"    => "nullable|array|min:1",
            "stock.size.*"    => "required_with:stock|distinct",
            "stock.qty.*"    => "required_with:stock",
            'brand_id' => 'nullable|integer|max:2000',
            'price' => 'required|numeric|max:1000000',
            'discount_type' => 'required|boolean',
            'discount_amount' => 'required|numeric|max:1000000',
            'excerpt' => 'nullable|max:2000',
            'deliverydays' => 'nullable|max:255',
            'description' => 'nullable|max:10000',
            'category_id' => 'required|integer|max:10000',
            'category_id' => 'required|integer|max:10000',
            'order' => 'nullable|string|max:500',
            'slug' => 'nullable|alpha_dash',
            'size_chart' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920|max:1024',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=220,min_height=220|max:1024',
            'other_images' => 'required',
            'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920|max:1024',
        ]);

        // try to retrive parent categories
        $productCategory = \App\Category::findOrFail($data['category_id']);
        $parentCategories= explode(', ', $productCategory->getParentsID());

        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());

            $save_path=public_path('img/products/');
            $save_path_thumb=public_path('img/products/thumbnails/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $featureImageHeight = 150;

            $featureImageHeight = 150;

            $image->encode('jpg', 100)
                  ->resize(null, $featureImageHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName)
                  ->encode('jpg', 0)
                  ->blur(15)
                  ->save($save_path.'lqip_'.$ModifiedFileNameWithExtension,70);
        }

        $featureImage = $ModifiedFileNameWithExtension;

        if($request->file('size_chart')) {
            $file = $request->file('size_chart');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = 'chart_'.str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());

            $save_path=public_path('img/products/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $image->encode('jpg', 100)
                  ->resize(null, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName);

            $sizeChart = $ModifiedFileNameWithExtension;
        }

        $images = [];

        // Managing Other Images
        $i=0;
        foreach(request()->other_images as $key => $other_image) {
            // Managing Other Image
            $file = $other_image;

            $fileNameWithExtension = $file->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime()). $i++;

            $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $img = \Image::read($file->getRealPath());

            $save_path=public_path('img/products/');


            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            //large Image Width & Height
            $largeHeight= 720;

            //Small Image Width & Height
            $smallHeight= 416;

            //Thumb Image Width & Height
            $thumbHeight=100;

            // Encoding Large Image
            $img->encode('jpg', 100)
            ->resize(1664, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($save_path.'lg_'.$ModifiedFileNameWithExtension)

            // Encoding Small Image
            ->resize(null, $smallHeight, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($save_path.'sm_'.$ModifiedFileNameWithExtension)

            // Encoding Thumb Image
            ->resize(null, $thumbHeight, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($save_path.'thumb_'.$ModifiedFileNameWithExtension);

            array_push($images,$ModifiedFileNameWithExtension);
        }
        unset($i);
        unset($key);

        //Populating Pivot Tables


        // $product->categories()->attach($parentCategories);
        if(isset($data['stock'])){
            $collection = collect([$data['stock']]);
        }


        $collection = collect([
            'data'=>$data ,
            'sizes'=> isset($data['stock']) ? $data['stock']['size'] : null,
            'qty'=> isset($data['stock']) ? $data['stock']['qty'] : null,
            'categories'=> $parentCategories,
            'featureImage'=> $featureImage ,
            'images'=>$images
        ])->toArray();

        // dd($value = $collection['data']['title']);

        if($data['discount_type']){
            // if discount amount percentage(%)
            $sale_price  = (float)$collection['data']['price'] - ((float)$collection['data']['price'] * (float)$collection['data']['discount_amount']/100);
            $sale_price  = round($sale_price, 2);
        } else{
            // if discount amount percentage(%)
            $sale_price = (float)$collection['data']['price'] - (float)$collection['data']['discount_amount'];
        }


        // $discount_amount = ((float)$collection['data']['discount_amount'] * 100) / (float)$collection['data']['price'];
        // $sale_price = (float)$collection['data']['price'] - (float)$collection['data']['discount_amount'];

        // return $sale_price;

        // Add Product Info to Products table
        $product= Product::create([
            'title' => $data['title'],
            'code' => $data['code'],
            'color' => $data['color'],
            'hassize' => isset($data['stock']) ? true : false,
            'total_qty' => $data['total_qty'],
            'category_id' => isset($data['category_id']) ? $data['category_id'] : null ,
            'brand_id' => isset($data['brand_id']) && $data['brand_id']!=0 ? $data['brand_id'] : null ,
            'regular_price' => $data['price'],
            'sale_price' => $sale_price,
            'discount_type' => $data['discount_type'],
            'discount_amount' => $data['discount_amount'],
            'hasdeliverydays' => isset($data['deliverydays']) ? true : false,
            'deliverydays' => isset($data['deliverydays']) ? $data['deliverydays'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'size_chart' => $request->file('size_chart') ? $sizeChart : null,
            'image' => $collection['featureImage'],
            'slug' => str_slug($data['title'], '-'),
            'addedby_id' => Auth::id(),
            'editedby_id' => Auth::id(),
        ]);


        $product = tap($product)->update([
            'order' => $product->id
        ]);

        if(isset($data['tag'])){
            $tags = array_map('trim', explode(',', $data['tag']));
            $tagsIDs = [];
            foreach($tags as $tag){
                $currentTag = \App\Tag::firstOrCreate(['name' => $tag,'slug'=>str_slug($tag, '-')]);
                array_push($tagsIDs, $currentTag->id);
            }

            // $tagsIDs = implode(",", $tagsIDs);
            $product->tags()->attach($tagsIDs);
        }

        if(isset($data['stock'])){
            for($j=0;$j<count($data['stock']['qty']);$j++){
                $stock = \App\Stock::create([
                    'product_id' => $product->id,
                    'size' => $data['stock']['size'][$j],
                    'qty' => $data['stock']['qty'][$j],
                    'addedby_id' => Auth::id(),
                    'editedby_id' => Auth::id()
                ]);
            }
            $totalQty = \App\Stock::where('product_id', $product->id)->sum('qty');

            $product = tap($product)->update([
                'total_qty' => $totalQty
            ]);
        }

        for($k=0;$k<count($collection['images']);$k++){
            $image = \App\Image::create([
                'image' => $collection['images'][$k],
            ]);
            $product->images()->attach($image);
        }


        $product->categories()->attach($parentCategories);


        return redirect()->route('admin.products.create')->with('success','You have successfully added a product: <a href="'.route('products.show',[$product->id,$product->slug]).'" target="_blank">'.$product->title.' ('.$product->code.')</a>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::with('parent.parent')->withCount('children')
        ->orderBy('title', 'asc')
        ->get()
        ->filter(function ($value, $key) {
            return $value->children_count == 0;
         });

        $brands = Brand::latest()->get();


        return view('admin.products.show',compact('categories','brands','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::with('parent.parent')->withCount('children')
        ->orderBy('title', 'asc')
        ->get()
        ->filter(function ($value, $key) {
            return $value->children_count == 0;
         });

        $brands = Brand::latest()->get();

        return view('admin.products.edit',compact('categories','brands','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'tag' => 'nullable|max:1000',
            'code' => 'required|max:255',
            'color' => 'required|max:255',
            'total_qty' => 'required|integer|max:100000',
            "stock"    => "nullable|array|min:1",
            "stock.size.*"    => "required_with:stock|distinct",
            "stock.qty.*"    => "required_with:stock",
            'brand_id' => 'nullable|integer|max:2000',
            'price' => 'required|numeric|max:1000000',
            'discount_type' => 'required|boolean',
            'discount_amount' => 'required|numeric|max:1000000',
            'excerpt' => 'nullable|max:2000',
            'description' => 'nullable|max:10000',
            'category_id' => 'required|integer|max:10000',
            'category_id' => 'required|integer|max:10000',
            'deliverydays' => 'nullable|max:255',
            'order' => 'nullable|string|max:500',
            'slug' => 'nullable|alpha_dash',
            'size_chart' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:dimensions:max_width=1920|max:1024',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=220,min_height=220|max:1024',
            'other_images' => 'nullable',
            'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920|max:1024',
        ]);

        // try to retrive parent categories
        $productCategory = \App\Category::findOrFail($data['category_id']);
        $parentCategories= explode(', ', $productCategory->getParentsID());


        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());

            $save_path=public_path('img/products/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $featureImageHeight = 150;

            $image->encode('jpg', 100)
                  ->resize(null, $featureImageHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName)
                  ->encode('jpg', 0)
                  ->blur(15)
                  ->save($save_path.'lqip_'.$ModifiedFileNameWithExtension,70);

            $featureImage = $ModifiedFileNameWithExtension;

        }

        if($request->file('size_chart')) {
            $file = $request->file('size_chart');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = 'chart_'.str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());

            $save_path=public_path('img/products/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $image->encode('jpg', 100)
                  ->resize(null, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName);

            $sizeChart = $ModifiedFileNameWithExtension;
        }

        $images = [];

        if(isset(request()->other_images)){
            // Managing Other Images
            $i=0;
            foreach(request()->other_images as $key => $other_image) {
                // Managing Other Image
                $file = $other_image;

                $fileNameWithExtension = $file->getClientOriginalName();

                echo $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime()). $i++;

                $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

                $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

                $img = \Image::read($file->getRealPath());

                $save_path=public_path('img/products/');


                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }

                //large Image Width & Height
                $largeHeight= 720;

                //Small Image Width & Height
                $smallHeight= 416;

                //Thumb Image Width & Height
                $thumbHeight=100;

                // Encoding Large Image
                $img->encode('jpg', 100)
                ->resize(1664, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($save_path.'lg_'.$ModifiedFileNameWithExtension)

                // Encoding Small Image
                ->resize(null, $smallHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($save_path.'sm_'.$ModifiedFileNameWithExtension)

                // Encoding Thumb Image
                ->resize(null, $thumbHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($save_path.'thumb_'.$ModifiedFileNameWithExtension);

                array_push($images,$ModifiedFileNameWithExtension);
            }
            unset($i);
            unset($key);
        }


        //Populating Pivot Tables


        // $product->categories()->attach($parentCategories);

        if(isset($data['stock'])){
            $collection = collect([$data['stock']]);
        }

        $collection = collect([
            'data'=>$data ,
            'sizes'=> isset($data['stock']) ? $data['stock']['size'] : null,
            'qty'=> isset($data['stock']) ? $data['stock']['qty'] : null,
            'categories'=>$parentCategories,
            'featureImage'=> $request->file('image') ?  $featureImage : $product->image ,
            'images'=>$images
        ])->toArray();

        // dd($value = $collection['data']['title']);

        if($data['discount_type']){
            // if discount amount percentage(%)
            $sale_price  = (float)$collection['data']['price'] - ((float)$collection['data']['price'] * (float)$collection['data']['discount_amount']/100);
            $sale_price  = round($sale_price, 2);
        } else{
            // if discount amount percentage(%)
            $sale_price = (float)$collection['data']['price'] - (float)$collection['data']['discount_amount'];
        }
        // Add Product Info to Products table
        $product = tap($product)->update([
            'title' => $data['title'],
            'code' => $data['code'],
            'color' => $data['color'],
            'hassize' => isset($data['stock']) ? true : false,
            'total_qty' => $data['total_qty'],
            'category_id' => isset($data['category_id']) ? $data['category_id'] : null ,
            'brand_id' => isset($data['brand_id']) && $data['brand_id']!=0 ? $data['brand_id'] : null ,
            'regular_price' => $data['price'],
            'sale_price' => $sale_price,
            'discount_type' => $data['discount_type'],
            'discount_amount' => $data['discount_amount'],
            'hasdeliverydays' => isset($data['deliverydays']) ? true : false,
            'deliverydays' => isset($data['deliverydays']) ? $data['deliverydays'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'image' => $collection['featureImage'],
            'size_chart' => $request->file('size_chart') ? $sizeChart : $product->size_chart,
            'slug' => str_slug($data['title'], '-'),
            'editedby_id' => Auth::id(),
            'order' => $product->id
        ]);

        if(isset($data['tag'])){
            $tags = array_map('trim', explode(',', $data['tag']));
            $tagsIDs = [];
            foreach($tags as $tag){
                $currentTag = \App\Tag::firstOrCreate(['name' => $tag,'slug'=>str_slug($tag, '-')]);
                array_push($tagsIDs, $currentTag->id);
            }

            // $tagsIDs = implode(",", $tagsIDs);
            $product->tags()->sync($tagsIDs);
        }


        $deletedStocks = \App\Stock::where('product_id', $product->id)->delete();

        if(isset($data['stock'])){
            for($j=0;$j<count($data['stock']['qty']);$j++){
                $stock = \App\Stock::create([
                    'product_id' => $product->id,
                    'size' => $data['stock']['size'][$j],
                    'qty' => $data['stock']['qty'][$j],
                    'addedby_id' => Auth::id(),
                    'editedby_id' => Auth::id()
                ]);
            }
            $totalQty = \App\Stock::where('product_id', $product->id)->sum('qty');

            $product = tap($product)->update([
                'total_qty' => $totalQty
            ]);
        }

        if(isset(request()->other_images)){
            $product->images()->detach();
            for($k=0;$k<count($collection['images']);$k++){
                $image = \App\Image::create([
                    'image' => $collection['images'][$k],
                ]);
                $product->images()->attach($image);
            }
        }


        $product->categories()->sync($parentCategories);


        return redirect()->route('admin.products.index')->with('success','You have successfully updated a product: <a href="'.route('products.show',[$product->id,$product->slug]).'" target="_blank">'.$product->title.' ('.$product->code.')</a>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {

        if ($product->delete()) {
            return redirect()->route('admin.products.index')->with('success','You have successfully deleted a product.');
        }

        return redirect()->back();
    }

    public function images(Request $request, Product $product){
        return view('admin.products.images',compact('product'));
    }

    public function updateImages(Request $request, Product $product, \App\Image $image){
        $data = $request->validate([
            'order' => 'required|integer',
        ]);

        $image = tap($image)->update([
            'order' => $data['order']
        ]);

        return redirect()->route('admin.products.images.index',$product->id)->with('success','You have successfully updated an image.');
    }

    public function destroyImages(Request $request, Product $product, \App\Image $image){

        if(count($product->images)<=1) {
            return redirect()->route('admin.products.images.index',$product->id)->with('error','Sorry! You cannot delete image when only one image left.');
        }else{
            if($product->delete()) {
                return redirect()->route('admin.products.images.index')->with('success','You have successfully deleted a product image.');
            }
            return redirect()->route('admin.products.images.index')->with('success','You have successfully deleted a product image.');
        }

        return redirect()->back();
    }
}
