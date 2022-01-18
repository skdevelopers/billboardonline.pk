@extends('layouts.main')
@section('title', $posts->title)
@section('meta_keywords', $posts->meta_keywords)
@section('meta_description', $posts->meta_description)
@section('styles')

@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
                <h1 class="display-one">{{ ucfirst($posts->title) }}</h1>
                <div class="geodir-loop-container">
                    <blockquote class="blockquote mb-0 card-body">
                        <ul class="geodir-category-list-view clearfix gridview_onethird geodir-listing-posts geodir-gridview gridview_onethird">
                            @if(!empty($posts ))
                                <li class="gd_place type-gd_place status-publish has-post-thumbnail">
                                    <div class="gd-list-item-left ">
                                        <div class="geodir-post-slider">
                                            <div class="geodir-image-container geodir-image-sizes-medium_large">
                                                <div class="geodir-image-wrapper">
                                                    <ul class="geodir-post-image geodir-images clearfix">
                                                        <li>
                                                            <a href='#'>
                                                                <img src="{{ $posts->thumbnail }}" width="1440" height="960" class="geodir-lazy-load align size-medium_large" />
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <div class="clear"></div>
                    </blockquote>
                </div>
                <p>{!! $posts->body !!}</p>
                <hr>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
