<?php

namespace App\Http\Controllers;

use App\Models\PurchaseList;
use Illuminate\Http\Request;

class PurchaseListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchaselistindex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $pl = PurchaseList::query();
        return datatables()->eloquent($pl)
            ->addColumn('action', function ($expence) {
                return " <a id='delete' href='javascript:;' data-id='" . $expence->id . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i></a>";
            })
            ->editColumn('quantity', function ($expence) {
                return number_format($expence->quantity);
            })
            ->editColumn('created_at', function ($expence) {
                return $expence->created_at->diffForHumans();
            })
            ->rawColumns(['action', 'created_at'])
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
        return view('purchaselistadd');
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
            "quantity" => "required|integer"
        ]);

        PurchaseList::create([
            "name" => $request->name,
            "quantity" => $request->quantity
        ]);

        return redirect()->route('purchase-list.index');
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
    public function delete(Request $request)
    {
        $id = $request->id;
        
        PurchaseList::where("id", $id)->delete();

        return response()->json(["status" => true], 200);
    }
}
