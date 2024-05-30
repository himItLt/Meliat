@extends('layouts.front')

@section('content')
<main class="content">
    {!! $resource[$loc . '_content'] !!}
    @if (count($reviews) > 0)
        <div class="section section-reviews">
            <div class="section-review-body">
                <div class="uibox-container">
                    <h2>{{ __('theme.home_reviews_title') }}</h2>
                    <div class="uibox-row section-reviews-list">
                        @forelse ($reviews as $review)
                            <div class="col s4 section-review-item">
                                <div class="section-review-item-body">
                                    <div class="review-header">
                                        <div class="review-author">{{ $review->name }} {{ $review->lastname }}</div>
                                        <div class="review-date">
                                            {{ $review->created_at->format('d.m.Y') }}
                                        </div>
                                    </div>
                                    <div class="review-rating-wrap">
                                        <span class="review-stars" style="width: {{ $review->vote * 20 }}%;"></span>
                                    </div>
                                    <div class="review-text">{{ $review->text }}</div>
                                </div>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>
                    <div class="center">
                        @if ($loc == 'de')
                            <a class="link-btn reviews-link" href="/de/bewertungen">{{ __('theme.home_reviews_all_btn') }}</a>
                        @else
                            <a class="link-btn reviews-link" href="/ru/otzyvy">{{ __('theme.home_reviews_all_btn') }}</a>
                        @endif
                    </div>
                    <div class="center review-total-block">
                        {{ __('theme.review_label_total_rating') }}: {{$rating}} {{ __('theme.review_label_total_rating_2')}} {{$reviewCount}} {{ __('theme.review_label_total_vote') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</main>
@endsection