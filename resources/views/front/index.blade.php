<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="{{ mix('assets/css/style.css') }}">
	<title>Laravel</title>

</head>
<body dir="rtl">
<div class="container">
	<header class="blog-header py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="col-12 text-center">
				<a class="blog-header-logo text-dark fs-1" href="#">مقالات</a>
			</div>
		</div>
	</header>
</div>

<main class="container">
	<div class="row">
		<div class="col-12">
			<hr>
			@php
				$post1=new \stdClass();
				$post1->title='عنوان نمونه دو';
				$post1->body='<p> در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>';
				$post1->created_at=now();

				$post2=new \stdClass();
				$post2->title='عنوان نمونه دو';
				$post2->body='<p> در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>';
				$post2->created_at=now();
			@endphp

			@foreach([$post1,$post2] as $post)
				<x-article :post="$post"/>
				<hr>
			@endforeach
		</div>
	</div>
</main>
<script src="{{ mix('assets/js/script.js') }}"></script>
</body>
</html>
