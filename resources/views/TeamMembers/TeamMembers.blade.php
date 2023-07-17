
@extends('layouts.master')

@section('title')
    SaraBlog
@endsection

@section('css')
@endsection

@section('content')
    <main id="main">
        <section>
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h1 class="page-title">Team Members</h1>
                    </div>
                </div>
            </div>
        </section>

        <section>

                <div class="container" data-aos="fade-up">
                    <div class="row" >
                        @foreach($Teams as $Team)
                        <div class="col-lg-4 text-center mb-5">
                            <a href="{{url('ShowProjectMember')}}/{{$Team->id}}"><img src="{{ asset('Members/' . $Team->img_name) }}" alt="" class="img-fluid rounded-circle w-50 mb-4" style="width: 140px;height: 240px"></a>
                            <a href="{{url('ShowProjectMember')}}/{{$Team->id}}"><h3>{{$Team->signature}}</h3></a>
                            <a href="{{url('ShowProjectMember')}}/{{$Team->id}}"><h5 class="d-block mb-3 text-uppercase">{{$Team->position}}</h5></a>
                            <a href="{{url('ShowProjectMember')}}/{{$Team->id}}"><span class="d-block mb-3 text-uppercase">{{$Team->bio}}</span></a>
                            <p></p>
                        </div>
                        @endforeach
                    </div>
                </div>

        </section>
@endsection

@section('js')
@endsection
