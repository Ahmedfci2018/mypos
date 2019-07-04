@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li> <a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active"><i class="fa fa-user"></i> @lang('site.users')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h1 class="box-title"> @lang('site.users') <small>{{$users->total()}}</small></h1>

                    <form action="{{route('dashboard.users.index')}}" method="get">
                        
                        <div class="row">
                            
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="@lang('site.search')">
                            </div>
                            
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if(auth()->user()->hasPermission('create_users'))
                                    <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div> {{--end of box header--}}

                <div class="box-body">

                    <table class="table table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $index=>$user)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><img src="{{$user->image_path}}" class="img-thumbnail" style="width: 100px;height: 100px"></td>
                                    <td>
                                        @if(auth()->user()->hasPermission('update_users'))
                                            <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_users'))
                                            <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post" style="display: inline-block">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                <button class="btn-sm btn btn-danger delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form>
                                        @else
                                            <button class="btn-sm btn btn-danger disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table> {{--end of table--}}

                    {{$users->links()}}

                </div> {{--end of box body--}}

            </div> {{--  end of box--}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection