<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryOption;

class DeliveryOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveryOptions = DeliveryOption::all();

        return view('admin.deliveryoptions.index',compact('deliveryOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.deliveryoptions.create');
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
            // 'region' => 'required|max:255',
            'district' => 'required|array|min:1',
            // 'area' => 'required|max:255',
            'cost' => 'required|numeric|max:100000',
            'delivery_days' => 'required|max:255',
            'cash_on_delivery' => 'required|boolean|max:255',
        ]);

        foreach($data['district'] as $key => $value):
            // $deliveryOption = DeliveryOption::create([
            //     // 'region' => $data['region'],
            //     'district' => $value,
            //     // 'area' => $data['area'],
            //     'cost' => $data['cost'],
            //     'delivery_days' => $data['delivery_days'],
            //     'cash_on_delivery' => $data['cash_on_delivery'],
            //     'addedby_id' => \Auth::id(),
            //     'editedby_id' => \Auth::id(),
            // ]);

            $deliveryOption = DeliveryOption::updateOrCreate(
                ['district' => $value],
                [
                    'cost' => $data['cost'],
                    'delivery_days' => $data['delivery_days'],
                    'cash_on_delivery' => $data['cash_on_delivery'],
                    'addedby_id' => \Auth::id(),
                    'editedby_id' => \Auth::id(),
                ]
            );
            endforeach;


        // $deliveryOption = tap($deliveryOption)->update([
        //     'slug' => isset($data['slug']) ? $data['slug'] : $slug,
        //     'order' => $order
        // ]);

        return back()->with('success','You have successfully added a new delivery option.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryOption $deliveryOption)
    {
        return view('admin.deliveryoptions.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryOption $deliveryOption)
    {
        return view('admin.deliveryoptions.edit',compact('deliveryOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryOption $deliveryOption)
    {
        // $this->authorize('update', Category::class);

        $data = $request->validate([
            // 'region' => 'required|max:255',
            'district' => 'required',
            // 'area' => 'required|max:255',
            'cost' => 'required|numeric|max:100000',
            'delivery_days' => 'required|max:255',
            'cash_on_delivery' => 'required|boolean|max:255',
        ]);


        $deliveryOption = tap($deliveryOption)->update([
            // 'region' => $data['region'],
            'district' => $data['district'],
            // 'area' => $data['area'],
            'cost' => $data['cost'],
            'delivery_days' => $data['delivery_days'],
            'cash_on_delivery' => $data['cash_on_delivery'],
            'editedby_id' => \Auth::id(),
        ]);

        return redirect()->route('admin.deliveryoptions.index')->with('success','You have successfully updated a delivery options.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryOption $deliveryOption)
    {
        if ($deliveryOption->delete()) {
            return redirect()->route('admin.deliveryoptions.index')->with('success','You have successfully deleted a delivery options.');
        }
        return redirect()->route('admin.deliveryoptions.index')->with('success','You have successfully deleted a delivery options.');
    }
}
