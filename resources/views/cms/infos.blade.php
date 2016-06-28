@extends('layouts.cms')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>信息</h2>
                        <span class="txt"></span>
                    </div>

                </div>
                <!-- Start .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="panel panel-default">
                            <!-- Start .panel -->
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-2 col-xs-12 ">
                                        <div class="dataTables_length" id="responsive-datatables_length"><label><span></span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-xs-12">
                                        <div id="responsive-datatables_filter" class="dataTables_filter">
                                            <form>
                                                <label><input type="search" class="form-control input-sm" placeholder="请输入用户昵称" aria-controls="responsive-datatables" name="nickname" value="{{Request::get('nickname')}}"></label>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table id="basic-datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>微信昵称</th>
                                        <th>标题</th>
                                        <th>上传图片</th>
                                        <th><a href="{{url('cms/infos')}}?order=num">
                                            @if (\Request::get('order') == 'num')
                                                <i class="fa fa-arrow-down"></i>
                                            @endif
                                            点赞数</a></th>
                                        <th>是否扫码</th>
                                        <th><a href="{{url('cms/infos')}}?order=time">
                                            @if (\Request::get('order') == 'time')
                                                <i class="fa fa-arrow-down"></i>
                                            @endif
                                            创建时间</a></th>
                                        <th>创建IP</th>
                                        <th style="min-width:120px;">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($infos as $info)
                                    <tr>
                                        <td><a href="{{url('cms/wechat',['id'=>$info->user->id])}}">{{ json_decode($info->user->nick_name) }}</a></td>
                                        <td>{{ $info->title }}</td>
                                        <td><a href="{{ asset($info->image_path) }}" target="_blank"><img src="{{ asset($info->image_path) }}" style="max-width:200px;max-height:200px;" class="img-polaroid" /></a></td>
                                        <td>{{ $info->like_num }}</td>
                                        <td>{{ $info->is_scan == 1 ? '是' : '否' }}</td>
                                        <td>{{ $info->created_at }}</td>
                                        <td>{{ $info->ip_address }}</td>
                                        <td><a href="{{url('cms/info/update',['id'=>$info->id])}}" class="btn btn-sm btn-primary update">修改</a> <a href="{{url('cms/info/disable',['id'=>$info->id])}}" class="btn btn-sm btn-warning disable">@if ($info->is_activity == 1)禁用@else激活@endif</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                            {!! $infos->appends(['order' => Request::get('order')])->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .panel -->
                    </div>
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
    $('.update').click(function(){
        var obj = $(this);
        var url = obj.attr('href');
        var tr = obj.parent('td').parent('tr').find('td');
        if( obj.text() == '修改' ){
            tr.eq(3).html('<input value="'+tr.eq(3).text()+'" name="like_num" class="input-sm" />');
            obj.removeClass('btn-info').addClass('btn-warning').text('更新');
        }
        else{
            var data = {
                'like_num':tr.find('input[name="like_num"]').val()
            };
            $.ajax(url, {
                dataType: 'json',
                data:data,
                method:'post',
                success: function(json){
                    if(json.ret == 0){
                        tr.eq(3).html(json.data.like_num);
                        obj.removeClass('btn-warning').addClass('btn-info').text('修改');
                    }
                },
                error: function(){
                    alert('服务器异常，请求失败~');
                }
            });
        }
        return false;
    })
    $('.disable').click(function(){
        var obj = $(this);
        var url = obj.attr('href');
        $.ajax(url, {
            dataType: 'json',
            method:'post',
            success: function(json){
                if(json.ret == 0){
                    if( obj.text() == '禁用' ){
                        obj.text('激活');
                    }
                    else{
                        obj.text('禁用');
                    }
                }
            },
            error: function(){
                alert('服务器异常，请求失败~');
            }
        });

        return false;
    });
});
</script>
@endsection
