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
                    <h2>Reset Code</h2>

                    <form class="form-horizontal" method="POST" action="{{ route('reset.code') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <input type="text" class="is_required validate account_input form-control {{ ($errors->has('code'))?"input-error":"" }}"
                                       name="code" placeholder="code" value="{{ old('code') }}">
                            </div>
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    {{ $errors->first('code') }}
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