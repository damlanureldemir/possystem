<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request){
        return view('pages.category.index');
    }

    public function fetch(){
        $category=Category::get();
        return DataTables::of($category)
            ->addIndexColumn()
            ->addColumn('action',function ($data){
                return '<a href="javascript:void(0)" id="delete"  class="mdi mdi-delete badge badge-outline-danger" onclick="deleteCategory('.$data->id.')">Sil</a>';
            })->rawColumns(['action'])
            ->make(true);
    }

    public function create(Request $request){
        $category=new Category;
        $category->name=$request->name;
        $category->save();
        return response()->json(['success'=>'başarılı']);
    }
    public  function deleteCategory($id){
        $category=Category::findOrFail($id);
        if($category){
            $category->delete();
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>'silinmedi']);

    }
}
