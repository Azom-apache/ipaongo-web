<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Stock;
use App\User;
use Carbon\Carbon;
use App\OrderItem;
use Hash;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = array("pending", "confirmed", "shipped", "delivered","returned","cancelled");

        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        if(session()->has('order')){
            if(session('order')=='all'){
                $filterOrder = 'all';
                $orders = Order::latest()->get();
            }elseif(in_array(session('order'), $status)=='pending'){
                $filterOrder = session('order');
                $orders = Order::latest()->where('status',$filterOrder)->get();
            }elseif(session('order')=='today'){
                $filterOrder = 'today';
                $orders = Order::latest()->whereDate('created_at', Carbon::today())->get();
            }elseif(session('order')=='week'){
                $filterOrder = 'week';
                $orders = Order::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get();
            }elseif(session('order')=='month'){
                $filterOrder = 'month';
                $orders = Order::latest()->where('created_at', '>=', Carbon::now()->startOfMonth())->get();
                // Order::where('created_at', '>=', Carbon::now()->subMonth())->get();
            }else{
                $filterOrder = 'all';
                $orders = Order::latest()->get();
            }
        } else{
            $filterOrder = 'all';
            $orders = Order::latest()->get();
        }
        return view('admin.orders.index',compact('orders','filterOrder'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $this->authorize('view', Order::class);
        $orders = Order::latest()->where('status','pending')->get();
        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmed()
    {
        $this->authorize('view', Order::class);
        $orders = Order::latest()->where('status','confirmed')->get();
        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sold()
    {
        $this->authorize('view', Order::class);
        $orders = Order::latest()->where('status','sold')->get();
        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelled()
    {
        // $this->authorize('view', Order::class);
        $orders = Order::latest()->where('status','cancelled')->get();

        $orderItems = \App\OrderItem::where('order_id',$order->id)->get();

        foreach($orderItems as $orderProduct){
            $product = Product::find($orderProduct->product_id);

            $product = tap($product)->update([
                'total_qty' => ($product->total_qty - $orderProduct->qty)
            ]);

            if($product->hassize){
                $stock = Stock::where('product_id',$product->id)->where('size',$orderProduct->size)->first();

                $stock = tap($stock)->update([
                    'qty' => ($stock->qty - $orderProduct->qty)
                ]);
            }
        }
        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create',Order::class);
        return redirect()->route('admin.orders.index')->with('success','Sorry! This Feature isn\'t avaialable yet.');
        return view('admin.users.addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create',Order::class);
        return redirect()->route('admin.orders.index')->with('success','Sorry! This Feature isn\'t avaialable yet.');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|max:255',
            'merchant_status' => 'required|boolean',
            'mobile' => 'required|string|min:6|max:30|unique:users',
            'status' => 'required|boolean'
        ]);


        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'status' => $data['status'],
        ]);

        if($user->role == 'merchant'){
            $user = tap($user)->update([
                'merchant_status' => $data['merchant_status']
            ]);
        } else{
            $user = tap($user)->update([
                'merchant_status' => false
            ]);
        }

        return back()->with('success','You have successfully added an User.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show',compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function items(Order $order)
    {
        $orderItems = OrderItem::where('order_id',$order->id)->get();
        return view('admin.orders.items',compact('orderItems'));
    }
    public function print(Order $order)
    {
        $deliveryOption = \App\DeliveryOption::find($order->delivery_options_id);
        $orderItems = OrderItem::where('order_id',$order->id)->get();
        $pdf = \PDF::loadView('pdf.pdf', compact('orderItems','order','deliveryOption'))->setPaper('a4','protrait');
        return $pdf->download('invoice_'.$order->invoice_no.'.pdf');

        // return view('pdf.invoice',compact('orderItems','order','deliveryOption'));
    }

    public function generate()
    {
        $order = \App\Order::latest()->first();
        $deliveryOption = \App\DeliveryOption::find($order->delivery_options_id);
        $orderItems = OrderItem::where('order_id',$order->id)->get();
        $pdf = \PDF::loadView('pdf.pdf', compact('orderItems','order','deliveryOption'))->setPaper('a4','protrait');
        return $pdf->download('test.pdf');

        return view('pdf.invoice',compact('orderItems','order','deliveryOption'));
    }

    public function generateView()
    {
        $order = \App\Order::latest()->first();
        $deliveryOption = \App\DeliveryOption::find($order->delivery_options_id);
        $orderItems = OrderItem::where('order_id',$order->id)->get();

        return view('pdf.pdf',compact('orderItems','order','deliveryOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Order $order)
    {
        // $this->authorize('update',Order::class);
        // return redirect()->route('admin.orders.index')->with('success','Sorry! This Feature isn\'t avaialable yet.');
        return view('admin.orders.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // $this->authorize('update',Order::class);

        $data = $request->validate([
            'status' => 'required|max:255'
        ]);

        $field = $data['status'] . '_at';



        $order = tap($order)->update([
            'status' => $data['status'],
            $field => Carbon::now(),
            'editedby_id' => Auth::id(),
        ]);

        if($order->status == 'cancelled'){
            $orderItems = \App\OrderItem::where('order_id',$order->id)->get();

            foreach($orderItems as $orderProduct){
                $product = Product::find($orderProduct->product_id);

                $product = tap($product)->update([
                    'total_qty' => ($product->total_qty + $orderProduct->qty)
                ]);

                if($product->hassize){
                    $stock = Stock::where('product_id',$product->id)->where('size',$orderProduct->size)->first();

                    $stock = tap($stock)->update([
                        'qty' => ($stock->qty + $orderProduct->qty)
                    ]);
                }
            }
        }

        return back()->with('success','You have successfully updated an order.');
        // return redirect()->route('admin.orders.show',$order->id)->with('success','You have successfully updated an order.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modify(Request $request, Order $order)
    {

        // return $request->all();
        $data = $request->validate([
            'name' => 'required|max:255',
            'mobile' => 'required|max:255',
            'email' => 'nullable|email|max:191',
            'mobile' => ['required','regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/','min:11','max:15'],
            'address' => 'required|max:10000',
            'postal_code' => 'nullable|max:191',
            'message' => 'nullable|max:2000',
            'status' => 'required|max:255',
            'total_product' => 'required|max:50000',
            'total_qty' => 'required|max:50000',
            'total_price' => 'required|max:900000',
            'shipping_cost' => 'required|max:50000',
            'final_price' => 'required|max:50000',
            'payment_method' => 'required|max:50000',
            'orderItem' => 'required|array|min:1|max:50000',
        ]);

        foreach($data['orderItem']['id'] as $key => $oItem){
            $orderItem = \App\OrderItem::find($oItem);

            if((int)$data['orderItem']['qty'][$key] != 0){
                $orderItem = tap($orderItem)->update([
                    'qty' => $data['orderItem']['qty'][$key],
                    'size' => isset($data['orderItem']['size'][$key]) ? $data['orderItem']['size'][$key] : null,
                    'price' => $data['orderItem']['price'][$key],
                    'sub_total' => $data['orderItem']['sub_total'][$key]
                ]);
            } elseif(count($data['orderItem']['id'])>1){
                $orderItem->delete();
            }
        }

        $field = $data['status'] . '_at';



        $order = tap($order)->update([
            'status' => $data['status'],
            'name' => $data['name'],
            'email' => isset($data['email']) ? $data['email'] : null,
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'postal_code' => isset($data['postal_code']) ? $data['postal_code'] : null,
            'payment_method'=> $data['payment_method'],
            'message' => isset($data['message']) ? $data['message'] : null,
            'total_product' => $data['total_product'],
            'total_qty' => $data['total_qty'],
            'total_price' => $data['total_price'],
            'shipping_cost' => $data['shipping_cost'],
            'final_price' => $data['final_price'],
            $field => Carbon::now(),
            'editedby_id' => Auth::id(),
        ]);

        return back()->with('success','You have successfully updated an order.');
        // return redirect()->route('admin.orders.show',$order->id)->with('success','You have successfully updated an order.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {
        // $this->authorize('delete', $order);
        if ($order->delete()) {
            return redirect()->route('admin.orders.index')->with('success','You have successfully deleted an order.');
        }
        return redirect()->back();
    }


    /**
     *
     *  Print Invoice.
     *
     *  @param int $order_id
     *  @return void
     **/
     public function print_order(Order $order)
     {
          //dd(engToBn(123456));
          $orderItems = OrderItem::where('order_id',$order->id)->get();
          $user = User::where('id',$order->orderby_id)->first();

          return view('admin.orders.invoice',compact('user','order','orderItems'));
     }

    /**
     *
     *  Print Invoice.
     *
     *  @param int $order_id
     *  @return void
     **/
     public function updateOrder(Request $request)
     {
        $data = $request->validate([
            'filterOrder' => 'required|max:255',
        ]);

        session(['order' => $data['filterOrder']]);

        return redirect()->route('admin.orders.index');
     }
}


