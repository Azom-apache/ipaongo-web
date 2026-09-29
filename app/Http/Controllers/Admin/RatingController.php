<?php

namespace App\Http\Controllers\Admin;

use App\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratingReviews = Rating::with('product')->latest()->get();

        return view('admin.ratingsreviews.index',compact('ratingReviews'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $ratingReviews = Rating::with('product')->latest()->where('status',false)->get();

        return view('admin.ratingsreviews.pending',compact('ratingReviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('children')
        ->whereNull('parent_id')
        ->orderBy('title', 'asc')
        ->get();

        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Category::class);
        $data = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|max:2000',
            'description' => 'nullable|max:10000',
            'parent_id' => 'required|integer|max:10000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920,max_height=1920|max:512',
            'slug' => 'nullable|alpha_dash|unique:categories'
        ]);

        $parentCategory = $data['parent_id'] == '0' ? null : Category::find($data['parent_id']);
        $categoryLevel = isset($parentCategory) ? ($parentCategory->level+1) : 1;


        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = Image::read($file->getRealPath());

            $save_path=public_path('img/categories/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $image->encode('jpg', 100)
                  ->resize(null, 270, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName)
                  ->encode('jpg', 0)
                  ->blur(15)
                  ->save($save_path.'lqip_'.$ModifiedFileNameWithExtension,70);
        }


        $category = Category::create([
            'title' => $data['title'],
            'parent_id' => isset($parentCategory) ? $parentCategory->id : null,
            'level' => $categoryLevel,
            'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : null,
            'excerpt' => isset($data['excerpt']) ? $data['excerpt'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'slug' => md5(microtime()),
            'addedby_id' => Auth::id(),
            'editedby_id' => Auth::id(),
        ]);

        if(isset($category->parent_id)){
            if(isset($category->parent->parent_id)){
                $count = Category::where('parent_id', $category->parent_id)->count();
                $order = $count++;
                $slug = str_slug($category->parent->parent->title, '-').'-'.str_slug($category->parent->title, '-').'-'.str_slug($category->title, '-');
            }else{
                $count = Category::where('parent_id', $category->parent_id)->count();
                $order = $count++;
                $slug = str_slug($category->parent->title, '-').'-'.str_slug($category->title, '-');
            }
        }else{
            $count = Category::whereNull('parent_id')->count();
            $order = $count++;
            $slug = str_slug($category->title, '-');
        }

        $category = tap($category)->update([
            'slug' => isset($data['slug']) ? $data['slug'] : $slug,
            'order' => $order
        ]);

        unset($order);

        $rootParent = $category->getRootParent();
        if($category->level == 2 & $rootParent->level==1){
            $rootParent = tap($rootParent)->update([
                'haschild' => true,
            ]);
        } elseif($category->level == 3 & $rootParent->level==1){
            $rootParent = tap($rootParent)->update([
                'hasgrand' => true,
            ]);
        }

        return back()->with('success','You have successfully added a new category.');
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
    public function edit(Rating $ratingReview)
    {
        // $this->authorize('update', Category::class);
        $currentCategory = $category;
        $categories = Category::with('children')
        ->whereNull('parent_id')
        ->orderBy('title', 'asc')
        ->get();

        return view('admin.categories.edit',compact('categories','currentCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $ratingReview)
    {
        // $this->authorize('update', Category::class);

        $data = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|max:2000',
            'description' => 'nullable|max:10000',
            'parent_id' => 'required|integer|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920,max_height=1920|max:512',
            'order' => 'required|integer|max:500',
            'slug' => 'nullable|alpha_dash|unique:categories,slug,'.$category->id
        ]);

        function UnlinkFile($old_file)
        {
            if (file_exists($old_file)) {
               @unlink($old_file);
            }
        }

        $parentCategory = $data['parent_id'] == '0' ? null : Category::find($data['parent_id']);
        $categoryLevel = isset($parentCategory) ? ($parentCategory->level+1) : 1;

        if($request->file('image')) {
            @UnlinkFile(public_path('img/categories/').$category->image);
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());
            $save_path=public_path('img/categories/');
            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $image->encode('jpg', 100)
                  ->resize(null, 270, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                  ->save($pathWithFileName)
                  ->encode('jpg', 0)
                  ->blur(15)
                  ->save($save_path.'lqip_'.$ModifiedFileNameWithExtension,70);
        }

        if($category->order == $data['order']){
            if(isset($category->parent_id)){
                if(isset($category->parent->parent_id)){
                    $count = Category::where('parent_id', $category->parent_id)->count();
                    $order = $count++;
                }else{
                    $count = Category::where('parent_id', $category->parent_id)->count();
                    $order = $count++;
                }
            }else{
                $count = Category::whereNull('parent_id')->count();
                $order = $count++;
            }
        }else{
            $order = $data['order'];
        }


        $category = tap($category)->update([
            'title' => $data['title'],
            'parent_id' => isset($parentCategory) ? $parentCategory->id : null,
            'level' => $categoryLevel,
            'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : $category->image,
            'excerpt' => isset($data['excerpt']) ? $data['excerpt'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'order' => $order,
            'editedby_id' => Auth::id(),
        ]);



        if(isset($category->parent_id)){
            if(isset($category->parent->parent_id)){
                $slug = str_slug($category->parent->parent->title, '-').'-'.str_slug($category->parent->title, '-').'-'.str_slug($category->title, '-');
            }else{
                $slug = str_slug($category->parent->title, '-').'-'.str_slug($category->title, '-');
            }
        }else{
            $slug = str_slug($category->title, '-');
        }

        $category = tap($category)->update([
            'slug' => isset($data['slug']) ? $data['slug'] : $slug,
        ]);

        $rootParent = $category->getRootParent();
        if($category->level == 2 & $rootParent->level==1){
            $rootParent = tap($rootParent)->update([
                'haschild' => true,
            ]);
        } elseif($category->level == 3 & $rootParent->level==1){
            $rootParent = tap($rootParent)->update([
                'hasgrand' => true,
            ]);
        }
        return redirect()->route('admin.categories.index')->with('success','You have successfully updated a category.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, Rating $ratingReview)
    {
        $ratingReview = tap($ratingReview)->update([
            'status' => true,
        ]);

        // return redirect()->route('admin.reviews.index')->with('success','You have successfully approved a review.');
        return back()->with('success','You have successfully approved a review.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disapprove(Request $request, Rating $ratingReview)
    {
        $ratingReview = tap($ratingReview)->update([
            'status' => false,
        ]);

        // return redirect()->route('admin.reviews.index')->with('success','You have successfully disapproved a review.');
        return back()->with('success','You have successfully disapproved a review.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Rating $ratingReview)
    {
        // $this->authorize('delete', Category::class);
        function UnlinkFile($old_file)
        {
            if (file_exists($old_file)) {
               @unlink($old_file);
            }
        }

        @UnlinkFile(public_path('img/reviews/').$ratingReview->image);

        if ($ratingReview->delete()) {
            return redirect()->route('admin.reviews.index')->with('success','You have successfully deleted a review.');
        }
        return redirect()->route('admin.reviews.index')->with('success','You have successfully deleted a review.');
    }
}
