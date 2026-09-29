<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use App\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $offers = Offer::latest()->get();

        return view('admin.offers.index',compact('categories','offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status','2')
        ->orderBy('title', 'asc')
        ->get();

        $allCategories = Category::with('children.children')
        ->whereNull('parent_id')
        ->orderBy('order')
        ->get();

        $products = Product::latest()->get();

        return view('admin.offers.create',compact('categories','allCategories','products'));
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
            'excerpt' => 'nullable|max:10000',
            'category' => 'nullable|integer|max:10000',
            'product' => 'nullable|integer|max:3',
            'products' => 'nullable|array|min:1',
            'url' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920,max_height=1920,min_height=515|max:512',
            'slug' => 'nullable|alpha_dash'
        ]);

        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());

            $save_path=public_path('img/offers/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $image->encode('jpg', 100)
                  ->resize(null, 480, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName);
        }


        $offer = Offer::create([
            'title' => $data['title'],
            'category' => isset($data['category']) ? $data['category'] : null,
            'url' => isset($data['excerpt']) ? $data['excerpt'] : null,
            //'url' => isset($data['url']) ? $data['url'] : null,
            'products' =>  isset($data['products']) ? implode(",",$data['products']) : null,
            'image' =>  isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : null,
            'slug' => isset($data['slug']) ? $data['slug'] : str_slug($data['title'], '-'),
            'addedby_id' => Auth::id(),
            'editedby_id' => Auth::id(),
        ]);

        $count = Offer::count();
        $order = $count++;

        $offer = tap($offer)->update([
            'order' => $order
        ]);

        return back()->with('success','You have successfully added a new event.');
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
    public function edit(Offer $offer)
    {
        $categories = Category::where('status','2')
        ->orderBy('title', 'asc')
        ->get();

        $allCategories = Category::with('children.children')
        ->whereNull('parent_id')
        ->orderBy('order')
        ->get();

        $products = Product::latest()->get();

        $offeredProducts = isset($offer->products) ? explode(",",$offer->products) : [];

        return view('admin.offers.edit',compact('offer','categories','allCategories','products','offeredProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category' => 'nullable|integer|max:10000',
            'product' => 'nullable|integer|max:3',
            'products' => 'nullable|array|min:1',
            'url' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920,max_height=1920,min_height=515|max:512',
            'slug' => 'nullable|alpha_dash',
            'order' => 'nullable|max:255',
        ]);

        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());

            $save_path=public_path('img/offers/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $image->encode('jpg', 100)
                  ->resize(null, 515, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName);
        }

        $offer = tap($offer)->update([
            'title' => $data['title'],
            'category' => isset($data['category']) ? $data['category'] : null,
            'product' => isset($data['product']) ? $data['product'] : null,
            'url' => isset($data['url']) ? $data['url'] : null,
            'products' =>  isset($data['products']) ? implode(",",$data['products']) : null,
            'image' =>  isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : $offer->image,
            'slug' => isset($data['slug']) ? $data['slug'] : str_slug($data['title'], '-'),
            'order' => isset($data['order']) ? $ModifiedFileNameWithExtension : $offer->image,
            'editedby_id' => Auth::id(),
        ]);


        return redirect()->route('admin.offers.index')->with('success','You have successfully updated an event.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        if ($offer->delete()) {
            return redirect()->route('admin.offers.index')->with('success','You have successfully deleted an event.');
        }
        return redirect()->route('admin.offers.index')->with('success','You have successfully deleted an event.');
    }
}
