@extends('layouts.main')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Slider */

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-slider
        {
            position: relative;
            display: block;
            box-sizing: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -khtml-user-select: none;
            -ms-touch-action: pan-y;
            touch-action: pan-y;
            -webkit-tap-highlight-color: transparent;
        }

        .slick-list
        {
            position: relative;
            display: block;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }
        .slick-list:focus
        {
            outline: none;
        }
        .slick-list.dragging
        {
            cursor: pointer;
            cursor: hand;
        }

        .slick-slider .slick-track,
        .slick-slider .slick-list
        {
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .slick-track
        {
            position: relative;
            top: 0;
            left: 0;
            display: block;
        }
        .slick-track:before,
        .slick-track:after
        {
            display: table;
            content: '';
        }
        .slick-track:after
        {
            clear: both;
        }
        .slick-loading .slick-track
        {
            visibility: hidden;
        }

        .slick-slide
        {
            display: none;
            float: left;
            height: 100%;
            min-height: 1px;
        }
        [dir='rtl'] .slick-slide
        {
            float: right;
        }
        .slick-slide img
        {
            display: block;
        }
        .slick-slide.slick-loading img
        {
            display: none;
        }
        .slick-slide.dragging img
        {
            pointer-events: none;
        }
        .slick-initialized .slick-slide
        {
            display: block;
        }
        .slick-loading .slick-slide
        {
            visibility: hidden;
        }
        .slick-vertical .slick-slide
        {
            display: block;
            height: auto;
            border: 1px solid transparent;
        }
        .slick-arrow.slick-hidden {
            display: none;
        }
    </style>
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box content-single">
                <article class="post-8 page type-page status-publish hentry">
                    <header>
                            <h1 class="entry-title">{{ request()->filled('search') || request()->filled('category') || request()->filled('roads') ? 'Search results' : 'All Locations' }}</h1>
                    </header>
                        <div class="entry-content entry-summary">
                            <div class="geodir-search-container geodir-advance-search-default" data-show-adv="default">
                                <form class="geodir-listing-search gd-search-bar-style" name="geodir-listing-search" action="{{ route('home') }}" method="get">
                                    <div class="geodir-loc-bar">
                                        <div class="clearfix geodir-loc-bar-in">
                                            <div class="geodir-search">
                                                <div class='gd-search-input-wrapper gd-search-field-cpt gd-search-field-taxonomy gd-search-field-categories'>
                                                    <select name="category" class="form-control select2 cat_select">
                                                        <option value="">Cities</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}"{{ old('category', request()->input('category')) == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class='gd-search-input-wrapper gd-search-field-cpt gd-search-field-taxonomy gd-search-field-categories'>
                                                    <select name="road" class="form-control select2 road_select" id="roads">
                                                        <option>Road</option>
                                                    </select>

                                                    <span class="help-block">{{ trans('cruds.road.fields.road_helper') }}</span>
                                                </div>
                                                <div class='gd-search-input-wrapper gd-search-field-cpt gd-search-field-taxonomy gd-search-field-categories'>
                                                    <select name="size" class="form-control select2 siz_select">
                                                        <option value="">Sizes</option>
                                                        @foreach($sizes as $size)
                                                            <option value="{{ $size->id }}"{{ old('size', request()->input('size')) == $size->id ? ' selected' : '' }}>{{ $size->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class='gd-search-input-wrapper gd-search-field-search'> <span class="geodir-search-input-label"><i class="fas fa-search gd-show"></i><i class="fas fa-times geodir-search-input-label-clear gd-hide" title="Clear field"></i></span>
                                                    <input class="search_text gd_search_text" name="search" value="{{ old('search', request()->input('search')) }}" type="text" placeholder="Search for" aria-label="Search for" autocomplete="off" />
                                                </div>
                                                <button class="geodir_submit_search" data-title="fas fa-search" aria-label="fas fa-search"><i class="fas fas fa-search" aria-hidden="true"></i><span class="sr-only">Search</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <header>
                                <h1 class="entry-title">{{  'Popular Locations' }}</h1>
                            </header>

                            <div class="geodir-loop-container">
                                <blockquote class="blockquote mb-0 card-body">
                                <ul class="geodir-category-list-view clearfix gridview_onethird geodir-listing-posts geodir-gridview gridview_onethird">
                                    @foreach($shops as $shop)

                                        @if(!empty($shop->featured)==1)
                                        <li class="gd_place type-gd_place status-publish has-post-thumbnail">
                                            <div class="gd-list-item-left ">
                                                <div class="geodir-post-slider">
                                                    <div class="geodir-image-container geodir-image-sizes-medium_large">
                                                        <div class="geodir-image-wrapper">
                                                            <ul class="geodir-post-image geodir-images clearfix">
                                                                <li>
                                                                    <a href='{{ route('location', $shop->name) }}'>
                                                                        <img src="{{ $shop->thumbnail }}" width="1440" height="960" class="geodir-lazy-load align size-medium_large" />
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gd-list-item-right ">
                                                <div class="geodir-post-title">
                                                    <h2 class="geodir-entry-title"> <a href="{{ route('location', $shop->name) }}" title="View: {{ $shop->name }}">{{ $shop->name }}</a></h2></div>
                                                @foreach($shop->categories as $category)
                                                    <div class="gd-badge-meta gd-badge-alignleft" title="{{ $category->name }}">
                                                        <div class="gd-badge" style="background-color:#ffb100;color:#ffffff;"><i class="fas fa-certificate"></i> <span class='gd-secondary'>{{ $category->name }}</span></div>
                                                    </div>
                                                @endforeach
                                                @if($shop->days->count())
                                                    <div class="geodir-post-meta-container">
                                                        <div class="geodir_post_meta gd-bh-show-field gd-lv-s-2 geodir-field-business_hours gd-bh-toggled gd-bh-{{ $shop->working_hours->isOpen() ? 'open' : 'close' }}" style="clear:both;">
                                                            <span class="geodir-i-business_hours geodir-i-biz-hours">
                                                                <i class="fas fa-clock" aria-hidden="true"></i><font>{{ $shop->working_hours->isOpen() ? 'Opened' : 'Closed' }} now</font>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="geodir-post-content-container">
                                                    <div class="geodir_post_meta  geodir-field-post_content" style='max-height:120px;overflow:hidden;'>{{ $shop->description }} <a href='{{ route('location', $shop->name) }}' class='gd-read-more  gd-read-more-fade'>Read more...</a></div>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="clear"></div>
                                </blockquote>
                            </div>
                            {{ $shops->appends(request()->query())->links('partials.pagination') }}
                            <header>
                                <h1 class="entry-title">{{  'New Locations' }}</h1>
                            </header>
                            <div class="geodir-loop-container">
                                <ul class="geodir-category-list-view clearfix gridview_onethird geodir-listing-posts geodir-gridview gridview_onethird">
                                    @foreach($shops as $shop)
                                        <li class="gd_place type-gd_place status-publish has-post-thumbnail">
                                            <div class="gd-list-item-left ">
                                                <div class="geodir-post-slider">
                                                    <div class="geodir-image-container geodir-image-sizes-medium_large">
                                                        <div class="geodir-image-wrapper">
                                                            <ul class="geodir-post-image geodir-images clearfix">
                                                                <li>
                                                                    <a href='{{ route('location', $shop->name) }}'>
                                                                        <img src="{{ $shop->thumbnail }}" width="1440" height="960" class="geodir-lazy-load align size-medium_large" />
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gd-list-item-right ">
                                                <div class="geodir-post-title">
                                                    <h2 class="geodir-entry-title"> <a href="{{ route('location', $shop->name) }}" title="View: {{ $shop->name }}">{{ $shop->name }}</a></h2></div>
                                                @foreach($shop->categories as $category)
                                                    <div class="gd-badge-meta gd-badge-alignleft" title="{{ $category->name }}">
                                                        <div class="gd-badge" style="background-color:#ffb100;color:#ffffff;"><i class="fas fa-certificate"></i> <span class='gd-secondary'>{{ $category->name }}</span></div>
                                                    </div>
                                                @endforeach
                                                @if($shop->days->count())
                                                    <div class="geodir-post-meta-container">
                                                        <div class="geodir_post_meta gd-bh-show-field gd-lv-s-2 geodir-field-business_hours gd-bh-toggled gd-bh-{{ $shop->working_hours->isOpen() ? 'open' : 'close' }}" style="clear:both;">
                                                            <span class="geodir-i-business_hours geodir-i-biz-hours">
                                                                <i class="fas fa-clock" aria-hidden="true"></i><font>{{ $shop->working_hours->isOpen() ? 'Opened' : 'Closed' }} now</font>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="geodir-post-content-container">
                                                    <div class="geodir_post_meta  geodir-field-post_content" style='max-height:120px;overflow:hidden;'>{{ $shop->description }} <a href='{{ route('location', $shop->name) }}' class='gd-read-more  gd-read-more-fade'>Read more...</a></div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <header>
                                <h1 class="entry-title">{{  'Company Logos' }}</h1>
                            </header>
                                <h2>Our  Partners</h2>

                                <section class="customer-logos slider">
                                    @foreach($logos as $logo)
                                    <div class="slide"><img src="{{ asset('logos') . '/' .  isset($logo) ? : asset('logos') . '/' .'profile-picture.png' }}"></div>
                                    @endforeach
                                </section>
                            <header>
                                <h1 class="entry-title">{{  'Videos Overview' }}</h1>
                            </header>
                            <div class="row">
                                @foreach($videos as $video)
                                <div class="col-sm-4" style="margin-bottom: 15px">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe width="336" height="190" src="{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <header>
                                <h1 class="entry-title">{{  'Recent From Our Blogs' }}</h1>
                            </header>
                            <div class="card-deck">
                                @foreach($posts as $post)
                                <div class="card">
                                    <a href="./blog/{{ $post->slug }}">
                                    <img class="card-img-top" src="{{ $post->thumbnail }}" alt="{{ ucfirst($post->title) }}" width="420" height="210" >
                                    <div class="card-body">
                                        <h5 class="card-title">{{ ucfirst($post->title) }}</h5>
                                        <p class="card-text">{!! Str::of($post->body)->limit(90) !!}</p>
                                        <p class="card-text"><small class="text-muted">Last updated {{ $post->created_at->format('d M') }}</small></p>
                                    </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <header>
                                <h1 class="entry-title">{{  'Advertisement' }}</h1>
                            </header>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Ads Banner</h5>
                                                <img class="responsive" width="620" height="220" src="{{ $banners[0]->getFirstMediaUrl('photos') }}" alt="SK Developers">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">ADs Square</h5>
                                                <p class="card-text"></p>
                                                <img class="responsive" width="220" height="220" src="{{ $banners[1]->getFirstMediaUrl('photos') }}" alt="Card image cap">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <footer class="entry-footer"></footer>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script>
    $(document).ready(function(){
        $('.customer-logos').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
    });

    $('.select2').select2()
    // when country dropdown changes
    $('.cat_select').change(function() {

        const categoryID = $(this).val();

        if (categoryID) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ url('/roads') }}?id=" + categoryID,
                success: function(res) {

                    if (res) {

                        $("#roads").empty();

                        $.each(res, function(key, value) {
                            $("#roads").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#roads").empty();
                    }
                }
            });
        } else {
            $("#roads").empty();
        }
    });

    // when state dropdown changes

</script>

@endsection
