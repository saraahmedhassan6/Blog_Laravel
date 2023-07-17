@extends('layouts.master')

@section('title')
    SaraBlog
@endsection

@section('css')
@endsection

@section('content')
    <main id="main">
        <!-- ======= Post Grid Section ======= -->
        <section id="posts" class="posts">

            @foreach($Blogs as $Blog)
                <div style="display: flex; flex-direction: column; margin: 80px; padding: 20px; background-color: #f8f9fa;margin-top: 0">
                    <div style="display: flex; align-items: center;">
                        <div style="flex: 1;"><img src="{{asset('BlogImage/'.$Blog->thumbnail)}}" alt="hh" style="width: 350px; height: 350px;"></div>
                        <div style="flex: 2; margin-left: 20px;">
                            <div style="display: flex; flex-direction: column;">
                                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                                    <h3 style="max-width: 800px; !important;  word-wrap: break-word ; top: 10px!important;">{{$Blog->title}} </h3>
                                </div>
                                <div style="max-width: 800px; !important;  word-wrap: break-word ;">{{implode(' ', array_slice(explode(' ', $Blog->article), 0, 50))}}</div>
                            </div>
                            <div class="">
                                <pre></pre>
                                <pre></pre>

                                <a href="{{ url('ShowBlog') }}/{{ $Blog->id }}" class="modal-effect btn btn-sm btn-primary" style="color:white;"><i
                                        class="fas fa-plus"></i>&nbsp; Read More
                                </a>
                                <pre></pre>

                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 20px;"><span style="color: darkgray">  <span>&bullet;</span>
                             {{\Carbon\Carbon::parse($Blog->created_at)->format('d-m-y')}}</span></div>
                    <div class="d-flex align-items-center author" style="margin-top: 20px;">
                        <div class="photo">
                            <img src="url('{{asset('Members/'.$Blog->Team->img_name)}}')" alt="" class="img-fluid" style="width: 60px;height:70px;">
                        </div>
                        <span style="color: darkgray">{{$Blog->Team->signature}}</span>
                    </div>

                </div>
                <pre></pre>
            @endforeach

        </section>


    </main><!-- End #main -->
@endsection

@section('js')
@endsection
