@php
/*
$layout_page = shop_auth
*/
@endphp

@extends($sc_templatePath.'.layout')

@section('block_main')
<section class="section section-sm section-first bg-default text-md-left">
    <div class="container">
    <div class="row">
        <div class="col-12 col-sm-12">
            <h2>{{ sc_language_render('customer.password_forgot') }}</h2>

            <form class="form-horizontal" method="POST" action="{{ sc_route('password.email') }}" id="sc_form-process">
                {{ csrf_field() }}
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
                    <br>
                    {!! $viewCaptcha ?? ''!!}
                    @php
                        $dataButton = [
                                'class' => '',
                                'id' =>  'sc_button-form-process',
                                'type_w' => '',
                                'type_t' => 'buy',
                                'type_a' => '',
                                'type' => 'submit',
                                'name' => ''.sc_language_render('action.submit'),
                                'html' => ''
                            ];
                    @endphp
                    @include($sc_templatePath.'.common.button.button', $dataButton)
                </div>
            </form>
        </div>
    </div>
</div>
</section>

@endsection