@extends('layouts.cms')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>新闻管理</h2>
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
                                <!--
                                <div class="row">
                                    <div class="col-md-2 col-xs-12 ">
                                        <div class="dataTables_length" id="responsive-datatables_length"><label><span><select name="responsive-datatables_length" aria-controls="responsive-datatables" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-xs-12">
                                        <div id="responsive-datatables_filter" class="dataTables_filter">
                                            <form>
                                                <label><input type="search" class="form-control input-sm" placeholder="请输入手机号" aria-controls="responsive-datatables" name="mobile" value="{{Request::get('mobile')}}"></label>
                                            </form>
                                        </div>
                                    </div>
                                </div>-->
                                <table id="basic-datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>描述</th>
                                        <th>图片</th>
                                        <th>点赞数</th>
                                        <th>创建时间</th>
                                        <th>修改时间</th>
                                        <th style="min-width:120px">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>
                                        <td>{{ $post->image_path }}</td>
                                        <td>{{ $post->like_num }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->updated_at }}</td>
                                        <td>
                                            <a href="{{route('cms.post.edit',['id'=>$post->id])}}" class="btn btn-sm btn-info">编辑</a>
                                                <a href="{{route('cms.post.destroy',['id'=>$post->id])}}" class="btn btn-sm btn-info delete">删除</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                            {!! $posts->links() !!}
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
    $('.delete').click(function(){
        var url = $(this).attr('href');
        var obj = $(this).parents('td').parent('tr');
        if( confirm('该操作无法返回,是否继续?')){
            $.ajax(url, {
                dataType: 'json',
                method: 'DELETE',
                success: function(json){
                    if(json.ret == 0){
                        obj.remove();
                    }
                },
                error: function(){
                    alert('请求失败~');
                }
            });
        }
        return false;
    })

});
</script>
@endsection
