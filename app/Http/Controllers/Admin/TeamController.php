<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('team-list')) {
            abort(403);
        }

    	$searchTerm = request()->get('s');
        $teams = Team::latest()->orWhere('Fullname','LIKE', "%$searchTerm%")->paginate(50);
        return view('admin/team/index')->with(compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->can('team-list')) {
            abort(403);
        }

        return view('admin/team/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('team-edit')) {
            abort(403);
        }

        $this->validate(request(), [
            'Fullname' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'facebook_id' => 'required',   
            'twitter_id' => 'required',   
            'pinterest_id' => 'required',   

        ]);

        $fileName = null;
        if (request()->hasFile('team_img')) 
        {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getclientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        Team::create([
            'Fullname' => request()->get('Fullname'),
            'designation' => request()->get('designation'),
            'telephone' => request()->get('telephone'),
            'mobile' => request()->get('mobile'),
            'email' => request()->get('email'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'profile' => request()->get('profile'),
            'team_img' => $fileName,
            'status' => 'DEACTIVE',
       ]);

       return redirect()->to('/admin/team');
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
        if(!auth()->user()->can('team-edit')) {
            abort(403);
        }

        $team = Team::find($id);
        return view('admin/team/edit')->with(compact('team'));
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
        if(!auth()->user()->can('team-delete')) {
            abort(403);
        }
        $team = Team::find($id);

        $currentImage = $team->team_img;
        $fileName =  null;
        if (request()->hasFile('team_img')) 
        {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getclientOriginalExtension();
            $file->move('./uploads', $fileName);
        }
        $team->update([
            'Fullname' => request()->get('Fullname'),
            'designation' => request()->get('designation'),
            'telephone' => request()->get('telephone'),
            'mobile' => request()->get('mobile'),
            'email' => request()->get('email'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'profile' => request()->get('profile'),
            'team_img' => ($fileName) ? $fileName : $currentImage,
       ]);

        if ($fileName) {
            File::delete('./uploads/' . $currentImage);
        }
        return redirect()->to('/admin/team');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $team = Team::find($id);
           $team->delete();
          return 'true';
        }
        
    }


    public function status(Request $request, $id)
    {
        sleep(1);
        if ($request->ajax()) {
          $team = Team::find($id);
        $newStatus = ($team->status == 'DEACTIVE') ? 'ACTIVE': 'DEACTIVE';
        $team->update([
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
                Team::where('id', $value)->update([ 'status' => 'ACTIVE']);
            }
            $record = Team::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Team::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Team::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Team::where('id', $value)->delete();
            }
            $record = Team::find($request->statusAll);
            return $record;
        }
    }
}
