<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(!auth()->user()->can('category-list')) {
            abort(403);
        }

    	 $searchTerm = request()->get('s');
        $categories = Category::latest()->orWhere('title', 'LIKE', "%$searchTerm%")->paginate(50);
        return view('admin/category/index')->with(compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if(!auth()->user()->can('category-create')) {
            abort(403);
        }

        return view('admin/category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('category-create')) {
            abort(403);
        }

        Category::create([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'description' => request()->get('description'),
            'status' => 'DEACTIVE',
       ]);

       return redirect()->to('/admin/category');
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
         if(!auth()->user()->can('category-edit')) {
            abort(403);
        }

        $category = Category::find($id);
        return view('admin/category/edit')->with(compact('category'));
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
         if(!auth()->user()->can('category-edit')) {
            abort(403);
        }

        $category =Category::find($id);
        $category->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'description' => request()->get('description'),
        ]);

        return redirect()->to('admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
         if(!auth()->user()->can('category-delete')) {
            abort(403);
        }

        if ($request->ajax()) {
            $category = Category::find($id); //column name must be category_id.
            $category->delete();
           return 'true';
        }
        
    }

     public function status(Request $request, $id)
    {
        if ($request->ajax()) {
            $category = Category::find($id);
        $newStatus = ($category->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $category->update([
            'status' => $newStatus
        ]);

        return $newStatus;
        }
        
    }

     public function statusActive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Category::where('id', $value)->update([ 'status' => 'ACTIVE']);
            }
            $record = Category::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Category::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Category::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Category::where('id', $value)->delete();
            }
            $record = Category::find($request->statusAll);
            return $record;
        }
    }
}
