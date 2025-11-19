<hr/>

<div class="row mt-4 mb-3">
    <div class="col">
        <h3>
            <div class="form-check mb-3 mt-3 h5">
                <input type="hidden" name="enable_faq" value="0">
                <input class="form-check-input" type="checkbox" id="enable_faq" name="enable_faq" value="1" {{checked(1, old('enable_faq', $enable_faq) )}} >
                <label class="form-check-label" for="enable_faq">Включить FAQ</label>
            </div>
        </h3>
    </div>
</div>

<div id="collapseFaq" class="collapse" aria-labelledby="headingFaq">
    <div class="row">
        <div class="col">
            <div id="faq-fields" class="form-group faq-multi-fields">
                @foreach (old('faqs', $faqs) as $key => $faq)

                    <div class="faq-multi-field">
                        <div class="mt-4 mb-4">
                            <a href="#" class="faq-remove_multi_field btn btn-danger">Удалить</a>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label text-md-right">{{ __('Вопрос') }}</label>

                                    <div>
                                        <input type="text" class="form-control" name="faqs[{{$key}}][question]" value="{{ old('faqs['.$key.'][question]', $faq['question']) }}">
                                    </div>
                                </div>

                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label text-md-right">{{ __('Ответ') }}</label>

                                    <div>
                                        <textarea name="faqs[{{$key}}][answer]" class="form-control html-editor">{{ old('faqs['.$key.'][answer]', $faq['answer']) }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                @endforeach
                <div class="faq-multi-fields-container">

                </div>
                <div class="mt-4 mb-4">
                    <a href="#" class="faq-add_multi_field btn btn-success" data-template="#faqs">Добавить Вопрос/Ответ</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/template" id="faqs">
    <div class="faq-multi-field">
        <div class="mt-4 mb-4">
            <a href="#" class="faq-remove_multi_field btn btn-danger">Удалить</a>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label text-md-right">{{ __('Вопрос') }}</label>

                    <div>
                        <input type="text" class="form-control" name="faqs[<%= count %>][question]" >
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label text-md-right">{{ __('Ответ') }}</label>

                    <div>
                        <textarea name="faqs[<%= count %>][answer]" class="form-control html-editor"></textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</script>

<hr/>

