<div class="card">
	<div class="card-body">
		<h6 class="card-subtitle mb-2 text-muted">@lang('actions.submitted_at'){{ $comment->created_at->diffForHumans() }}
			<span>(@lang('blog.rate'): ۴ @lang('blog.out of') ۵)</span></h6>
		<p class="card-text">{{ $comment->body }}</p>
	</div>
</div>