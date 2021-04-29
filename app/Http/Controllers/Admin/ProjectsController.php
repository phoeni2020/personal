<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Traits\ErrorhandlerTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProjectsController extends Controller{

    use ErrorhandlerTrait;

    public function datatable(){
        try{
            $datatable = Project::with('user')->get();
            return DataTables::of($datatable)
                ->escapeColumns('title', function ($datatable) {
                    //ToDO: Figure out how to pass html and limit the string to 100 char without any effect to html
                    return $datatable->title;
                })
                ->editColumn('url', function ($datatable) {
                    return '<a href="'.$datatable->url.'" target="_blank">'.$datatable->title.'</a>';
                })
                ->editColumn('created_at', function ($datatable) {
                    return Carbon::make($datatable->created_at);
                })
                ->editColumn('author', function ($datatable) {
                    return $datatable->user->name;
                })
                ->addColumn('action', function ($datatable) {
                    //Edit Post a Tag
                    $button = '<a href="' . route('admin.edit.post', $datatable->id) . '"class="btn btn-link">
                            <li class="fa fa-edit"></li>' . __('Edit') . '</a>';

                    //Delete Post Form Tag
                    $button .= '<form action="' . route('admin.delete.posts', $datatable->id) . '" method="post">
                                <input value="' . csrf_token() . '" type="hidden" name="_token">' .
                        method_field('delete')
                        . '<button type="submit" class="btn btn-link text-danger">
                              <li class=" fa fa-trash"></li>Delete
                              </button>
                          </form>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make();
        }
        catch (\Exception $e){
            $this->Errorhandle($e);

            return response()->json('error', 500);

        }
    }

    public function store(ProjectRequest $request){
        try {
            Project::create($request->validated());
            return response()->json('done', 500);
        } catch (\Exception $e) {
            $this->Errorhandle($e);
            return response()->json('error', 500);
        }
    }

    public function destroy(Project $id){
        try {
            $id->delete();
            Session::flash('done', 'Deleted successfully');
            Session::flash('class', 'alert alert-success');
            return redirect()->back();

        } catch (\Exception $e) {
            $this->Errorhandle($e);

            return response()->json('error', 500);
        }
    }
}
