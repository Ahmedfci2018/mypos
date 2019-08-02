@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li> <a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active"><i class="fa fa-client"></i> @lang('site.clients')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h1 class="box-title"> @lang('site.clients') <small>{{$clients->total()}}</small></h1>

                    <form action="{{route('dashboard.clients.index')}}" method="get">
                        
                        <div class="row">
                            
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="@lang('site.search')">
                            </div>
                            
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if(auth()->user()->hasPermission('create_clients'))
                                    <a href="{{route('dashboard.clients.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
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
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone.0')</th>
                                <th>@lang('site.address')</th>
                                <th>@lang('site.orders')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($clients as $index=>$client)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{implode($client->phone, ' - ')}}</td>
                                    <td>{{$client->address}}</td>
                                    <td><a href="{{route('dashboard.clients.orders.index',$client->id)}}" class="btn btn-primary btn-sm">@lang('site.add_order')</a></td>
                                    <td>
                                        @if(auth()->user()->hasPermission('update_clients'))
                                            <a href="{{route('dashboard.clients.edit',$client->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_clients'))
                                            <form action="{{route('dashboard.clients.destroy',$client->id)}}" method="post" style="display: inline-block">
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

                    {{$clients->links()}}

                </div> {{--end of box body--}}

            </div> {{--  end of box--}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
