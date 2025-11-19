<div class="row">
    <div class="col-xs-12 col-md-8 offset-md-2">
        <div class="form-group photo-wrap">
            <div class="input-group">
                <span class="input-group-btn">
                    <a data-input="thumbnail" data-preview="holder" class="photo btn btn-primary">
                        <i class="fa fa-picture-o"></i> Выбрать фото
                     </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="primary_media[url]" value="{{old('primary_media.url', $model->getPrimaryUrl())}}">

            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <img id="holder" class="holder" src="{{old('primary_media.url', $model->getPrimaryUrl())}}">
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="mb-3">
                        <label for="alt_logo" class="col-form-label text-md-right">{{ __('Alt') }}</label>
                        <input id="alt_logo" class="form-control" type="text" name="primary_media[alt]" value="{{old('primary_media.alt', $model->getPrimaryAlt())}}">
                    </div>
                    <div class="mb-3">
                        <label for="title_logo" class="col-form-label text-md-right">{{ __('Title') }}</label>
                        <input id="title_logo" class="form-control" type="text" name="primary_media[title]" value="{{old('primary_media.title',  $model->getPrimaryTitle())}}">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
