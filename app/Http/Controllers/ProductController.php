<?php

namespace App\Http\Controllers;

use App\Models\Expence;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productindex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $product = Product::where('state', 1)->where('expiry_date', '>', date('Y-m-d H:i:s'));

        return datatables()->eloquent($product)
            ->editColumn('quantity', function ($expence) {
                return number_format($expence->quantity);
            })
            ->editColumn('price', function ($expence) {
                return '₹ '.number_format($expence->price, 2);
            })
            ->editColumn('created_at', function ($expence) {
                return $expence->created_at->diffForHumans();
            })
            ->editColumn('expiry_date', function ($expence) {
                return $expence->expiry_date->diffForHumans();
            })
            ->addColumn('total_price', function ($expence) {
                return '₹ '.number_format(($expence->quantity * $expence->price), 2);
            })
            ->editColumn('action', function ($expence) {
                return "<select class=\"product_state form-control\" data-id=\"".encrypt($expence->id)."\">
                    <option value=\"NAN\">Select</option>
                    <option value=\"0\">Used</option>
                </select>";
            })
            ->rawColumns(['created_at', 'quantity', 'total_price', 'price', 'expiry_date', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usedProducts()
    {
        return view('usedindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usedProductsData()
    {
        $product = Product::where('state', 0);

        return datatables()->eloquent($product)
            ->editColumn('quantity', function ($expence) {
                return number_format($expence->quantity);
            })
            ->editColumn('price', function ($expence) {
                return '₹ '.number_format($expence->price, 2);
            })
            ->editColumn('created_at', function ($expence) {
                return $expence->created_at->diffForHumans();
            })
            ->editColumn('expiry_date', function ($expence) {
                return $expence->expiry_date->diffForHumans();
            })
            ->addColumn('total_price', function ($expence) {
                return '₹ '.number_format(($expence->quantity * $expence->price), 2);
            })
            ->rawColumns(['created_at', 'quantity', 'total_price', 'price', 'expiry_date'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function spoiledProducts()
    {
        return view('spoiledindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function spoiledProductsData()
    {
        $product = Product::where('expiry_date', '<', date('Y-m-d H:i:s'));

        return datatables()->eloquent($product)
            ->editColumn('quantity', function ($expence) {
                return number_format($expence->quantity);
            })
            ->editColumn('price', function ($expence) {
                return '₹ '.number_format($expence->price, 2);
            })
            ->editColumn('created_at', function ($expence) {
                return $expence->created_at->diffForHumans();
            })
            ->editColumn('expiry_date', function ($expence) {
                return $expence->expiry_date->diffForHumans();
            })
            ->addColumn('total_price', function ($expence) {
                return '₹ '.number_format(($expence->quantity * $expence->price), 2);
            })
            ->rawColumns(['created_at', 'quantity', 'total_price', 'price', 'expiry_date'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "quantity" => "required|integer",
            "price" => "required|integer",
            "expiry_date" => "required",
        ]);

        Product::create([
            "name" => $request->name,
            "quantity" => $request->quantity,
            "price" => $request->price,
            "expiry_date" => $request->expiry_date
        ]);

        Expence::create([
            "price" => ($request->quantity * $request->price),
        ]);

        return redirect()->route('expence');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function statechange(Request $request)
    {
        $id = decrypt($request->id);

        Product::where('id', $id)->update([
            "state" => 0
        ]);

        return response()->json(["status" => true], 200);
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
