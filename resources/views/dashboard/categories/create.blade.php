@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.add')</h1>

            <ol class="breadcrumb">
                <li> <a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> <a href="{{route('dashboard.categories.index')}}"><i class="fa fa-archive"></i> @lang('site.categories')</a></li>
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
                    <form action="{{route('dashboard.categories.store')}}" method="post">
                        {{csrf_field()}}
                        {{method_field('post')}}

                        @foreach(config('translatable.locales') as $locale)

                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" class="form-control" name="{{$locale}}[name]" value="{{old($locale . '.name')}}">
                            </div>

                        @endforeach

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form> {{--end of form--}}

                </div> {{--end of box body--}}

            </div> {{--  end of box--}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection