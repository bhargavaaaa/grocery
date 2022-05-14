<?php

namespace App\Http\Controllers;

use App\Models\Expence;
use Illuminate\Http\Request;

class ExpenceController extends Controller
{
    public function index()
    {
        return view("expence");
    }

    public function getData()
    {
        $expence = Expence::query();
        return datatables()->eloquent($expence)
            ->addColumn('action', function ($expence) {
                return " <a id='delete' href='javascript:;' data-id='" . $expence->id . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i></a>";
            })
            ->editColumn('price', function ($expence) {
                return '₹ '.number_format($expence->price, 2);
            })
            ->editColumn('created_at', function ($expence) {
                return $expence->created_at->diffForHumans();
            })
            ->rawColumns(['action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        
        Expence::where("id", $id)->delete();

        return response()->json(["status" => true], 200);
    }
}
