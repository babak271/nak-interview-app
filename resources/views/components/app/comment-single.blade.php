<div class="card">
	<div class="card-body">
		<p class="card-subtitle mb-2 text-muted">@lang('actions.submitted_at'){{ to_farsi_numbers($comment->created_at->diffForHumans()) }}
			@if($comment->rate)
				<span>(@lang('blog.rate'): {{ to_farsi_numbers($comment->rate) }} @lang('blog.out of') {{ to_farsi_numbers($comment->maxRate) }})</span>
		</p> @endif
		<p class="card-text text-dark">{{ $comment->body }}</p>
	</div>
</div>