@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.edit')</h1>

            <ol class="breadcrumb">
                <li> <a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> <a href="{{route('dashboard.products.index')}}"><i class="fa fa-archive"></i> @lang('site.products')</a></li>
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
                    <form action="{{route('dashboard.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}

                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select class="form-control" name="category_id">
                                <option value="">@lang('site.all_categories')</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$product->category_id==$category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach(config('translatable.locales') as $locale)

                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" class="form-control" name="{{$locale}}[name]" value="{{$product->translate($locale)->name}}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.description')</label>
                                <textarea class="form-control ckeditor" name="{{$locale}}[description]">{{$product->translate($locale)->description}}</textarea>
                            </div>

                        @endforeach

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" class="form-control image" name="image">
                        </div>

                        <div class="form-group">
                            <img src="{{$product->image_path}}" style="width: 100px;height: 100px" class="img-thumbnail image-preview">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.purchase_price')</label>
                            <input type="number" class="form-control" name="purchase_price" value="{{$product->purchase_price}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.sale_price')</label>
                            <input type="number" class="form-control" name="sale_price" value="{{$product->sale_price}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.stock')</label>
                            <input type="text" class="form-control" name="stock" value="{{$product->stock}}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i> @lang('site.edit')</button>
                        </div>

                    </form> {{--end of form--}}

                </div> {{--end of box body--}}

            </div> {{--  end of box--}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
