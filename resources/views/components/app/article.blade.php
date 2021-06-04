<article>
	<div class="row">
		<div class="col-12 col-md-8">
			<h2 class="blog-post-title fw-bold">{{ $post->title }} <span
					class="text-sm-center fw-light fs-6 text-muted">رتبه: ۴ از ۵ (۴۲)</span>
			</h2>
		</div>
		<div class="col-12 col-md-4">
			<form action="#">
				<div class="row">
					<div class="col-12">
						<button class="w-100 btn btn-outline-danger btn-sm"
								type="submit">@lang('actions.delete') @lang('blog.article')</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<p class="blog-post-meta text-muted">{{ $post->created_at->diffForHumans() }}</p>

	{!! $post->body !!}

	<hr class="dashed-divider my-3"/>

	{{--List of comments--}}
	@if($post->comments->isNotEmpty())
		<p class="fw-bold fs-4">@lang('blog.comments')</p>
	@endif

	@foreach($post->comments as $comment)
		<div class="my-2">
			<x-comment-single :comment="$comment"/>
		</div>
	@endforeach

	{{--Submit new comment--}}
	<div class="my-3">
		<x-comment-input :post="$post"/>
	</div>

</article>