@extends('front.layout.master')

@section('content')
	<main class="container-fluid">
		<div class="row">

			<div class="col-md-6">
				<div class="position-sticky" style="top: 0.5rem;">
					<div class="row flex-nowrap justify-content-between align-items-center">
						<div class="col-12 text-center">
							<a class="text-dark text-decoration-none fs-1"
							   href="#">@lang('actions.submit') @lang('blog.article')</a>
						</div>
					</div>

					<div class="row my-3 mb-5">
						<div class="col-12">
							<form action="#">
								<div class="row">
									<div class="col-12">
										<x-text-input name="title" :title="__('blog.title')"/>
									</div>

									<div class="col-12">
										<x-textarea-input name="body" :title="__('blog.body')" :is-tiny="true"/>
									</div>
								</div>

								<button class="mt-4 w-100 btn btn-primary btn-lg"
										type="submit">@lang('actions.submit') @lang('blog.article')</button>

								<hr class="my-4">
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="row flex-nowrap justify-content-between align-items-center mt-3">
					<div class="col-12 text-center">
						<a class="logo text-dark text-decoration-none fs-1" href="#">@lang('blog.blog')</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<hr>
						@php
							$post1=new \stdClass();
							$post1->id=1;
							$post1->title='عنوان نمونه دو';
							$post1->body='<p> در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>';
							$post1->created_at=now();

							$post2=new \stdClass();
							$post2->id=2;
							$post2->title='عنوان نمونه دو';
							$post2->body='<p> در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>';
							$post2->created_at=now();
						@endphp

						@foreach([$post1,$post2] as $post)
							<x-article :post="$post"/>
							<hr>
						@endforeach
						@foreach([$post1,$post2] as $post)
							<x-article :post="$post"/>
							<hr>
						@endforeach
						@foreach([$post1,$post2] as $post)
							<x-article :post="$post"/>
							<hr>
						@endforeach

					</div>
				</div>
			</div>
		</div>
	</main>

@endsection