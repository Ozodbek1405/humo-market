@extends('layouts.master')
@section('title')
    FAQ&HELP
@endsection

@section('content')
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            @foreach($faqs as $faq)
                <div class="row p-b-50">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        <h3 class="mtext-111 font-bold p-b-16">
                            {{$faq->title}}
                        </h3>
                        <p class="stext-113 cl6 p-b-26">
                            {!! $faq->text !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
