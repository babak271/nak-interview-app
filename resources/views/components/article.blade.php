<article>
	<h2 class="blog-post-title fw-bold">{{ $post->title }} <span class="text-sm-center fw-light fs-6 text-muted">رتبه: ۴ از ۵ (۴۲)</span>
	</h2>
	<p class="blog-post-meta text-muted">{{ $post->created_at->diffForHumans() }}</p>

	{!! $post->body !!}

	@php
		$comment1=new \stdClass();
		$comment1->id=1;
		$comment1->body='عنوان نمونه دو';
		$comment1->body='در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.';
		$comment1->created_at=now();

		$comment2=new \stdClass();
		$comment2->id=2;
		$comment2->body='عنوان نمونه دو';
		$comment2->body='در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.';
		$comment2->created_at=now();
	@endphp

	<hr class="dashed-divider my-3"/>

	<p class="fw-bold fs-4">@lang('blog.comments')</p>

	{{--List of comments--}}
	@foreach([$comment1,$comment2] as $comment)
		<div class="my-2">
			<x-comment-single :comment="$comment"/>
		</div>
	@endforeach

	{{--Submit new comment--}}
	<div class="my-3">
		<x-comment-input :post="$post"/>
	</div>

</article>