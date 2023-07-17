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
                        <h1 class="m-0">Teams</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Teams</li>
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

        @if(session()->has('Add_Member'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add_Member')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="" close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session()->has('Update_Member'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Update_Member')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="" close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session()->has('Delete_Member'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Delete_Member')}}</strong>
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
                                Add Team Member
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
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Position</th>
                                    <th class="border-bottom-0">Bio</th>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">Signature</th>
                                    <th class="border-bottom-0">Transactions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $increment = 0; ?>

                                @foreach($Teams as $Team)
                                        <?php $increment++; ?>
                                    <tr>
                                        <td>{{$increment}}</td>
                                        <td>{{$Team->name}}</td>
                                        <td>{{$Team->position}}</td>
                                        <td>{{$Team->bio}}</td>
                                        <td><img src="{{ asset('Members/' . $Team->img_name) }} " alt="Image" style="width: 70px;height: 70px"></td>

                                        <td>{{$Team->signature}}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                               data-id="{{ $Team->id }}"
                                               data-name="{{$Team->name}}"
                                               data-position="{{$Team->position}}"
                                               data-bio="{{$Team->bio}}"
                                               data-signature="{{$Team->signature}}"
                                                data-toggle="modal"
                                               href="#exampleModal2" title="Edit"><i
                                                    class="las la-pen">Edit</i>
                                            </a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                               data-id="{{ $Team->id  }}"
                                               data-name="{{$Team->name}}"
                                               data-toggle="modal" href="#modaldemo9" title="Delete"><i
                                                    class="las la-trash"> Delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Add Team Modal -->
                    <div class="modal" id="modaldemo1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Add Team</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('DashTeam')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="exampleInputEmail">Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">Email</label>
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail">Position</label>
                                            <input type="text" class="form-control" id="position" name="position">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">Bio</label>
                                            <textarea type="text" class="form-control" id="bio" name="bio"
                                                      row=3></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">Signature</label>
                                            <input type="text" class="form-control" id="signature" name="signature">
                                        </div>

                                        <div class="col">
                                            <label for="inputName" class="control-label">Image</label>
                                            <input type="file" id="img_name" name="img_name" style="padding-bottom: 10px">

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

                    <!-- Edit Team Modal -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Member Edit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('DashTeam/update')}}" method="post" autocomplete="off">
                                        {{ method_field('patch') }}
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputEmail">Name</label>
                                            <input type="hidden" name="id" id="id" value="">
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">Position</label>
                                            <input type="text" class="form-control" id="position" name="position">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">Bio</label>
                                            <textarea type="text" class="form-control" id="bio" name="bio"
                                                      row=3></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail">Signature</label>
                                            <input type="text" class="form-control" id="signature" name="signature">
                                        </div>

                                        <div class="col">
                                            <label for="inputName" class="control-label">Image</label>
                                            <input type="file" id="img_name" name="img_name" style="padding-bottom: 10px">

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
                                <form action="{{ url('DashTeam/destroy') }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this Member?</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="name" id="name" type="text" readonly>
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

    <!-- Edit Member JS-->
    <script>
        $('#exampleModal2').on('show.bs.modal', function (event) {  //this event will occur before modal display
            var button = $(event.relatedTarget) // he will store data that i have passed up in edit button ((data-id= id form database, data_section_name= section_name from database and so on)
            var id = button.data('id')
            var name = button.data('name')//get the data from button and put it in variable (data-id) so 'id' refers to what i've named for after data i named for data-id if i named data-m so paramater will be 'm'
            var position = button.data('position')//so value of variable section_name will be for example El Bank Al Ahly
            var bio = button.data('bio')
            var signature = button.data('signature')

            var modal = $(this) // to use jquery
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);//find in class modal-body an id = id when you find it put the value of id that u got from button
            modal.find('.modal-body #position').val(position);//find in class modal-body an id = section_name when you find it put the value of section_name that u got from button
            modal.find('.modal-body #bio').val(bio);//find in class modal-body an id = description when you find it put the value of description that u got from button
            modal.find('.modal-body #signature').val(signature);

        })
    </script>

    <!--Delete Member JS-->
    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        })

    </script>



@endsection
