@extends('admin.layouts.datatable')
<link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('trans.Site.allproject')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('trans.Dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{__('trans.Site.project')}}</li>
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
                                        {{__('trans.Site.allproject')}}
                                    </a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">{{__('trans.Site.createproject')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">{{__('trans.project.manage')}}</a></li>
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
                                            <th>{{__('trans.projectid')}}</th>
                                            <th>{{__('trans.project.title')}}</th>
                                            <th>{{__('trans.Site.project.author')}}</th>
                                            <th>{{__('trans.project.url')}}</th>
                                            <th>{{__('trans.project.review')}}</th>
                                            <th>{{__('trans.project.created_at')}}</th>
                                            <th>{{__('trans.project.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="content" >

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane " id="tab_2">
                                    <div class="col-md-12">
                                        <div class="card card-outline card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    {{__('trans.Site.createproject')}}
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleInputBorder">{{__('trans.project.title')}}</label>
                                                    <input type="text" class="form-control form-control-border" id="title" placeholder="{{__('trans.project.title')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputBorder">{{__('trans.project.url')}}</label>
                                                    <input type="text" class="form-control form-control-border" id="url" placeholder="{{__('trans.project.url')}}">
                                                </div>

                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane " id="tab_3">
                                    <div class="col-md-12">
                                        <div class="card card-outline card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    {{__('trans.project.manage')}}
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                               <h3> {{__('trans.underdevelopment')}} </h3>
                                            </div>
                                            <div class="card-footer">
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

    <script>
        $(Document).ready(function (){
            //Ajax Request To Get Posts Data
            $('#posttabel').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    data:{
                        "_token": "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    url: "{{route('admin.project.datatable')}}",
                },
                columns: [
                        {
                            data:"id",
                            name:"id"
                        },
                        {
                            data:"title",
                            name:"title",
                        },
                        {
                            data:"author",
                            name:"author",
                        },
                        {
                            data:"url",
                            name:"url",
                        },
                        {
                            data:"review",
                            name:"review",
                        },
                        {
                            data:"created_at",
                            name:"created_at"
                        },
                        {
                            data:"action",
                            name:"action"
                        },
                    ],
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'csv', 'pdf', 'copy'
                ],
            });

            //Ajax Request To Store Post Data
            $('#submit').on('click',function (){
                var title = document.getElementById('title').value//$('#title').value;
                var url = document.getElementById('url').value //$('#url').value;
                console.log(title);
                console.log(url);
                $.ajax({
                    url:"{{route('admin.store.project')}}",
                    type:'POST',
                    data:{
                        _token:"{{csrf_token()}}",
                        title: title,
                        url: url,
                        author:"{{auth()->id()}}",
                    },
                    success: function (data) {
                        if(data == 'done'){
                            var notify = document.getElementById('notify');

                            notify.innerHTML +=' <div class="alert alert-success" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                '{{__("trans.Site.add.project")}}'
                                +
                                '</div>';


                        }
                    },
                });

            });
        });
    </script>

@endsection

