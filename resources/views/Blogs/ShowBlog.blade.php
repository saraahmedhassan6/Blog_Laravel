@extends('layouts.master')

@section('title')
    Post
@endsection

@section('css')

@endsection

@section('content')
@foreach($Blogs as $Blog)
    <main id="main">
        <section class="category-section">
            <div class="container" data-aos="fade-up">
                <div class="card-header pb-0">
                    <div class="">
                        <h1 style="text-align: center;">{{$Blog->title}}</h1>
                        <pre></pre><pre></pre>
                        <div class="row">
                            <div class="col-6 offset-3">
                                <img src="{{ asset('BlogImage/' . $Blog->img_name) }}" alt="hh" style="width: 650px; height: 450px;">
                            </div>
                            <div class="d-flex align-items-center author" style="margin-top: 20px;">
                                <div class="photo">
                                    <img src="assets/img/2.JPG" alt="" class="img-fluid" style="width: 60px;">
                                </div>
                                <span style="color: darkgray">{{$Blog->Team->signature}}</span>
                            </div>

                            <div class="col-2" style="margin-top: 20px;">
                                  <span style="color: darkgray">  <span>&bullet;</span>
                                        {{\Carbon\Carbon::parse($Blog->created_at)->format('d-m-y')}}
                                  </span>
                            </div>
                        </div>

                        <pre></pre> <pre></pre><pre></pre><pre></pre><pre></pre>
                        <div style="display: flex; flex-direction: column; margin: 50px; padding: 20px; background-color: #f8f9fa;margin-top: 0">
                            <div style="display: flex; align-items: center;">
                                <h3>{{$Blog->article}}</h3>
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
