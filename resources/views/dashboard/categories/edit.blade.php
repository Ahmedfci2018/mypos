@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.edit')</h1>

            <ol class="breadcrumb">
                <li> <a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> <a href="{{route('dashboard.categories.index')}}"><i class="fa fa-category"></i> @lang('site.categories')</a></li>
                <li class="active"><i class="fa fa-plus"></i> @lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h1 class="box-title"> @lang('site.edit')</h1>
                </div> {{--end of box header--}}

                <div class="box-body">

                    @include('partials._errors')
                    <form action="{{route('dashboard.categories.update',$category->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('put')}}

                        @foreach(config('translatable.locales') as $locale)

                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" class="form-control" name="{{$locale}}[name]" value="{{$category->translate($locale)->name}}">
                            </div>

                        @endforeach


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" ><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form> {{--end of form--}}

                </div> {{--end of box body--}}

            </div> {{--  end of box--}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
