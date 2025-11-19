 @if ($posts->isNotEmpty())
     @foreach ($posts as $post)
        @include('front.partials.single_post', ['post' => $post])
     @endforeach
 @endif