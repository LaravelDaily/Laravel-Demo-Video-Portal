@extends('layouts.mainTable')

@section('content')
<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title">{{ $video->title }}</h1>
					<div class="product-meta">
						<ul class="list-inline">
							<li class="list-inline-item"><i class="fa fa-folder-open"></i> Channel<a href="{{ route('channel', [$video->channel->id]) }}">
											<span class="label label-info label-many">{{ $video->channel->name }}</span>
							</a></li>
						</ul>
					</div>
                    <br>
                    <div class="col-md-4">
                        @if($video->youtube_embed)
														{!! $video->youtube_embed !!}
												@endif
                    </div>
					<div class="content">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">About video</h3>
								<p>{{ $video->description}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<!-- User Profile widget -->
					<div class="widget user">
						<h4>Other videos in this channel</h4>
                            @foreach ($video->channel->videos->shuffle()->take(10) as $singleVideo)
                            <li><a href="{{ route('video', [$singleVideo->id]) }}">{{ $singleVideo->title }}</a></li>
                            @endforeach
					</div>
					<!-- Map Widget -->
				</div>
			</div>
			
		</div>
	</div>
	<!-- Container End -->
</section>

@stop
