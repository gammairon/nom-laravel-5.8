<hr/>

<div class="row">
    <div class="col">
          <h2>SEO</h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="seo[title]" class="col-form-label">{{ __('Title') }}</label>

            <div>
                <input id="seo[title]" type="text" class="form-control{{ $errors->has('seo.title') ? ' is-invalid' : '' }}" name="seo[title]" value="{{ old('seo.title', $seo->title) }}">

                @if ($errors->has('seo.title'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('seo.title') }}</strong>
                </span>
                @endif

            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="seo[description]" class="col-form-label text-md-right">{{ __('Description') }}</label>

            <div>
                <textarea name="seo[description]" id="seo[description]" class="form-control">{{old('seo.description', $seo->description)}}</textarea>

                @if ($errors->has('seo.description'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('seo.description') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="seo[keywords]" class="col-form-label text-md-right">{{ __('Keywords') }}</label>

            <div>
                <textarea name="seo[keywords]" id="seo[keywords]" class="form-control">{{old('seo.keywords', $seo->keywords)}}</textarea>

                @if ($errors->has('seo.keywords'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('seo.keywords') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="seo[canonical]" class="col-form-label">{{ __('Canonical') }}</label>

            <div>
                <input id="seo[canonical]" type="text" class="form-control{{ $errors->has('seo.canonical') ? ' is-invalid' : '' }}" name="seo[canonical]" value="{{ old('seo.canonical', $seo->canonical) }}" readonly>

                @if ($errors->has('seo.canonical'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('seo.canonical') }}</strong>
                </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-4 pt-2 pl-3" >
        <label>Robots</label>

        <div class="row">
            <div class="col">
               <div class="form-check">
                    <input type="radio" id="robot_index" class="form-check-input" name="seo[robot_index]" value="INDEX" {{ checked( 'INDEX', old('seo.robot_index', $seo->robot_index) ) }}>
                    <label for="robot_index">INDEX</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="robot_noindex" class="form-check-input" name="seo[robot_index]" value="NOINDEX" {{ checked( 'NOINDEX', old('seo.robot_index', $seo->robot_index) ) }}>
                    <label for="robot_noindex">NOINDEX</label>
                </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <input type="radio" id="robot_follow" class="form-check-input" name="seo[robot_follow]" value="FOLLOW" {{ checked( 'FOLLOW', old('seo.robot_follow', $seo->robot_follow) ) }}>
                    <label for="robot_follow">FOLLOW</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="robot_nofollow" class="form-check-input" name="seo[robot_follow]" value="NOFOLLOW" {{ checked( 'NOFOLLOW', old('seo.robot_follow', $seo->robot_follow) ) }}>
                    <label for="robot_nofollow">NOFOLLOW</label>
                </div>
            </div>
        </div>

    </div>

</div>