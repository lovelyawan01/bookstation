@extends('layout/master')
@section('page-title')
   Author
@endsection
@section('main-content')
   <!-- BEGIN MAIN CONTENT -->
		<main class="main-content">

		<!-- Arthor Detail -->
		<div class="single-aurthor-detail tc-padding">
			<div class="container">
				<div class="row">
					
					<!-- Aside -->
					<aside class="col-lg-4 col-md-5">
						<div class="arthor-detail-column">
							<div class="arthor-img">
								@if($author->author_img == 'No image found')
									<img src="/assets/images/no-img.png" width="207" height="197" alt="No image found">
								@else
									<img src="/uploads/{{ $author->author_img }}" width="207" height="197" alt="{{ $author->title }}">
								@endif
							</div>
							<div class="arthor-detail">
								<h6>{{ $author->title }}</h6>
								<span>{{ $author->designation }}</span>
							</div>
							<div class="social-activity">
								<div>
									<ul class="social-icons">
					                	<li><a class="facebook" href="{{ $author->facebook_id }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
					                    <li><a class="twitter" href="{{ $author->twitter_id }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
					                    <li><a class="youtube" href="{{ $author->youtube_id }}"><i class="fa fa-youtube-play"></i></a></li>
					                    <li><a class="pinterest" href="{{ $author->pinterest_id }}" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
					                </ul>
				                </div>
				         	</div>
						</div>
					</aside>
					<!-- Aside -->

					<!-- Content -->
					<div class="col-lg-8 col-md-7">
						<div class="single-arthor-detail">

							<!-- Widget -->
							<div class="single-arthor-widget">
								<h5>Author Overview</h5>
								<div class="author-overview">
									<p>{{ $author->description }}</p>
								</div>
							</div>
							<!-- Widget -->

							<!-- Widget -->
							<div class="single-arthor-widget">
								<h5>Recommended {{ $author->title }} Titles </h5>

								<!-- Recommended -->
							  	<div id="filter-masonry" class="gallery-masonry">

					    			<!-- Product Box -->
					    			<div class="col-lg-3 col-xs-6 r-full-width masonry-grid most-recent">
					    				<div class="recommended-book">
					    					<div class="recommended-book-img">
					    						<img src="/assets/images/arthor-recommended/img-01.jpg" alt="">
					    					</div>
					    					<div class="recommended-book-detail">
						    					<h6>Jewels of Nizam</h6>
						    					<span>By Muriel Barbery</span>
						    					<ul class="rating-stars">
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star-half-o"></i></li>
				    							</ul>
			    							</div>
					    				</div>
					    			</div>
					    			<!-- Product Box -->

					    			<!-- Product Box -->
					    			<div class="col-lg-3 col-xs-6 r-full-width masonry-grid most-popular">
					    				<div class="recommended-book">
					    					<div class="recommended-book-img">
					    						<img src="/assets/images/arthor-recommended/img-02.jpg" alt="">
					    					</div>
					    					<div class="recommended-book-detail">
						    					<h6>Cakes &amp; Bakes</h6>
						    					<span>By Muriel Barbery</span>
						    					<ul class="rating-stars">
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star-half-o"></i></li>
				    							</ul>
			    							</div>
					    				</div>
					    			</div>
					    			<!-- Product Box -->

					    			<!-- Product Box -->
					    			<div class="col-lg-3 col-xs-6 r-full-width masonry-grid fiction">
					    				<div class="recommended-book">
					    					<div class="recommended-book-img">
					    						<img src="/assets/images/arthor-recommended/img-03.jpg" alt="">
					    					</div>
					    					<div class="recommended-book-detail">
						    					<h6>Jamie’s Kitchen</h6>
						    					<span>By Muriel Barbery</span>
						    					<ul class="rating-stars">
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star-half-o"></i></li>
				    							</ul>
			    							</div>
					    				</div>
					    			</div>
					    			<!-- Product Box -->

					    			<!-- Product Box -->
					    			<div class="col-lg-3 col-xs-6 r-full-width masonry-grid free-books">
					    				<div class="recommended-book">
					    					<div class="recommended-book-img">
					    						<img src="/assets/images/arthor-recommended/img-04.jpg" alt="">
					    					</div>
					    					<div class="recommended-book-detail">
						    					<h6>Inexpensive Family</h6>
						    					<span>By Muriel Barbery</span>
						    					<ul class="rating-stars">
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star"></i></li>
				    								<li><i class="fa fa-star-half-o"></i></li>
				    							</ul>
			    							</div>
					    				</div>
					    			</div>
					    			<!-- Product Box -->

							  	</div>
							  	<!-- Recommended -->

							</div>
							<!-- Widget -->
						</div>
					</div>
					<!-- Content -->
				</div>
			</div>
		</div>
		<!-- Arthor Detail -->
	</main>
 @endsection