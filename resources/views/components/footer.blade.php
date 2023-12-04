<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-md-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    ABOUT
                </h4>

                <p class="stext-107 cl7 size-201">
                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien.
                </p>
            </div>
            <div class="col-md-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    CONTACT
                </h4>
                <p class="stext-107 cl7 size-201">
                    {{setting('footer.site_address')}}
                </p>
                <p class="stext-107 cl7 size-201 my-1">
                    {{setting('footer.site_phone')}}
                </p>
                <p class="stext-107 cl7 size-201">
                    {{setting('footer.site_email')}}
                </p>
                <div class="p-t-27">
                    <a href="{{setting('footer.facebook_url')}}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="{{setting('footer.instagram_url')}}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="{{setting('footer.telegram_url')}}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-telegram"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help
                </h4>
                <ul>
                    <li class="p-b-5">
                        <a href="{{route('blog')}}" class="stext-107 cl7 hov-cl1 trans-04">
                            Blog
                        </a>
                    </li>
                    <li class="p-b-5">
                        <a href="{{route('about')}}" class="stext-107 cl7 hov-cl1 trans-04">
                            About
                        </a>
                    </li>
                    <li class="p-b-5">
                        <a href="{{route('contact')}}" class="stext-107 cl7 hov-cl1 trans-04">
                            Contact
                        </a>
                    </li>
                    <li class="p-b-5">
                        <a href="{{route('faq.help')}}" class="stext-107 cl7 hov-cl1 trans-04">
                            Help & FAQs
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    To'lov turi
                </h4>
                <img src="{{asset('images/click.png')}}" alt="click"
                     style="border-radius: 10px;width: 250px">
            </div>
        </div>
    </div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>
