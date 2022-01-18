@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/back/vendor/dropzone/dist/min/dropzone.min.css')}}">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link type="text/css" rel="stylesheet" href="{{asset('assets/back/jquery-plugin/image-uploader/src/image-uploader.css')}}">
@endsection

@section('content')
<div class="header bg-primary pb-6">

  <div class="container-fluid">
    <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Admin</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Manage</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Main Slider</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
<!--               <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
            </div>
          </div>
        </div>
  </div>
  </div>



<div class="container-fluid mt--6">
                   <div class="row mb-1">
                  <div class="col-md-8 ml-auto mr-auto">
                    @include('layouts.flash-message')
                  </div>
                 </div>
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <div class="card">
                            <form id="SK-form" class="form-horizontal" action="{{url('/admin/edit-slider')}}" name="validate" method="post" enctype="multipart/form-data"> @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Add Slider</h4>
                                    @include('layouts.flash-message')
                                     <div class="form-group row">
                                        <div class="col-sm-12">
                                         <div class="alert alert-warning">Upload valid Image. only JPEG are Allowed</div>
                                        </div>
                                      </div>
                                      <label for="cono1" class="col-sm-12 control-label col-form-label"><b>Slider Image</b></label>

                                        <div class="dropzone dropzone-single mb-3" data-toggle="dropzone" data-dropzone-url="http://">
                                          <div class="fallback">
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" value="" id="projectCoverUploads">
                                              <label class="custom-file-label" for="projectCoverUploads">Choose file</label>
                                            </div>
                                          </div>
                                          <div class="dz-preview dz-preview-single">
                                            <div class="dz-preview-cover">
                                              <img class="dz-preview-img" src="{{asset('assets/front/images/slider/1.jpg')}}" alt="..." data-dz-thumbnail>
                                            </div>
                                          </div>
                                        </div>

                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-12 control-label col-form-label"><b>Image Description {{$slider->title}}</b></label>
                                        <div class="col-sm-12">
                                            <textarea type="textarea" class="form-control required" name="description" required="" placeholder="Add description to put it on the Slider">{{$slider->title}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                            <img id="image_preview_container" src="{{asset('assets/front/images/slider/1.jpg')}}"
                        alt="" class="img-fluid img-thumbnail mb-10" style="max-height: 200px;">
                                  </div>
                                      <div class="form-group row">

                                        <label for="title" class="col-sm-3 text-right control-label col-form-label"><b>Enable</b></label>

                                        <div class="col-sm-9">
                                           <label class="custom-toggle custom-toggle-default">
                                            <input type="checkbox" checked>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                          </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>

</div>

@endsection

@section('scripts')


<script type="text/javascript">

</script>





 @endsection
