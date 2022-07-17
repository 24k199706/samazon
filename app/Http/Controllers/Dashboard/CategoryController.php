<?php

namespace App\Http\Controllers\Dashboard;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::paginate(15);
        $major_cartegories=MajorCategory::all();
        return view('dashboard,categories.index',conpact('categories,major_categories'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->vaildate([
            'name'=>'requied|unique:categories',
            'description'=>'required',
        ],
        [   'name.repuired' => 'カテゴリの名前は必須です。',
            'name.unique' => 'カテゴリ名「' . $request->input('name') . '」は登録済みです。',
            'description.required' => 'カテゴリの説明は必須です。',
        ]);
        $category=new Category([
            'name'=>$request->name,
            'description'=>$request->description,
            'major_category_id'=>$request->major_category_id
        ]);
        $category->major_categories_name = MajorCategory::find($request->input(major.category_id))->name;
        $category->save();
        return redirect('/dashboard/categories');
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
    public function edit(Category $category)
    {
        $major_categories = MajorCategory::all();
        return view('dashboard.categories.edit', compact('category', 'major_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->vaildate([
            'name'=>'requied|unique:categories',
            'description'=>'required',
        ],
        [   'name.repuired' => 'カテゴリの名前は必須です。',
            'name.unique' => 'カテゴリ名「' . $request->input('name') . '」は登録済みです。',
            'description.required' => 'カテゴリの説明は必須です。',
        ]);
        $category=['name'=>$request->name,
        'description'=>$request->description,
        'major_category_name'=>$request->major_category_name];
        $category->update();
        
        return redirect('/dashboard/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/dashboard/categories');
    }
}
