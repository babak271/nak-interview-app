<div class="card">
	<div class="card-body">
		<h6 class="card-subtitle mb-2 text-muted">@lang('actions.submitted_at'){{ $comment->created_at->diffForHumans() }}
			@if($comment->rate) <span>(@lang('blog.rate'): {{ $comment->rate }} @lang('blog.out of') {{ $comment->maxRate }})</span></h6> @endif
		<p class="card-text">{{ $comment->body }}</p>
	</div>
</div>