@extends($sc_templatePath.'.layout')

@section('block_main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-8 my-5">
            <h6 class="title-store">{{ sc_language_render('customer.change_password') }}</h6>

            <form method="POST" action="{{ route('change.password') }}">
                @csrf
                <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 col-form-label text-md-right">
                        {{ sc_language_render('customer.password_new') }}
                    </label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                        {{ sc_language_render('customer.password_confirm') }}
                    </label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        @php
                            $dataButton = [
                                    'class' => '',
                                    'id' =>  '',
                                    'type_w' => '',
                                    'type_t' => 'buy',
                                    'type_a' => '',
                                    'type' => 'submit',
                                    'name' => ''.sc_language_render('customer.change_password'),
                                    'html' => ''
                                ];
                        @endphp
                        @include($sc_templatePath.'.common.button.button', $dataButton)
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
