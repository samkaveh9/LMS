<div class="sidebar-right">
    <div class="sidebar-sticky">
        <div class="product-info-box">
            @auth
            @if (auth()->id() == $course->teacher_id)
            <p class="mycourse">شما مدرس این دوره هستید</p>
            @elseif(auth()->user()->hasAccessToCourse($course))
            <p class="mycourse">شما این دوره رو خریداری کرده اید</p>
            @else
            <div class="discountBadge">
                <p>45%</p>
                تخفیف
            </div>
            <div class="sell_course">
                <strong>قیمت :</strong>
                <del class="discount-Price">{{ $course->price }}</del>
                <p class="price">
            <span class="woocommerce-Price-amount amount">{{ $course->price }}
                <span class="woocommerce-Price-currencySymbol">تومان</span>
            </span>
                </p>
            </div>
            <button class="btn buy">خرید دوره</button>                            
            @endif  
            @else
            <div class="discountBadge">
                <p>45%</p>
                تخفیف
            </div>
            <div class="sell_course">
                <strong>قیمت :</strong>
                <del class="discount-Price">{{ $course->price }}</del>
                <p class="price">
            <span class="woocommerce-Price-amount amount">{{ $course->price }}
                <span class="woocommerce-Price-currencySymbol">تومان</span>
            </span>
                </p>
            </div>
            <button class="btn buy">خرید دوره</button>                            
            @endauth

            <div class="average-rating-sidebar">
                <div class="rating-stars">
                    <div class="slider-rating">
                        <span class="slider-rating-span slider-rating-span-100" data-value="100%" data-title="خیلی خوب"></span>
                        <span class="slider-rating-span slider-rating-span-80" data-value="80%" data-title="خوب"></span>
                        <span class="slider-rating-span slider-rating-span-60" data-value="60%" data-title="معمولی"></span>
                        <span class="slider-rating-span slider-rating-span-40" data-value="40%" data-title="بد"></span>
                        <span class="slider-rating-span slider-rating-span-20" data-value="20%" data-title="خیلی بد"></span>
                        <div class="star-fill"></div>
                    </div>
                </div>

                <div class="average-rating-number">
                    <span class="title-rate title-rate1">امتیاز</span>
                    <div class="schema-stars">
                        <span class="value-rate text-message"> 4 </span>
                        <span class="title-rate">از</span>
                        <span class="value-rate"> 555 </span>
                        <span class="title-rate">رأی</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-info-box">
            <div class="product-meta-info-list">
                <div class="total_sales">
                    تعداد دانشجو : <span>{{ count($course->students) }}</span>
                    {{-- تعداد دانشجو : <span>246</span> --}}
                </div>
                <div class="meta-info-unit one">
                    <span class="title">تعداد جلسات منتشر شده :  </span>
                    <span class="vlaue">110</span>
                </div>
                <div class="meta-info-unit two">
                    <span class="title">مدت زمان دوره تا الان : </span>
                    <span class="vlaue">135:40:00</span>
                </div>
                <div class="meta-info-unit three">
                    <span class="title">مدت زمان کل دوره : </span>
                    <span class="vlaue">-</span>
                </div>
                <div class="meta-info-unit four">
                    <span class="title">مدرس دوره : </span>
                    <span class="vlaue">{{ $course->teacher->name }}</span>
                </div>
                <div class="meta-info-unit five">
                    <span class="title">وضعیت دوره : </span>
                    <span class="vlaue">@lang($course->status)</span>
                </div>
                <div class="meta-info-unit six">
                    <span class="title">پشتیبانی : </span>
                    <span class="vlaue">دارد</span>
                </div>
            </div>
        </div>
        <div class="course-teacher-details">
            <div class="top-part">
                <a href="#"><img alt="{{ $course->teacher->name }}" class="img-fluid lazyloaded"
                        src="{{ $course->teacher->thumb }}" loading="lazy">
                    <noscript>
                        <img class="img-fluid" src="{{ $course->teacher->thumb }}" alt="{{ $course->teacher->name }}"></noscript>
                </a>
                <div class="name">
                    <a href="{{ route('front.teacher', $course->teacher->name) }}" class="btn-link"><h6>{{ $course->teacher->name }}</h6></a>
                    <span class="job-title">{{ $course->teacher->bio }}</span>
                </div>
            </div>
            {{-- <div class="job-content">
                <p>{{ $course->teacher->bio }}</p>
            </div> --}}
        </div>
        <div class="short-link">
            <div class="">
                <span>لینک کوتاه</span>
                <input class="short--link" value="webamooz.net/c/Y33x3">
                <a href="" class="short-link-a" data-link="https://webamooz.net/c/Y33x3"></a>
            </div>
        </div>
        <div class="sidebar-banners">

            {{-- <div class="sidebar-pic">
                <a href="https://t.me/webmooz_net"><img src="/img/telgram.png" alt="کانال تلگرام"></a>
            </div> --}}

            <div class="sidebar-pic">
                <a href="https://t.me/webmooz_net"><img src="/img/laravel-tel.png" alt="کانال تلگرام"></a>
            </div>
            <div class="sidebar-pic">
                <a href="https:webamooz.net/blog"><img src="/img/podcast.png" alt="وبلاگ وب سایت ما"></a>
            </div>
            <div class="sidebar-pic">
                <a href="https://t.me/webmooz_net"><img src="/img/workinja.png" alt="کانال تلگرام"></a>
            </div>
            {{-- <div class="sidebar-pic">
                <a href="https://t.me/webmooz_net"><img src="/img/blog-pic.png" alt="کانال تلگرام"></a>
            </div> --}}
        </div>

    </div>
</div>