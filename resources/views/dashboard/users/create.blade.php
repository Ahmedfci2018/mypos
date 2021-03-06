@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.add')</h1>

            <ol class="breadcrumb">
                <li> <a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> <a href="{{route('dashboard.users.index')}}"><i class="fa fa-user"></i> @lang('site.users')</a></li>
                <li class="active"><i class="fa fa-plus"></i> @lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h1 class="box-title"> @lang('site.add')</h1>
                </div> {{--end of box header--}}

                <div class="box-body">

                    @include('partials._errors')
                    <form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('post')}}

                        <div class="form-group">
                            <label>@lang('site.first_name')</label>
                            <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.last_name')</label>
                            <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" class="form-control image" name="image">
                        </div>

                        <div class="form-group">
                            <img src="{{asset('uploads/users_images/default.png')}}" style="width: 100px;height: 100px" class="img-thumbnail image-preview">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.password')</label>
                            <input type="password" class="form-control" name="password" value="{{old('password')}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.password_confirmation')</label>
                            <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
                        </div>

                        <div class="form-group">

                            {{--nav tap--}}
                            <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">

                                @php
                                    $models=['users','categories','products','clients','orders'];
                                    $maps=['create','read','update','delete'];
                                @endphp
                                <ul class="nav nav-tabs">
                                    @foreach($models as $index=>$model)

                                        <li class="{{$index == 0 ?'active':''}}"><a href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>

                                    @endforeach
                                </ul>

                                <div class="tab-content">

                                    @foreach($models as $index=>$model)

                                        <div class="tab-pane {{$index==0 ? 'active' : ''}}" id="{{$model}}">

                                            @foreach($maps as $map)
                                                <label><input type="checkbox" name="permissions[]" value="{{$map.'_'.$model}}">@lang('site.'.$map)</label>
                                            @endforeach
                                        </div>{{--end of tab pane--}}

                                    @endforeach


                                </div>{{--end of tab content--}}

                            </div> {{--end of nav tabs--}}

                            <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i> @lang('site.add')</button>

                        </div>

                    </form> {{--end of form--}}

                </div> {{--end of box body--}}

            </div> {{--  end of box--}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
