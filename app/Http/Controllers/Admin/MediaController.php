<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Media;
use File;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('media-list')) {
            abort(403);
        }

    	$searchTerm = request()->get('s');
        $medias = Media::latest()->orWhere('title','LIKE', "%$searchTerm%")->paginate(15);
        return view('admin/media/index')->with(compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->can('media-create')) {
            abort(403);
        }

        return view('admin/media/create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('media-edit')) {
            abort(403);
        }

        // $this->validate(request(), [
        //     'title' => 'required',
        //     'slug' => 'required',
        //     'media_type' => 'required',
        //     'media_img' => 'required',
        // ]);

         $fileName = null;
        if (request()->hasFile('media_img')) 
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getclientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        Media::create([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'media_type' => request()->get('media_type'),
            'media_img' => $fileName,
            'description' => request()->get('description'),
            'status' => 'DEACTIVE',

        ]);

        return redirect()->to('/admin/media');
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
        if(!auth()->user()->can('media-edit')) {
            abort(403);
        }

        $media = Media::find($id);
        return view('admin/media/edit')->with(compact('media'));
        
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
        if(!auth()->user()->can('media-delete')) {
            abort(403);
        }

        $media = Media::find($id);

        $currentImage = $media->media_img;
        $fileName =  null;
        if (request()->hasFile('media_img')) 
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getclientOriginalExtension();
            $file->move('./uploads', $fileName);
        }
        $media->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'media_type' => request()->get('media_type'),
            'media_img' => ($fileName) ? $fileName : $currentImage,
            'description' => request()->get('description'),
        ]);

        if ($fileName) {
            File::delete('./uploads/' . $currentImage);
        }

        return redirect()->to('/admin/media');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(!auth()->user()->can('media-delete')) {
            abort(403);
        }

        if ($request->ajax()) {
            $media = Media::find($id); //column name must be media_id.
           $media->delete();
           return 'true';
        }
        
    }

    public function status(Request $request, $id)
    {
        if ($request->ajax()) {
            $media = Media::find($id);
            $newStatus = ($media->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
            $media->update([
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
                Media::where('id', $value)->update([ 'status' => 'ACTIVE']);
            }
            $record = Media::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Media::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Media::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Media::where('id', $value)->delete();
            }
            $record = Media::find($request->statusAll);
            return $record;
        }
    }
}
