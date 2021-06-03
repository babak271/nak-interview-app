<article>
	<h2 class="blog-post-title fw-bold">{{ $post->title }}</h2>
	<p class="blog-post-meta text-muted">{{ $post->created_at->diffForHumans() }}</p>

	{!! $post->body !!}
</article>