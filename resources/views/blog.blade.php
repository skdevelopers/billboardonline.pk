@extends('layouts.main')
@section('styles')
    <style>


        img{
            height:150px;
            width:100%;
        }

        div [class^="col-"]{
            padding-left:5px;
            padding-right:5px;
        }
        .card{
            transition:0.5s;
            cursor:pointer;
        }
        .card-title{
            font-size:15px;
            transition:1s;
            cursor:pointer;
        }
        .card-title i{
            font-size:15px;
            transition:1s;
            cursor:pointer;
            color:#ffa710
        }
        .card-title i:hover{
            transform: scale(1.25) rotate(100deg);
            color:#18d4ca;

        }
        .card:hover{
            transform: scale(1.05);
            box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
        }
        .card-text{
            height:10px;
        }

        .card::before, .card::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform: scale3d(0, 0, 1);
            transition: transform .3s ease-out 0s;
            background: rgba(255, 255, 255, 0.1);
            content: '';
            pointer-events: none;
        }
        .card::before {
            transform-origin: left top;
        }
        .card::after {
            transform-origin: right bottom;
        }
        .card:hover::before, .card:hover::after, .card:focus::before, .card:focus::after {
            transform: scale3d(1, 1, 1);
        }


    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">Our Blog!</h1>
                        <p>Enjoy reading our posts. Click on a post to read!</p>
                    </div>

                </div>
                <div class="row">
                    @forelse($posts as $post)
                            <div class="col-md-3 col-sm-6">

                                <div class="card card-body">
                                    <a href="/blog/{{ $post->slug }}">
                                    <h4 class="card-title text-right">
                                        <span class="fa-layers fa-fw" style="background:DodgerBlue">
                                            <i class="fas fa-calendar"></i>
                                            <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-8 down-3" style="font-weight:900">
                                                {{ $post->created_at->format('d M') }}
                                            </span>
                                        </span>
                                    </h4>
                                    <img class="card-img-top" src="{{ $post->thumbnail }}" alt="{{ ucfirst($post->title) }}">
                                    <h5 class="card-title mt-3 mb-3">{{ ucfirst($post->title) }}</h5>
                                    <p class="card-text">{!!   \Illuminate\Support\Str::limit($post->body, 50, $end='...') !!}</p>
                                    </a>
                                </div>

                            </div>

                    @empty
                        <p class="text-warning">No blog Posts available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
