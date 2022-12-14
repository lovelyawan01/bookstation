@extends('layout/master')
@section('page-title')
   Gallery
@endsection
@section('main-content')
<!-- BEGIN MAIN CONTENT -->
		<main class="main-content">

		<!-- Gallery -->
        <div class="gallery tc-padding">
      		<div class="container">
      			<div class="row no-gutters">
      				@forelse($galleries as $gallery)
	      				<div class="col-lg-3 col-xs-6 r-full-width">
	      					<div class="gallery-figure style-2">
	      					@if($gallery->media_img == 'No image found')
			                  		<img src="/assets/images/no-img.png" width="283" height="283" alt="No Image Found">
			                  	  @else
			                  	    <img src="/uploads/{{ $gallery->media_img }}"  width="283" height="283" alt="{{ $gallery->title }}">
			                  	  @endif 
		                  		<!-- <img src="/assets/images/gallery-v2/img-01.jpg" alt=""> -->
		                  		<div class="overlay">
		                  			<ul class="position-center-x">
		                  				<li><a href="#"><i class="fa fa-heart"></i>Likes</a></li>
		                  				<li><a href="/assets/images/gallery-v2/img-01.jpg" data-rel="prettyPhoto[gallery]"><i class="fa fa-plus"></i></a></li>
		                  			</ul>
		                  		</div>
		                  	</div>
	      				</div>
                    @empty
			                 <div class="alert alert-danger">No Record found</div>
			                @endforelse

      				
      				
      				
      				
      				
      	
      				<div class="col-xs-12">
      					<div class="pagination-holder">
		           			<ul class="pagination">
							    <li><a href="#" aria-label="Previous">Prev</a></li>
							    <li><a href="#">1</a></li>
							    <li class="active"><a href="#">2</a></li>
							    <li><a href="#">3</a></li>
							    <li><a href="#">4</a></li>
							    <li><a href="#">5</a></li>
							    <li><a href="#">6</a></li>
							    <li><a href="#">7</a></li>
							    <li><a href="#">...</a></li>
							    <li><a href="#">23</a></li>
							    <li><a href="#" aria-label="Next">Next</a></li>
							</ul>
		           		</div>
      				</div>
      			</div>
            </div>
      	</div>
		<!-- Gallery -->

	</main>
 @endsection