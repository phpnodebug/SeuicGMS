@extends("backend.layout.main")

@inject('rolePresenter','App\Presenters\RolePresenter')

@section("content")
    @ability('superadmin','backend.role.create')
    @include('backend.components.handle',$handle = $rolePresenter->getHandle())
   @endability
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">角色列表</h3>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>角色ID</th>
                            <th>角色标识</th>
                            <th>角色名称</th>
                            <th>角色描述</th>
                            <th>操作</th>
                        </tr>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->display_name}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    @ability('superadmin','backend.role.datarule')

                                    <a href="{{route('backend.role.datarule',['id'=>$item->id])}}" class="btn btn-success btn-flat">数据</a>
                                   @endability

                                    @ability('superadmin','backend.role.permission')

                                    <a href="{{route('backend.role.permission',['id'=>$item->id])}}" class="btn btn-info btn-flat">赋权</a>
                                   @endability


                                    @ability('superadmin','backend.role.edit')
                                    <a href="{{route('backend.role.edit',['id'=>$item->id])}}" class="btn btn-primary btn-flat">编辑</a>
                                    @endability


                                    @ability('superadmin','backend.role.destroy')

                                    <button class="btn btn-danger btn-flat"
                                            data-url="{{URL::to('backend/role/'.$item->id)}}"
                                            data-toggle="modal"
                                            data-target="#delete-modal"
                                    >
                                        删除
                                    </button>
                                   @endability

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @if($data->render())
                    <div class="box-footer clearfix">
                        {!! $data->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section("after.js")
    @include('backend.components.modal.delete',['title'=>'操作提示','content'=>'你确定要删除这名角色吗?'])
@endsection
