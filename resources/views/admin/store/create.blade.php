@extends('admin.master')

@section('main_content')
    <section class="content-header">

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>


        <div class="container" style="height: 100%;width: 100%;">
            <div class="" >
                <div class="item  " style="margin-top: 1%; box-shadow: 1px 1px 1px black;">
                    <div class="thumbnail" style="margin-top: 1%">
                        <h1 style="margin-left: 5%">ADD NEW STORE </h1>
                        <hr>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <center>
                          <!-- <p >Cover sekillerinizi asagidaki saheye click ederek artira bilersiniz</p> -->
                          <p>@lang('words.cover')</p>

                        </center>
                          <form action="{{ URL::to('/postCover') }}" class="dropzone" id="my-awesome-dropzone" >
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                 </div>
                           </form>

                                    <form class="form-horizontal form-label-left" novalidate style="margin-top: 5%; width:90%;margin-left: 5%;" action="{{ URL::to('/admin/store') }}" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="item form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> @lang('words.sname') <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12"  name="name" required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> @lang('words.saddress')
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" id="address" name="address"  required="required"   class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <input type="hidden" name="img_ids" id="imgs">
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phonenumber"> @lang('words.snumber')
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="phonenumber" name="phonenumber"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">@lang('words.semail') <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" id="email" name="email" required="required"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="decription">@lang('words.description') <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea type="text"  name="description" rows="8" required="required" maxlength="255"  class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slogan">Slogan<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text"  name="slogan" rows="8" required="required" maxlength="100"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <input type="hidden"  name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}"><br>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">@lang('words.profile')
                                                </label>
                                                <input type="file" name="avatar" class="btn btn-file">
<br>
                                               <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">@lang('words.cover')
                                                </label>
                                                <input type="file" name="cover"  class="btn btn-file"> -->

 <br>

                                                <button type="button" class="btn btn-primary" onclick="redirect()">Cancel</button>
                                                <input type="submit" class="btn btn-success" value="@lang('words.create')" >

                                            </div>
                                        </div>
                                    </form>

            <!-- /page content -->

                </div>
            </div>
</div>
            </div>

          

        <script>
            function redirect(){
                window.location="{{URL::to('/admin/store')}}";
            }
        </script>

    <script type="text/javascript">
         // $(document).ready(function(){

     $(function() {
         //img_id is used to recieve created cover image ids from server and giving this ids to server
         //in hidden field so that after the creation of store server can fill store_image table
         var img_id = "1";
       
         Dropzone.options.myAwesomeDropzone = {

         maxFilesize: 4,
         maxFiles: 3,
         dictFileTooBig: "Fayl Olcusu boyukdur. Max 4Mb",
         dictMaxFilesExceeded: "Siz 3 den artiq fayl daxil ede bilmezsiniz",

         success: function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
                
                img_id += "," + response;
                $('#imgs').val(img_id);
            
            }
        };
     
    });
 // });
</script>
    </section>
@stop
