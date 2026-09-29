<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\News;
use Intervention\Image\ImageManager;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('order')->latest()->get();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.addNews');
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
            'type' => 'required|max:25',
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'excerpt' => 'nullable|max:300',
            'description' => 'nullable|max:10000',
            'slug' => 'nullable|alpha_dash|unique:news'
        ]);


        if ($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = Str::slug($data['title'], '_') . '_' . md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension . '.jpg';

            $image = ImageManager::gd()->read($file->getRealPath());

            $save_path = public_path('images/news/');
            $pathWithFileName = $save_path . $ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $image->toJpeg(75)
                ->save($pathWithFileName);
        }

        $news = News::create([
            'title' => $data['title'],
            'excerpt' => isset($data['excerpt']) ?  $data['excerpt'] : null,
            'description' => isset($data['description']) ?  $data['description'] : null,
            'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : null,
            'type' => $data['type'],
            'slug' => isset($data['slug']) ? $data['slug'] : Str::slug($data['title'], '-'),
            'addedby_id' => Auth::id(),
            'editedby_id' => Auth::id(),
        ]);

        $news = tap($news)->update([
            'order' => $news->id
        ]);


        return back()->with('success', 'You have successfully publish a notice.');
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
    public function edit(News $news)
    {
        return view('admin.news.editNews', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'excerpt' => 'nullable|max:300',
            'description' => 'nullable|max:10000',
            'order' => 'required|integer|max:500',
            'slug' => 'nullable|alpha_dash|unique:news,slug,' . $news->id

        ]);

        if ($request->file('image')) {
            function UnlinkImage($old_image)
            {
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
            }

            UnlinkImage(public_path('images/news/') . $news->image);
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = Str::slug($data['title'], '_') . '_' . md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension . '.jpg';

            $img = ImageManager::gd()->read($file->getRealPath());
            $save_path = public_path('images/news/');
            $pathWithFileName = $save_path . $ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $img->toJpeg(75)
                ->save($pathWithFileName);
        }


        $news = tap($news)->update([
            'title' => $data['title'],
            'excerpt' => isset($data['excerpt']) ?  $data['excerpt'] : null,
            'description' => isset($data['description']) ?  $data['description'] : null,
            'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : $news->image,
            'slug' => isset($data['slug']) ? $data['slug'] : Str::slug($data['title'], '-'),
            'order' => $data['order'],
            'editedby_id' => Auth::id(),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'You have successfully updated a notice.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, News $news)
    {
        function UnlinkImage($old_image)
        {
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
        }

        UnlinkImage(public_path('images/news/' . $news->image));

        if ($news->delete()) {
            return redirect()->back()->with('success', 'You have successfully deleted a notice.');;
        }
        return redirect()->route('admin.news.index');
    }
}
