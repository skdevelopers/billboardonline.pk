<header id="site-header" class="site-header" role="banner">
    <div class="container">
        <div class="site-logo-wrap">
            <hgroup>
                <h1 class='site-title site-title-no-desc'> <a  style="color:#FFFFFF;" href='{{ route('home') }}' title='{{ config('app.name', 'Billboard Online') }}' rel='home'>{{ config('app.name', 'Billboard Online') }}</a></h1>
            </hgroup>
        </div>
        <nav id="primary-nav" class="nav" role="navigation" onclick="">
            <ul>
                @guest
                    <li class=""><a href="{{ route('home') }}">Home</a></li>
                    <li class=""><a href="{{ route('about') }}">About</a></li>
                    <li class=""><a href="{{ route('blog') }}">Blog</a></li>
                    <li class=""><a href="{{ route('login') }}">Login</a></li>
                    <li class=""><a href="{{ route('register') }}">Register</a></li>
                    <li class=""><a href="{{ route('contact') }}">Contact</a></li>
                @else
                    <li class=" active"><a href="{{ route('home') }}">Home</a></li>
                    <li class=""><a href="{{ route('about') }}">About</a></li>
                    <li class=""><a href="{{ route('blog') }}">Blog</a></li>
                    <li class=""><a href="{{ route('admin.shops.index') }}">Manage Shops</a></li>
                    <li class=""><a href="{{ route('contact') }}">Contact</a></li>
                    <li class=""><a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a></li>
                    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </ul>

        </nav>
    </div>
<script>
    //  The function to change the class
    const changeClass = function (r, className1, className2) {
        const regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
        if (regex.test(r.className)) {
            r.className = r.className.replace(regex, ' ' + className2 + ' ');
        } else {
            r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"), ' ' + className1 + ' ');
        }
        return r.className;
    };

    //  Creating our button for smaller screens
    const menuElements = document.getElementById('primary-nav');
    const htmlElement = document.getElementsByTagName("html")[0];
    menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true">Menu</button>');
    // Adding a JS class when JS is activated
    changeClass(document.getElementsByTagName("html")[0], 'no-js', 'js');

    //  Toggle the class on click to show / hide the menu
    document.getElementById('menutoggle').onclick = function() {
        changeClass(this, 'navtoogle active', 'navtoogle');
    }

    // document click to hide the menu	credits to http://inpx.it/13WjECm
    document.onclick = function(e) {
        const mobileButton = document.getElementById('menutoggle'),
            buttonStyle = mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

        if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
            changeClass(mobileButton, 'navtoogle active', 'navtoogle');
        }
    }

</script>
</header>
