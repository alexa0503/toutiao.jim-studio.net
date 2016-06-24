@extends('layouts.cms')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>新闻添加</h2>
                        <span class="txt"></span>
                    </div>

                </div>
                <!-- Start .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="panel panel-default">
                            <!-- Start .panel -->
                            <div class="panel-body pt0 pb0">
                                {{ Form::open(array('route' => ['cms.post.update',$post->id], 'class'=>'form-horizontal group-border stripped', 'method'=>'PUT', 'id'=>'form')) }}

                                    <div class="form-group">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">标题</label>
                                        <div class="col-lg-10 col-md-9">
                                            <input type="text" name="title" class="form-control" value="{{$post->title}}">
                                            <label class="help-block" for="title"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">描述</label>
                                        <div class="col-lg-10 col-md-9">
                                            <textarea name="description" class="form-control">{{$post->description}}</textarea>
                                            <label class="help-block" for="description"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-3 control-label" for="">缩略图</label>
                                        <div class="col-lg-10 col-md-9">
                                            <a href="{{asset($post->image_path)}}" target="_blank"><img src="{{asset($post->image_path)}}" class="img-polaroid" style="max-width:200px;max-height:200px;margin-bottom:20px;" /></a>
                                            <input type="file" name="image_path" class="filestyle" data-buttonText="Find file" data-buttonName="btn-danger" data-iconName="fa fa-plus">
                                            <label class="help-block" for="image_path"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">点赞数</label>
                                        <div class="col-lg-2 col-md-2">
                                            <input type="text" name="like_num" class="form-control" value="{{$post->like_num}}">
                                            <label class="help-block" for="like_num"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-3 control-label"></label>
                                        <div class="col-lg-10 col-md-9">
                                            <button class="btn btn-default ml15" type="submit">提 交</button>
                                            <a class="btn btn-default ml15" href="{{route('cms.post.index')}}">返回</a>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    {{ Form::close() }}
                            </div>
                        </div>
                        <!-- End .panel -->
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .page-content-inner -->
        </div>
        <!-- / page-content-wrapper -->
    </div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#form').ajaxForm({
        //data: data,
        dataType: 'json',
        //method: 'post',
        success: function() {
            $('#form .form-group .help-block').empty();
            $('#form .form-group').removeClass('has-error');
            location.href='{{url("cms/post")}}';
        },
        error: function(xhr){
            var json = jQuery.parseJSON(xhr.responseText);
            var keys = Object.keys(json);
            console.log(keys);
            $('#form .form-group .help-block').empty();
            $('#form .form-group').removeClass('has-error');
            $('#form .form-group').each(function(){
                var name = $(this).find('input,textarea').attr('name');
                if( jQuery.inArray(name, keys) != -1){
                    $(this).addClass('has-error');
                    $(this).find('.help-block').html(json[name]);
                }
            })
        }
    })
});
</script>
@endsection
