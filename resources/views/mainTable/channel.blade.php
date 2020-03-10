@extends('layouts.mainTable')

@section('content')

<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<h2>Results For "{{ $channel->name }}"</h2>
					<p>{{ $channel->videos->count() }} Results</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="product-grid-list">
					<div class="row mt-30">
                         
                        @foreach ($videos as $singleVideo)
                            <div class="col-sm-12 col-lg-4 col-md-6">
                            
                                <!-- product card -->
                        
                                <div class="product-item bg-light">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"><a href="{{ route('video', [$singleVideo->id]) }}">{{$singleVideo->title}}</a></h4>
                                            @if ($singleVideo->channel)
                                                <ul class="list-inline product-meta">
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('channel', [$singleVideo->channel->id]) }}"><i class="fa fa-folder-open"></i>{{ $singleVideo->channel->name }}</a>
                                                    </li>
                                                </ul>
                                            @endif
                                            <p class="card-text">{{ substr($singleVideo->description, 0, 100) }}...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
					</div>
				</div>
                
                {{ $videos->render() }}
			</div>
		</div>
	</div>
</section>


@stop