
<div id="comments" data-id="{{$model->id}}" data-type="{{$type}}">
    <div class="row flex-row-head comment-block-write">
        <div class="col hidden-xs">
            <h2>{{$model->name}} отзывы – <span class="col-reviews">{{$comments->count()}}</span></h2>
        </div>
        <div class="col">
            <button type="button" class="ui-button yellBtn write-comment-btn" >Написать отзыв</button>
        </div>
    </div>
    <div class="add-comment-block hidden" id="comment-form-block">
        <form  id="comment-form" novalidate>
            <div class="row">
                <div class="form-group col-lg-12 col-xs-12">
                    <label for="message" class="col-form-label required">Введите Ваше сообщение</label>
                    <textarea id="message" name="message" class="form-control" placeholder="Сообщение" maxlength="1000" required></textarea>
                    <span class="invalid-feedback" role="alert">
                        <strong class="error-message"></strong>
                    </span>
                </div>
                <div class="row d-lg-flex justify-content-between">
                    <div class="form-group col-lg-6">
                        <label for="email"  class="col-form-label">Введите E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Введите E-mail" >

                        <span class="invalid-feedback" role="alert">
                            <strong class="error-message"></strong>
                        </span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="name_sender" class="col-form-label required">Имя</label>
                        <input type="text" id="name_sender" name="name_sender" class="form-control" placeholder="Имя" required>

                        <span class="invalid-feedback" role="alert">
                            <strong class="error-message"></strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <input type="hidden" id="parent_id" name="parent_id" value="0">
                    <button type="submit" class="ui-button  yellBtn">Отправить</button>
                    <button type="button" class="ui-button ui-button-close close-comment-btn">Закрыть</button>
                </div>
            </div>
        </form>
    </div>
    @if ($comments->isNotEmpty())
        @foreach ($comments->toFlatTree() as $comment)

            <div class="comment-block-view {{$comment->isRoot() ? 'root':'child'}} " id="comment_item_{{$comment->id}}" data-id="{{$comment->id}}">
                <div class="comment-block">
                    <div class="comment-block-view-header d-md-flex">
                        <div class="col-12 col-md-6 d-flex justify-content-between justify-content-md-start align-items-center">
                            <h5 class="username">{{$comment->name}}</h5>
                            <button type="button" class="ui-button replay-btn ui-button-link">
                                <span class="ui-button-text answer-comment-btn">Ответить</span>
                            </button>
                        </div>
                        <div class="col-12 col-md-6 d-md-flex justify-content-end">
                            <span class="data">{{$comment->created_at->format('d.m.Y')}}</span>
                        </div>
                    </div>
                    <div class="comment-block-view-comment">
                        <p>
                            @if (!$comment->isRoot())
                                <strong>{{'@'.$comment->parent->name}}</strong>
                            @endif

                            <span>{{$comment->message}}</span>
                        </p>
                    </div>
                </div>
            </div>

        @endforeach
    @endif
</div>
