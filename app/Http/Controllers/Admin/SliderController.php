<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use App\Offer;

class SliderController extends Controller
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
        $sliders = Slider::orderby('order')->get();

        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offers = Offer::latest()->get();
        return view('admin.sliders.create',compact('offers'));
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
            'title' => 'nullable',
            'type' => 'required|string|max:255',
            'offer_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);


        $offer = Offer::findOrFail($data['offer_id']);

        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($offer->title, '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $img = \Image::read($file->getRealPath());

            $save_path=public_path('img/sliders/');
            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $img->encode('jpg', 100)
            ->resize(null, 279, function ($constraint) {
                  $constraint->aspectRatio();
              })
            ->save($pathWithFileName);
        }

        $slider = Slider::create([
            'title' => isset($data['title']) ? $data['title'] : $offer->title,
            'type' => $data['type'],
            'offer_id' => isset($data['offer_id']) ? $data['offer_id'] : null,
            'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : null,
            'addedby_id' => \Auth::id(),
            'editedby_id' => \Auth::id(),
        ]);

        $slider = tap($slider)->update([
            'slug' => isset($slider->title) ? str_slug($slider->title, '-') . '-' .$slider->id : $slider->id,
            'order' => $slider->id
		]);

        return back()->with('success','You have successfully added a '.$slider->type.' type slider image.');
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
    public function edit(Slider $slider)
    {
        $offers = Offer::latest()->get();

        return view('admin.sliders.edit', compact('slider','offers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
            $data = $request->validate([
                'title' => 'nullable|max:255',
                'type' => 'required|string|max:255',
                'offer_id' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'order' => 'required|max:5000',
            ]);

            $offer = Offer::findOrFail($data['offer_id']);

            if($request->file('image')) {
                function UnlinkImage($old_image)
                {
                    if (file_exists($old_image)) {
                       @unlink($old_image);
                    }
                }

                UnlinkImage(public_path('img/sliders/').$slider->image);
                $file = $request->file('image');

                $fileNameWithExtension = $file->getClientOriginalName();

                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $ModifiedFileNameWithoutExtension = str_slug($offer->title, '_').'_'.md5(microtime());

                // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

                $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

                $img = \Image::read($file->getRealPath());
                $save_path=public_path('img/sliders/');
                $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }

                $img->encode('jpg', 100)
                ->resize(null, 279, function ($constraint) {
                      $constraint->aspectRatio();
                  })
                ->save($pathWithFileName);
            }


            $slider = tap($slider)->update([
                'title' => isset($data['title']) ? $data['title'] : $offer->title,
                'type' => $data['type'],
                'offer_id' => isset($data['offer_id']) ? $data['offer_id'] : null,
                'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : $slider->image,
                'order' => $data['order'],
                'slug' =>  isset($data['title']) ? str_slug($data['title'], '-') . '-' .$slider->id : $slider->id,
                'editedby_id' => \Auth::id(),
            ]);

        return redirect()->route('admin.sliders.index')->with('success','You have successfully updated a '.$data['type'].' type slider image.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Slider $slider)
    {
        function UnlinkImage($old_image)
        {
            if (file_exists($old_image)) {
               @unlink($old_image);
            }
        }

        UnlinkImage(public_path('img/sliders/').$slider->image);

        if ($slider->delete()) {
            return redirect()->back()->with('success','You have successfully deleted a '.$slider->type.' type slider image.');
        }
        return redirect()->route('admin.sliders.index');
    }
}
