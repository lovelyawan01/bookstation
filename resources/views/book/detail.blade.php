@extends('layout/master')
@section('page-title')
   {{ $book->title }}
@endsection
@section('main-content')
<!-- BEGIN MAIN CONTENT -->
		<main class="main-content">

		<!-- Book Detail -->
		<div class="book-detail">
			<div class="container">
				
				<!-- Alert -->
				<div class="add-cart-alert">
					<p><i class="fa fa-check-circle"></i>{{ $book->title }} </p>
				</div>
				<!-- Alert -->

				<!-- Single Book Detail -->
				<div class="single-boook-detail">
					<div class="row">
						
						<!-- Book Thumnbnail -->
						<div class="col-lg-4 col-md-5">
							<div class="product-thumnbnail">
								<ul class="product-slider">
								  	<li>
								  		@if( $book->book_img == 'No image found')
								  		   <img src="/assets/images/no-img.png" width="173" height="259" alt="No image found ">
								  		@else
								  		@endif
								  		<img src="/uploads/{{ $book->book_img}}" width="173" height="259" alt="{{ $book->title }}">
								  	</li>
								</ul>
							</div>
						</div>
						<!-- Book Thumnbnail -->

						<!-- book Detail -->
						<div class="col-lg-8 col-md-7">
							<div class="single-product-detail">
								<span class="availability">Availability :<strong>
									@if($book->availability == 'No')
									{{ $book->availability }}<i class="fa fa-times-circle-o"></i>
									@else
									{{ $book->availability }}<i class="fa fa-check-circle"></i>
									@endif
								</strong></span>
								<h3>{{ $book->title }} </h3>
								<br>
    							<h4>Overview</h4>
    							<p>{{ $book->description }}</p>
							</div>
						</div>
						<!-- book Detail -->

					</div>
				</div>
				<!-- Single Book Detail -->

				<!-- Disc Nd Description -->
				<div class="disc-nd-Description tc-padding-bottom">
					<div class="row">
						<div id="disc-reviews-tabs" class="disc-reviews-tabs">

							<!-- Tabs Nav -->
							<div class="col-sm-3">
								<div class="tabs-nav">
									<ul>
										<li><a href="#tab-1">Reviews</a></li>
										<li><a href="#tab-2">Description</a></li>
									</ul>
								</div>
							</div>
							<!-- Tabs Nav -->

							<!-- Tabs Content -->
							<div class="col-sm-9">
								<div class="tabs-content">
									<!-- Book Info List -->
									<div id="tab-2">
										<div class="book-info-list">
											<ul>
												<li><span>ISBN: </span>{{ $book->isbn }}</li>
												<li><span>ISBN-10: </span>{{ $book->isbn-10 }}</li>
												<li><span>Audience: </span>{{ $book->audience }}</li>
												<li><span>Format: </span>{{ $book->format }}</li>
												<li><span>Language: </span>{{ $book->language }}</li>
												<li><span>Number Of Pages: </span>{{ $book->total_pages }}</li>
												<li><span>Published: </span>{{ $book->publisher }}</li>
												<li><span>Country of Publication: </span>{{ $book->country_of_publisher }}</li>
												<li><span>Edition Number: </span>{{ $book->edition_number }}</li>
											</ul>
										</div>
									</div>
									<!-- Book Info List -->
										
									<!-- Description & Products -->
									<div id="tab-1">	

										<!-- Description -->
										<div class="description">
											<p>Kevin Rudd was given no warning, but even he lasted longer than Abbott. Julia Gillard had plenty of warnings, but even she lasted longer than Abbott. Abbott ignored all the warnings, from beginning to end — the public ones, the private ones, from his friends, his colleagues, the media. His colleagues were not being disloyal. They did not feel they had betrayed him; they believed he had betrayed them. Their motives were honourable. They didn’t want him to fail; they wanted the government to succeed, and they wanted the Coalition re-elected.</p>
											<p>Abbott and Credlin had played it harder and rougher than anybody else to get where they wanted to be. But they proved incapable of managing their own office, much less the government. Then, when it was over, when it was crystal.</p>
										</div>
										<!-- Description -->

										<!-- Related Products -->
										<div class="related-products">
											<h5>You May <span>also like this</span></h5>
											<div class="related-produst-slider">
												@forelse($categories as $category)
												<div class="item">
													<div class="product-box">
								    					<div class="product-img">
								    						@if($category->book_img == 'No image found')
									                           <img src="/assets/images/no-img.png" width="132" height="197" alt="No image found">
								                            @else
									                            <img src="/uploads/{{ $category->book_img }}" width="132" height="197" alt="{{ $category->title }}">
									                        @endif
								    						<ul class="product-cart-option position-center-x">
								    							<li><a href="#"><i class="fa fa-eye"></i></a></li>
								    							<li><a href="#"><i class="fa fa-cart-arrow-down"></i></a></li>
								    							<li><a href="#"><i class="fa fa-share-alt"></i></a></li>
								    						</ul>
								    					</div>
								    					<div class="product-detail">
								    						<span>{{ $category->category->title}}</span>
								    						<h5>{{ $category->title }}</h5>
								    						<p>{{ Str::limit($category->description, 20, '...')}}</p>
								    						<div class="rating-nd-price">
								    							<strong>Rs./ {{ number_format($category->price) }}</strong>
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
												</div>
												@empty
												@endif


											</div>
										</div>
										<!-- Related Products -->

									</div>
									<!-- Description & Products -->

								</div>
							</div>
							<!-- Tabs Content -->

						</div>
					</div>
				</div>
				<!-- Disc Nd Description -->

			</div>
		</div>
		<!-- Book Detail -->

	</main>
	 @endsection