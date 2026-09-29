<?php

namespace App\Http\Controllers\Admin;


use App\Stock;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::latest()->get();

        return view('admin.stocks.index',compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::latest()->get();
        return view('admin.stocks.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = \App\Product::findOrFail($request->input('product_id'));
        $data = $request->validate([
            'product_id' => 'required|integer|max:1000',
            'size' => 'nullable|max:255',
            'color' => 'nullable|max:30',
            'qty' => 'required|max:100000',
            'order' => 'nullable|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=220,min_height=220|max:512',
            'other_images' => 'required',
            'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1024,max_height=720|max:512',
        ]);

        // $product = \DB::table('products')->where('id', $data['product_id'])->first();
            $product = \App\Product::findOrFail($data['product_id']);

        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($product->title, '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());

            $save_path=public_path('img/products/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $featureImageHeight = 220;

            $image->encode('jpg', 100)
                  ->resize(null, $featureImageHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName);
        }

        $featureImage = $ModifiedFileNameWithExtension;

        $images = [];

        // Managing Other Images
        $i=0;
        foreach(request()->other_images as $key => $other_image) {
            // Managing Other Image
            $file = $other_image;

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($product->title, '_').'_'.md5(microtime()). $i++;

            $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.'.$fileExtension;

            $img = \Image::read($file->getRealPath());

            $savePathLarge=public_path('img/products/large/');
            $savePathSmall=public_path('img/products/small/');
            $savePathThumb=public_path('img/products/thumb/');

            if (!file_exists($savePathLarge)) {
                mkdir($savePathLarge, 0777, true);
            }
            if (!file_exists($savePathSmall)) {
                mkdir($savePathSmall, 0777, true);
            }
            if (!file_exists($savePathThumb)) {
                mkdir($savePathThumb, 0777, true);
            }

            $pathWithFileNameLarge = $savePathLarge.$ModifiedFileNameWithExtension;
            $pathWithFileNameSmall = $savePathSmall.$ModifiedFileNameWithExtension;
            $pathWithFileNameThumb = $savePathThumb.$ModifiedFileNameWithExtension;

            //large Image Width & Height
            $largeHeight= 720;

            //Small Image Width & Height
            $smallHeight= 416;

            //Thumb Image Width & Height
            $thumbHeight=100;

            $img->resize(null, $largeHeight, function ($constraint) {
                $constraint->aspectRatio();
              })
            ->encode('jpg', 100)
            ->save($pathWithFileNameLarge)
            ->resize(null, $smallHeight, function ($constraint) {
                $constraint->aspectRatio();
              })
            ->encode('jpg', 100)
            ->save($pathWithFileNameSmall)
            ->resize(null, $thumbHeight, function ($constraint) {
                $constraint->aspectRatio();
              })
            ->encode('jpg', 100)
            ->save($pathWithFileNameThumb);

            array_push($images,$ModifiedFileNameWithExtension);
        }
        unset($i);
        unset($key);

        $collection = collect([$data, $featureImage , $images]);
        // return $collection->all();

        $stock = Stock::create([
            'product_id' => $product->id,
            'size' => isset($data['size']) ? $data['size'] : null,
            'color' => isset($data['color']) ? $data['color'] : null,
            'image' => $featureImage,
            'qty' => $data['qty'],
            'addedby_id' => \Auth::id(),
            'editedby_id' => \Auth::id()
        ]);

        foreach($images as $image) {
            $image = Image::create([
                'stock_id' => $stock->id,
                'image' => $image,
            ]);
        }

        $product = tap($product)->update([
            'qty' => $product->stocks->sum('qty')
        ]);

        return redirect()->route('admin.stocks.create')->with('success','You have successfully added a product stock.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
