@extends('Front::layouts.master')
@section('main')
    
<main id="single">
    <div class="content">

        <div class="container">
            <article class="article">
                <div class="ads mb-10">
                    <a href="" rel="nofollow noopener"><img src="/img/ads/1440px/test.jpg" alt=""></a>
                </div>
                <div class="h-t">
                    <h1 class="title">{{ $course->title }}</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}" title="خانه">خانه</a></li>
                            {{-- <li><a href="{{ route('home') }}" title="دوره ها">دوره ها</a></li> --}}
                            <li><a href="" title="{{ $course->category->title }}">{{ $course->category->title }}</a></li>
                            {{-- @if ($course->parentCategory != null)
                            <li><a href="" title="{{ $course->parentCategory->title }}">{{ $course->parentCategory->title }}</a></li>
                            @endif --}}
                            <li><a href="#" title="{{ $course->title }}">{{ $course->title }}</a></li>
                        </ul>
                    </div>
                </div>

            </article>
        </div>


        <div class="main-row container">
           @include('Front::layouts.rightSidebar')
            <div class="content-left">
                <div class="preview">
                    <video width="100%" controls>
                        <source src="{{ $episodeItem->downloadLink() }}" type="video/mp4">
                    </video>
                </div>
                <a href="{{ $episodeItem->downloadLink() }}" class="episode-download">دانلود این قسمت (قسمت {{ $episodeItem->number }})</a>
                <div class="course-description">
                    <div class="course-description-title">توضیحات دوره</div>
                    <p>{{ $course->body }}</p>
                </div>
                <div class="episodes-list">
                    <div class="episodes-list--title">فهرست جلسات</div>
                    <div class="episodes-list-section">
                        @foreach ($episodes as $episode) 
                        <div class="episodes-list-item {{ auth()->check() && auth()->user()->hasAccessToCourse($episodeItem->course) ? '' : 'lock' }}"> 
                        <div class="section-right">
                                <span class="episodes-list-number">{{ $episode->id }}</span>
                                <div class="episodes-list-title">
                                    <a href="{{ $episode->path() }}">{{ $episode->title }}</a>
                                </div>
                            </div>
                            <div class="section-left">
                                <div class="episodes-list-details">
                                    <div class="episodes-list-details">
                                        <span class="detail-type">رایگان</span>
                                        <span class="detail-time">44:44</span>
                                        <a class="detail-download">
                                            <i class="icon-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="comments">
                <div class="comment-main">
                    <div class="ct-header">
                    <h3>نظرات ( 180 )</h3>
                    <p>نظر خود را در مورد این مقاله مطرح کنید</p>
                </div>
                    <form action="" method="post">
                        <div class="ct-row">
                            <div class="ct-textarea">
                                <textarea class="txt ct-textarea-field"></textarea>
                            </div>
                        </div>
                        <div class="ct-row">
                            <div class="send-comment">
                                <button class="btn i-t">ثبت نظر</button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="comments-list">
                    <div id="Modal2" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p>ارسال پاسخ</p>
                                <div class="close">&times;</div>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="">
                                    <textarea class="txt hi-220px" placeholder="متن دیدگاه"></textarea>
                                    <button class="btn i-t">ثبت پاسخ</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <ul class="comment-list-ul">
                       <div class="div-btn-answer">
                           <button class="btn-answer">پاسخ به دیدگاه</button>
                       </div>
                       <li class="is-comment">
                        <div class="comment-header">
                            <div class="comment-header-avatar">
                                <img src="/img/profile.jpg">
                            </div>
                            <div class="comment-header-detail">
                                <div class="comment-header-name">کاربر : گوگل</div>
                                <div class="comment-header-date">10 روز پیش</div>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                            </p>
                        </div>
                        </li>
                        <li class="is-answer">
                            <div class="comment-header">
                                <div class="comment-header-avatar">
                                    <img src="/img/laravel-pic.png">
                                </div>
                                <div class="comment-header-detail">
                                    <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                    <div class="comment-header-date">10 روز پیش</div>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                </p>
                            </div>
                        </li>
                       

                    </ul>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
