@extends('home')

@push('script-head')
@endpush

@section('main_content')

    <div class="row">
        <h1 class="page-header">{{ trans('messages.menu') }} <small>{{ $menu->title }}</small></h1>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.date_start') }}</strong>
            </p>
        </div>
        <div class="col-sm-6">{{ $menu->date_start }}</div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.date_end') }}</strong>
            </p>
        </div>
        <div class="col-sm-6">{{ $menu->date_end }}</div>
    </div>


    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.site') }}</strong>
            </p>
        </div>
        <div class="col-sm-6">
            {{ $menu->site->name }}
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.period') }}</strong>
            </p>
        </div>
        <div class="col-sm-6">
            @if ($menu->period)
                <span class="label label-success">{{ trans('messages.noon') }}</span>
            @else
                <span class="label label-primary">{{ trans('messages.evening') }}</span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.isMain') }}</strong>
            </p>
        </div>
        <div class="col-sm-6">
            @if ($menu->isMain)
                <span class="label label-success">{{ trans('messages.yes') }}</span>
            @else
                <span class="label label-danger">{{ trans('messages.no') }}</span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.label') }}</strong>
            </p>
        </div>
        <div class="col-sm-6">
            {{ $menu->label->name }} (Fr. {{ $menu->label->price }})
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.title') }}</strong>
            </p>
        </div>

        <div class="col-sm-6">
            {{ $menu->translate('fr')->title }}
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.accompaniment') }}</strong>
            </p>
        </div>
        <div class="col-sm-6">
            <div class="well">
                {!! $menu->translate('fr')->accompaniment !!}
            </div>

            <div class="well">
                {!! $menu->translate('de')->accompaniment !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="pull-right">
                <strong>{{ trans('messages.veg') }}</strong>
            </p>
        </div>
        <div class="col-sm-6">
            <div class="well">
                {!! $menu->translate('fr')->veg !!}
            </div>

            <div class="well">
                {!! $menu->translate('de')->veg !!}
            </div>
        </div>
    </div>





    <hr>

    <div class="row">
        <div class="col-sm-offset-2 col-sm-6">
            {!! BootForm::open()->action(route('menus.destroy', ['id' => $menu->id]))->delete() !!}

            <a class="btn btn-small btn-default" href="{{ URL::previous() }}"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> {{ trans('messages.go_back') }}</a>
            <a class="btn btn-small btn-primary" href="{{ URL::to('menus/' . $menu->id . '/edit') }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> {{ trans('messages.edit') }}</a>
            {!! BootForm::submit( '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ' . trans('messages.delete'), 'btn-danger') !!}

            {!! BootForm::close() !!}
        </div>
    </div>




@endsection