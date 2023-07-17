@extends('layouts.master')

@section('title')
    Projects
@endsection

@section('css')
@endsection

@section('content')
    <main id="main">
        <section id="posts" class="posts">
            @foreach($Projects as $Project)
                <div style="display: flex; flex-direction: column; margin: 80px; padding: 20px; background-color: #f8f9fa;margin-top: 0">
                    <div style="display: flex; align-items: center;">

                        <div style="flex: 1;"><img src="{{asset('Projects/'.$Project->img_name)}}" alt="hh" style="width: 350px; height: 350px;"></div>
                        <div style="flex: 2; margin-left: 20px;">
                            <div style="display: flex; flex-direction: column;">
                                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                                    <h3 style="max-width: 800px; !important;  word-wrap: break-word ; top: 10px!important;">{{$Project->title}} </h3>
                                </div>
                                <div style="max-width: 800px; !important;  word-wrap: break-word ;">{{implode(' ', array_slice(explode(' ', $Project->article), 0, 50))}}</div>
                            </div>
                            <div class="">
                                <pre></pre>
                                <pre></pre>

                                <a href="{{ url('ShowProject') }}/{{ $Project->id }}" class="modal-effect btn btn-sm btn-primary" style="color:white;"><i
                                        class="fas fa-plus"></i>&nbsp; Read More
                                </a>
                                <pre></pre>

                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 20px;"><span style="color: darkgray">  <span>&bullet;</span>
                             {{\Carbon\Carbon::parse($Project->created_at)->format('d-m-y')}}</span></div>
                    <div class="d-flex align-items-center author" style="margin-top: 20px;">
                        <div class="photo">
                            <img src="url('{{asset('Members/'.$Project->Team->img_name)}}')" alt="" class="img-fluid" style="width: 60px;">
                        </div>
                        <span style="color: darkgray">{{$Project->Team->signature}}</span>
                    </div>

                </div>
                <pre></pre>
            @endforeach

        </section>
    </main>
@endsection

@section('js')
@endsection

