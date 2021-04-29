@extends('admin.layouts.datatable')
<link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('trans.Site.post')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('trans.Dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{__('trans.Site.post')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">
                                        {{__('trans.Site.allposts')}}
                                    </a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">{{__('trans.Site.createpost')}}</a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->

                            <div id="notify">
                                @if(Illuminate\Support\Facades\Session::has('done'))
                                    <div class="{{Illuminate\Support\Facades\Session::get('class')}}" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        {{Illuminate\Support\Facades\Session::get('done')}}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body" >
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <table id="posttabel" class="table table-bordered table-striped">
                                            <thead>
                                            <tr id="feilds">
                                                <th>id</th>
                                                <th>post</th>
                                                <th>author</th>
                                                <th>created at</th>
                                                <th>action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="content" >

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane " id="tab_2">
                                        <div class="col-md-12">
                                            <div class="card card-outline card-info">
                                                    <div class="card-header">
                                                    <h3 class="card-title">
                                                        {{__('trans.Site.createpost')}}
                                                    </h3>
                                                </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                          <textarea id="summernote">

                                                          </textarea>
                                                        <div class="form-group">

                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>

                </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <script src="{{asset('back/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <script>
        $(Document).ready(function (){
            //Init The summernote Editor
            $('#summernote').summernote()

            //Ajax Request To Get Posts Data
            $('#posttabel').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        data:{
                            "_token": "{{ csrf_token() }}"
                        },
                        type: 'POST',
                        url: "{{route('admin.datatable')}}",
                    },
                    columns:
                        [
                            {
                                data:"id",
                                name:"id"
                            },
                            {
                                data:"post",
                                name:"post",
                            },
                            {
                                data:"author",
                                name:"author",
                            },
                            {
                                data:"created_at",
                                name:"created_at"
                            },
                            {
                                data:"action",
                                name:"action"
                            },
                        ]
                    ,
                    dom: 'lBfrtip',
                    buttons: [
                        'excel', 'csv', 'pdf', 'copy'
                    ],
                });

            //Ajax Request To Store Post Data
            $('#submit').on('click',function (){
               var data = document.getElementById('summernote').value;//$('#summernote').value;
                console.log(data);
                $.ajax({
                    url:"{{route('admin.store.post')}}",
                    type:'POST',
                    data:{
                        _token:"{{csrf_token()}}",
                        post: data,
                        author:"{{auth()->id()}}"
                    },
                    success: function (data) {
                        if(data == 'done'){
                               var notify = document.getElementById('notify');

                               notify.innerHTML +=' <div class="alert alert-success" role="alert">' +
                                   '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                   '{{__("trans.Site.add.post")}}'
                                       +
                                   '</div>';


                        }
                    },
                });

            });
        });
    </script>
@endsection

