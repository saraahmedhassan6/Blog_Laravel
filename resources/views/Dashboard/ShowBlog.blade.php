@extends('Dashboard.layouts.master')

@section('dashCss')

@endsection

@section('dashContent')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Post</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    <button type="button" class="close float-right" data-dismiss="alert" aria-label="" close>
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session()->has('Add_Blog'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add_Blog')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="" close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session()->has('Update_Blog'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Update_Blog')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="" close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session()->has('Delete_Blog'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Delete_Blog')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="" close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-xl-12">
                <div class="card mg-b-20">

                    <!--Add Category Button-->
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <a class="modal-effect btn btn-sm btn-primary"
                               data-toggle="modal" href="#modaldemo1">
                                <i class="fas fa-plus"></i>&nbsp;
                                Add Post
                            </a>
                        </div>
                    </div>


                    <!--Table of Data-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Title</th>
                                    <th class="border-bottom-0">Article</th>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">Thumbnail</th>
                                    <th class="border-bottom-0">Published</th>
                                    <th class="border-bottom-0">Team</th>
                                    <th class="border-bottom-0">Transactions</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $increment = 0; ?>

                                @foreach($Blogs as $Blog)
                                        <?php $increment++; ?>
                                    <tr >
                                        <td><p style="margin-top: 20px">{{$increment}}</p></td>
                                        <td><p style="margin-top: 30px">{{$Blog->title}}</p></td>
                                        <td><p style="margin-top: 20px">{{implode(' ', array_slice(explode(' ', $Blog->article), 0, 50))}}</p></td>
                                        <td><img src="{{ asset('BlogImage/' . $Blog->img_name) }} " alt="Image" style="width: 70px;height: 70px;margin-top: 30px"></td>
                                        <td><img src="{{ asset('BlogImage/' . $Blog->thumbnail) }} " alt="Image" style="width: 70px;height: 70px;margin-top: 30px"></td>
                                        <form method="POST" action="{{ url('DashShowBlog') }}/{{$Blog->id}}">
                                            @csrf
                                            @method('PUT')
                                            @if($Blog->published==1)
                                            <input type="hidden" name="id" value="{{ $Blog->id }}">
                                            <td><button type="submit" class="btn btn-success" style="color:white;border-radius:50px;margin-top: 40px">Publish</button></td>
                                            @else
                                                <input type="hidden" name="id" value="{{ $Blog->id }}">
                                                <td><button type="submit" class="btn btn-danger" style="color:white;border-radius:50px;background-color:#ce0000;margin-top: 40px">Not Yet</button></td>
                                            @endif
                                        </form>
                                        <td ><p style="margin-top: 30px">{{$Blog->Team->name}}</p></td>
                                        <td style="width:125px;  ">
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                               data-id="{{ $Blog->id }}"
                                               data-title="{{$Blog->title}}"
                                               data-article="{{$Blog->article}}"
                                               style="margin-top: 50px;"
                                                data-toggle="modal"

                                               href="#exampleModal2" title="Edit"><i
                                                    class="las la-pen">Edit</i>
                                            </a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                               data-id="{{ $Blog->id  }}"
                                               data-title="{{$Blog->title}}"
                                               data-toggle="modal"
                                               style="margin-top: 50px;"

                                               href="#modaldemo9" title="Delete"><i
                                                    class="las la-trash"> Delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Add Post Modal -->
                    <div class="modal" id="modaldemo1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Add Post</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('DashShowBlog')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="exampleInputEmail">Title</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">Article</label>
                                            <textarea type="text" class="form-control" id="article" name="article"
                                                      row=3></textarea>
                                        </div>

                                        <div class="col">
                                            <label for="inputName" class="control-label">Image</label>
                                            <input type="file" id="img_name" name="img_name" style="padding-bottom: 10px">

                                        </div>

                                        <div class="col">
                                            <label for="inputName" class="control-label">Thumbnail</label>
                                            <input type="file" id="thumbnail" name="thumbnail" style="padding-bottom: 10px">

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary"
                                                    type="submit">Confirm</button>
                                            <button class="btn btn-secondary" data-dismiss="modal"
                                                    type="button">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Post Modal -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Post Edit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('DashShowBlog/update')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                        {{ method_field('patch') }}
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputEmail">title</label>
                                            <input type="hidden" name="id" id="id" value="">
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">article</label>
                                            <textarea type="article" class="form-control" id="article" name="article"
                                                      row=3></textarea>
                                        </div>



                                        <div class="col">
                                            <label for="inputName" class="control-label">Image</label>
                                            <input type="file" id="img_name" name="img_name" style="padding-bottom: 10px">

                                        </div>
                                        <div class="col">
                                            <label for="inputName" class="control-label">Thumbnail</label>
                                            <input type="file" id="thumbnail" name="thumbnail" style="padding-bottom: 10px">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                    class="btn btn-primary">Confirm</button>
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Post Modal -->
                    <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog"
                         aria-labelledby="modaldemoLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('DashShowBlog/destroy') }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this Post?</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="title" id="title" type="text" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('dashJS')
    <script src="{{URL::asset('Dashboard/js/modal.js')}}"></script>

    <!-- Edit Category JS-->
    <script>
        $('#exampleModal2').on('show.bs.modal', function (event) {  //this event will occur before modal display
            var button = $(event.relatedTarget) // he will store data that i have passed up in edit button ((data-id= id form database, data_section_name= section_name from database and so on)
            var id = button.data('id')//get the data from button and put it in variable (data-id) so 'id' refers to what i've named for after data i named for data-id if i named data-m so paramater will be 'm'
            var title = button.data('title')//so value of variable section_name will be for example El Bank Al Ahly
            var article = button.data('article')

            var modal = $(this) // to use jquery
            modal.find('.modal-body #id').val(id);//find in class modal-body an id = id when you find it put the value of id that u got from button
            modal.find('.modal-body #title').val(title);//find in class modal-body an id = section_name when you find it put the value of section_name that u got from button
            modal.find('.modal-body #article').val(article);//find in class modal-body an id = description when you find it put the value of description that u got from button


        })
    </script>

    <!--Delete Category JS-->
    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var title = button.data('title')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #title').val(title);
        })

    </script>



@endsection
