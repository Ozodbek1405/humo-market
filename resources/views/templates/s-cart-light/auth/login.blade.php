@extends($sc_templatePath.'.layout')

@section('block_main')
<!--form-->
<section class="section section-sm section-first bg-default text-md-left">
    <div class="container">
    <div class="row">
        <div class="col-12 col-sm-12">
            <h2>{{ sc_language_render('customer.title_login') }}</h2>

            @if (!empty(sc_config('LoginSocialite')))
                <div class="col-md-3 my-3 pl-0">
                    <a href="{{ sc_route('login_socialite.index', ['provider' => 'google']) }}">
                        <button class="btn btn-danger">
                            <i class="fab fa-google"></i> {{ sc_language_render('front.login') }} google
                        </button>
                    </a>
                </div>
            @endif

            <form action="{{ sc_route('postLogin') }}" method="post" class="box">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">{{ sc_language_render('customer.phone') }}</label>
                    <div class="input-group">
                        <span class="input-group-text">+998</span>
                        <input type="text"
                               class="is_required validate account_input form-control {{ ($errors->has('phone'))?"input-error":"" }}"
                               name="phone" placeholder="{{ sc_language_render('customer.phone') }}" value="{{ old('phone') }}">
                    </div>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            {{ $errors->first('phone') }}
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">{{ sc_language_render('customer.password') }}</label>
                    <input class="is_required validate account_input form-control {{ ($errors->has('password'))?"input-error":"" }}"
                        type="password" name="password" value="">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                    @endif
            
                </div>
                <p class="lost_password form-group">
                    <a class="btn btn-link" href="{{ sc_route('forgot') }}">
                        {{ sc_language_render('customer.password_forgot') }}
                    </a>
                    <br>
                    <a class="btn btn-link" href="{{ sc_route('register') }}">
                        {{ sc_language_render('customer.title_register') }}
                    </a>
                </p>
                @php
                $dataButton = [
                        'class' => '', 
                        'id' =>  '',
                        'type_w' => '',
                        'type_t' => 'buy',
                        'type_a' => '',
                        'type' => 'submit',
                        'name' => ''.sc_language_render('front.login'),
                        'html' => 'name="SubmitLogin"'
                    ];
                @endphp
                @include($sc_templatePath.'.common.button.button', $dataButton)
            </form>
        </div>
    </div>
</div>
</section>
<!--/form-->
@endsection