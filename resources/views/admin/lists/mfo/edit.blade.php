@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Редактирование Списка МФО') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.lists.mfo.update', $listMfo) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-xs-12 col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Имя Списка') }}</label>

                                        <div>
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $listMfo->name) }}" required>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('admin.lists.mfo.lists', ['defaultMfos'=>$defaultMfos, 'selectedMfos'=>$selectedMfos])


                            <div class="form-group row mb-0 mt-4">
                                <div class="col-md-6 offset-md-3 text-center">

                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Обновить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
