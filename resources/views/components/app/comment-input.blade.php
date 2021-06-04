<form action="{{ route('posts.comments.store',$post) }}" method="post">
	@csrf
	<div class="row">
		<div class="col-md-12">
			<x-textarea-input name="body" id="comment-{{ $post->id }}"
							  :placeholder="__('blog.comment_placeholder')"
							  label-class="form-label fs-5"
							  :title="__('blog.your_comment')" :is-tiny="false"/>
		</div>
	</div>

	<div class="col-md-12">
		{{--Derived from https://codepen.io/Souleste/pen/QXmgrV --}}
		<div class="stars">
			<label class="rate">
				<input type="radio" name="rate" id="star1" value="1">
				<div class="face"></div>
				<i class="far fa-star star one-star"></i>
			</label>
			<label class="rate">
				<input type="radio" name="rate" id="star2" value="2">
				<div class="face"></div>
				<i class="far fa-star star two-star"></i>
			</label>
			<label class="rate">
				<input type="radio" name="rate" id="star3" value="3">
				<div class="face"></div>
				<i class="far fa-star star three-star"></i>
			</label>
			<label class="rate">
				<input type="radio" name="rate" id="star4" value="4">
				<div class="face"></div>
				<i class="far fa-star star four-star"></i>
			</label>
			<label class="rate">
				<input type="radio" name="rate" id="star5" value="5">
				<div class="face"></div>
				<i class="far fa-star star five-star"></i>
			</label>
		</div>
	</div>

	<button class="mt-4 w-100 btn btn-outline-primary btn-lg"
			type="submit">@lang('actions.submit') @lang('blog.comment')</button>
</form>

@push('styles')
	{{--Derived from https://codepen.io/Souleste/pen/QXmgrV --}}
	<style>
		.stars {
			width: fit-content;
			margin: 0 auto;
			cursor: pointer;
		}
		.star {
			color: #91a6ff !important;
		}
		.rate {
			height: 50px;
			margin-left: -5px;
			padding: 5px;
			font-size: 25px;
			position: relative;
			cursor: pointer;
		}
		.rate input[type="radio"] {
			opacity: 0;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,0%);
			pointer-events: none;
		}
		.star-over::after {
			font-family: 'Font Awesome 5 Pro';
			font-weight: 900;
			font-size: 16px;
			content: "\f005";
			display: inline-block;
			color: #d3dcff;
			z-index: 1;
			position: absolute;
			top: 17px;
			left: 10px;
		}

		.rate:nth-child(1) .face::after {
			content: "\f119"; /* ☹ */
		}
		.rate:nth-child(2) .face::after {
			content: "\f11a"; /* 😐 */
		}
		.rate:nth-child(3) .face::after {
			content: "\f118"; /* 🙂 */
		}
		.rate:nth-child(4) .face::after {
			content: "\f580"; /* 😊 */
		}
		.rate:nth-child(5) .face::after {
			content: "\f59a"; /* 😄 */
		}
		.face {
			opacity: 0;
			position: absolute;
			width: 35px;
			height: 35px;
			background: #91a6ff;
			border-radius: 5px;
			top: -50px;
			left: 2px;
			transition: 0.2s;
			pointer-events: none;
		}
		.face::before {
			font-family: 'Font Awesome 5 Pro';
			font-weight: 900;
			content: "\f0dd";
			display: inline-block;
			color: #91a6ff;
			z-index: 1;
			position: absolute;
			left: 9px;
			bottom: -15px;
		}
		.face::after {
			font-family: 'Font Awesome 5 Pro';
			font-weight: 900;
			display: inline-block;
			color: #fff;
			z-index: 1;
			position: absolute;
			left: 5px;
			top: -1px;
		}

		.rate:hover .face {
			opacity: 1;
		}

		/* Not sure if I like this or not. */
		/* Makes the emoji stay displayed */
		/* input[type="radio"]:checked + .face {
			opacity: 1 !important;
		} */
	</style>
@endpush

@push('scripts')
	{{--Derived from https://codepen.io/Souleste/pen/QXmgrV --}}
	<script>
		$(function() {

			$(document).on({
				mouseover: function(event) {
					$(this).find('.far').addClass('star-over');
					$(this).prevAll().find('.far').addClass('star-over');
				},
				mouseleave: function(event) {
					$(this).find('.far').removeClass('star-over');
					$(this).prevAll().find('.far').removeClass('star-over');
				}
			}, '.rate');


			$(document).on('click', '.rate', function() {
				if ( !$(this).find('.star').hasClass('rate-active') ) {
					$(this).siblings().find('.star').addClass('far').removeClass('fas rate-active');
					$(this).find('.star').addClass('rate-active fas').removeClass('far star-over');
					$(this).prevAll().find('.star').addClass('fas').removeClass('far star-over');
				}
			});

		});

	</script>
@endpush