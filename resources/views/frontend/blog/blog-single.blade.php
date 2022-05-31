@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
		<h2 class="title text-center">Latest From our Blog</h2>
		<div class="single-blog-post">
			<h3>{{$getBlogDetail->title}}</h3>
			<div class="post-meta">
				<ul>
					<li><i class="fa fa-user"></i> Mac Doe</li>
					<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
					<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
				</ul>
				<span>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
				</span>
			</div>
			<a href="">
				<img src="{{ asset('blog/'.$getBlogDetail->image) }}" alt="">
			</a>
			{{$getBlogDetail->description}}
			<div class="pager-area">
				<ul class="pager pull-right">
					@if ($previous != null)
					<li><a href="{{ url('blog/blog-single/'.$previous) }}">Pre</a></li>
					@endif
					@if ($next != null)
					<li><a href="{{ url('blog/blog-single/'.$next) }}">Next</a></li>
					@endif
				</ul>
			</div>
			<div class="rating-area">
				<ul class="ratings">
					<li class="rate-this">Rate this item:</li>				
				</ul>
				
				<div class="rate">					
					<div class="vote">	
						<?php 
							for ($i=1; $i<6; $i++){
								if ($i <= $rate) {
									$color = 'ratings_over';
								} else {
									$color = '';
								}	
						?>																	
						<div class="star_{{$i}} ratings_stars {{$color}}"><input value="{{$i}}" type="hidden"></div>
						<?php } ?>
						<span class="rate-np" value="">{{ $rate }}</span>											
					</div> 					
				</div>
			</div>
			<div class="socials-share">
				<!-- <a href=""><img src="{{asset('frontend/images/blog/socials.png')}}" alt=""></a> -->
			</div><!--/socials-share-->
			<div class="response-area">
				<h2>RESPONSES</h2>				
				@foreach($comments as $comment)						
				<ul class="media-list">						
					<li class="media">								
						<a class="pull-left" href="#">
							<img class="media-object" width="121px" height="86px" src="{{ asset('upload/'.$comment->avatar) }}" alt="">
						</a>
						<div class="media-body" id="{{$comment->id}}">
							<ul class="sinlge-post-meta">
								<li><i class="fa fa-user"></i>{{$comment->name}}</li>
								<li><i class="fa fa-clock-o"></i>{{$comment->created_at}}</li>							
							</ul>
							<p>{{$comment->cmt}}</p>
							<a class="btn btn-primary" id="reply"><i class="fa fa-reply"></i>Replay</a>
						</div>
					</li>	
					@if ($comment->replies)
						@foreach($comment->replies as $rep)
					<li class="media second-media">								
						<a class="pull-left" href="#">
							<img class="media-object" width="121px" height="86px" src="{{ asset('upload/'.$rep->avatar) }}" alt="">
						</a>
						<div class="media-body" id="{{$rep->id}}">
							<ul class="sinlge-post-meta">
								<li><i class="fa fa-user"></i>{{$rep->name}}</li>
								<li><i class="fa fa-clock-o"></i>{{$rep->created_at}}</li>							
							</ul>
							<p>{{$rep->cmt}}</p>
							<a class="btn btn-primary" id="reply"><i class="fa fa-reply"></i>Replay</a>
						</div>
					</li>
						@endforeach	
					@endif
				</ul>	
				@endforeach				
			</div>
			<div class="replay-box">
				<div class="row">
					<div class="col-sm-4">
						<h2>Leave a replay</h2>			
					</div>
					<form method="post" action="">
						@csrf
						<div class="col-sm-8">
							<div class="text-area">
								<div class="blank-arrow">
									<label>Your Comment</label>
								</div>								
								<span>*</span>
								<textarea id="cmt" name="cmt" rows="11"></textarea>
								<input type="hidden" class="level" name="level" value="0" >
								<button type="submit" class="btn btn-primary">post comment</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){		
		$('.ratings_stars').hover(
			// Handles the mouseover
			function() {
				$(this).prevAll().andSelf().addClass('ratings_hover');
				// $(this).nextAll().removeClass('ratings_vote'); 
			},
			function() {
				$(this).prevAll().andSelf().removeClass('ratings_hover');
				// set_votes($(this).parent());
			}
		);		
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$('.ratings_stars').click(function(){			
			var isLogin = "{{Auth::check()}}"
			if(isLogin == true){
				var value = $(this).find("input").val()
				$('.rate-np').text(value)
				if($(this).hasClass('rating_over')){
					$('.ratings_stars').removeClass('ratings_over');
					$(this).prevAll().andSelf().addClass('ratings_over');
				}
				else {
					$(this).prevAll().andSelf().addClass('ratings_over');
				}
				$.ajax({
					type: "POST",
					url: "{{url('/blog/ajax')}}",
					data: {
						value: value,
						blogid: "{{$getBlogDetail->id}}"
					},
					success: function(response){
						console.log(respone);
					}
				})
			}
			else {
				alert('Vui lòng đăng nhập')
				window.location.href = "{{url('/member-login')}}"
			}
		});	

		$('.btn-primary').click(function(){
			var isLogin = "{{Auth::check()}}"
			if(isLogin == false){
				alert('Vui lòng đăng nhập')
				window.location.href = "{{url('/member-login')}}"
			}
		})
		$('#reply').click(function(){
			var isLogin = "{{Auth::check()}}"
			if(isLogin == false){
				alert('Vui lòng đăng nhập')
				window.location.href = "{{url('/member-login')}}"
			} else {
				var level = $(this).closest('.media-body').attr('id')
				$('#cmt').focus()
				$('.level').val(level)
				// console.log(level)	
			}
		})
	})
</script>
@endsection