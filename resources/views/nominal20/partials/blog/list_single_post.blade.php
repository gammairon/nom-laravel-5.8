@if ($posts->isNotEmpty())
    @foreach ($posts as $post)
        @include('nominal20.partials.blog.single_post', ['post' => $post])
    @endforeach
@endif
