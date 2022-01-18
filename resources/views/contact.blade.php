@extends('layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box content-single">
                <article class="post-8 page type-page status-publish hentry">
                    <header>
                        <h1 class="entry-title">Contact US</h1>
                    </header>

                    <div class="container">
                        <div class="row-fluid">
                            <div class="span8">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3956.9747638085187!2d73.09988512710383!3d33.49081533664583!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dff2b7a6d0df4f%3A0x2c8f97ac2f012f9b!2sADVICE%20ASSOCIATES!5e0!3m2!1sen!2sus!4v1634161675833!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>

                            <div class="span4">
                                <h2>Contact us through</h2>
                                <address>
                                    <strong>Bill Board Online</strong><br>
                                    Hub Commercial One<br>
                                    Phase 8 Bahria Town<br>
                                    Rawalpindi<br>
                                    Pakistan<br>
                                    <abbr title="Phone">P:</abbr> 01234 567 890
                                </address>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ config('app.GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'></script>

@endsection
