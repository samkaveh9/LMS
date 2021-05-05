<header class="t-header">
        <div class="campaign">
            <div class="container">
                <a class="message">تخفیف «۳۰٪» همه دوره‌ها فقط تا</a>
                <div id="count-down-timer" data-countdown="2021-07-8 00:00:00" class="count-down-timer"></div>
            </div>
        </div>
        <div class="container">
            <div class="t-header-row">
                <div class="t-header-right">
                    <div class="t-header-logo"><a href="{{ route('home') }}"></a></div>
                    @include('Front::layouts.search')
                </div>
                <div class="t-header-left">
                    <div class="icons">
                        <div class="search-icon"></div>
                        <div class="menu-icon"></div>
    
                    </div>
    
                    <div class="join-teachers">
                        <a href="become-a-teacher.html">تدریس</a>
                    </div>
                    @auth
                    <div class="user-menu-account">
                             <div class="user-image">
                                 <img src="{{ auth()->user()->thumb }}" alt="{{ auth()->user()->name }}">
                             </div>
                             <span>پروفایل کاربری من </span>
                             <div class="user-menu-account-dropdown">
                                 <ul>
                                     <li><a href="{{ route('users.profile') }}">مشاهده پروفایل</a></li>
                                     <li><a href="">خرید های من</a></li>
                                     <li><a href="{{ route('dashboard') }}">داشبورد</a></li>
                                     <li><a href="{{ route('logout') }}">خروج</a></li>
                                 </ul>
                             </div>
                         </div>
                    @else   
                    <div class="login-register-btn ">
                        <div><a class="btn-login" href="{{ route('login') }}">ورود</a></div>
                        <div><a class="btn-register" href="{{ route('register') }}">ثبت نام</a></div>
                    </div>
                    @endauth                              
                 
    
                </div>
            </div>
        </div>
        <nav id="navigation" class="navigation">
            @auth
            <div class="after-login d-none">
                <li><a href="{{ route('users.profile') }}">مشاهده پروفایل</a></li>
                <li><a href="">خرید های من</a></li>
                <li><a href="{{ route('dashboard') }}">داشبورد</a></li>
                <li><a href="{{ route('logout') }}">خروج</a></li>
            </div>
            @else   
            <div class="login-register-btn d-none">
                <div><a class="btn-login" href="{{ route('login') }}">ورود</a></div>
                <div><a class="btn-register" href="{{ route('register') }}">ثبت نام</a></div>
            </div>
            @endauth
            @include('Front::layouts.nav')
        </nav>
    </header>