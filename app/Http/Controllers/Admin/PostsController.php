<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\ErrorhandlerTrait;
use App\Http\Requests\PostRequest;
use App\Traits\FaceBookPosting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PostsController extends Controller
{
    use ErrorhandlerTrait;
    use FaceBookPosting;
    public function datatable()
    {
        try{
            $datatable = Post::with('user')->get();


            return DataTables::of($datatable)
                ->escapeColumns('post', function ($datatable) {
                    //ToDO: Figure out how to pass html and limit the string to 100 char without any effect to html
                    return $datatable->post;
                })
                ->editColumn('created_at', function ($datatable) {
                    return Carbon::make($datatable->created_at);
                })
                ->editColumn('author',function ($datatable){
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
            return response()->json('Error',500);
        }
    }

    public function store(PostRequest $request)
    {
        try {
             Post::create($request->validated());
             $this->posting('
             1-Facebook Api
             2-http://google.com
             #khaled');
            return response()->json('done', 200);
        }
        catch (\Exception $e) {
            $this->Errorhandle($e);

            return response()->json($e, 500);
        }
    }

    public function destroy(Post $id)
    {
        try {
            $id->delete();
            Session::flash('done', 'Deleted successfully');
            Session::flash('class', 'alert alert-success');
            return redirect()->back();
        }
        catch (\Exception $e) {

            $this->Errorhandle($e);

            return response()->json('error', 500);
        }
    }
}
