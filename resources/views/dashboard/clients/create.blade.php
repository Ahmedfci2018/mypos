@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.add')</h1>

            <ol class="breadcrumb">
                <li> <a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> <a href="{{route('dashboard.clients.index')}}"><i class="fa fa-archive"></i> @lang('site.clients')</a></li>
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
                    <form action="{{route('dashboard.clients.store')}}" method="post">
                        {{csrf_field()}}
                        {{method_field('post')}}

                        <div class="form-group">
                            <label>@lang('site.name')</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>

                        @for($i=0; $i<2; $i++)

                            <div class="form-group">
                                <label>@lang('site.phone.' . $i)</label>
                                <input type="text" class="form-control" name="phone[]">
                            </div>

                        @endfor

                        <div class="form-group">
                            <label>@lang('site.address')</label>
                            <input type="text" class="form-control" name="address" value="{{old('address')}}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form> {{--end of form--}}

                </div> {{--end of box body--}}

            </div> {{--  end of box--}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
