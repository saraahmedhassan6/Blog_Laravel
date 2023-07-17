@extends('layouts.master')

@section('title')
    Projects
@endsection

@section('css')

@endsection

@section('content')
@foreach($Projects as $Project)
    <main id="main">
        <section class="category-section">
            <div class="container" data-aos="fade-up">
                <div class="card-header pb-0">
                    <div class="">
                        <h1 style="text-align: center;">{{$Project->title}}</h1>
                        <pre></pre><pre></pre>
                        <div class="row">
                            <div class="col-6 offset-3">
                                <img src="{{ asset('Projects/' . $Project->img_name) }}" alt="hh" style="width: 650px; height: 450px;">
                            </div>
                            <div class="d-flex align-items-center author" style="margin-top: 20px;">
                                <div class="photo">
                                    <img src="{{asset('Members/'.$Project->Team->img_name)}}" alt="" class="img-fluid" style="width: 60px;">
                                </div>
                                <span style="color: darkgray">{{$Project->Team->signature}}</span>
                            </div>

                            <div class="col-2" style="margin-top: 20px;">
                                  <span style="color: darkgray">  <span>&bullet;</span>
                                        {{\Carbon\Carbon::parse($Project->created_at)->format('d-m-y')}}
                                  </span>
                            </div>
                        </div>

                        <pre></pre> <pre></pre><pre></pre><pre></pre><pre></pre>
                        <div style="display: flex; flex-direction: column; margin: 50px; padding: 20px; background-color: #f8f9fa;margin-top: 0">
                            <div style="display: flex; align-items: center;">
                                <h3>{{$Project->article}}</h3>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; margin: 50px; padding: 20px; background-color: #f8f9fa;margin-top: 0">
                            <div style="display: flex; align-items: center;">
                                <video width="640" height="360">
                                    <source src="{{asset('Projects/'.$Project->video_name)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>

                    </div>

                    <pre></pre>


                </div>
            </div>
        </section><!-- End Culture Category Section -->
    </main>
@endforeach
@endsection

@section('js')





@endsection
