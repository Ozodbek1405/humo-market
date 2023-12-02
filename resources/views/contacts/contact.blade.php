@extends('layouts.master')
@section('title')

@endsection


@section('content')

    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{route('contact.message')}}" method="POST">
                        @csrf
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Send Us A Message
                        </h4>
                        <div class="my-3">
                            <span class="text-gray-700 dark:text-gray-400">Phone</span>
                            <input id="phone" class="w-full mt-1 text-sm focus:border-purple-400 focus:outline-none form-input border p-3"
                                   name="phone" required placeholder="Phone number"/>
                            @error('phone')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="bor8">
                            <textarea required class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="message" placeholder="How Can We Help?"></textarea>
                        </div>
                        @error('message')
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="m-t-30 flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            Submit
                        </button>
                    </form>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<i class="fa fa-map"></i>
						</span>
                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Address
							</span>
                            <p class="stext-115 cl6 size-213 p-t-18">
                                {{setting('footer.site_address')}}
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<i class="fa fa-phone"></i>
						</span>
                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Phone number
							</span>
                            <p class="stext-115 cl1 size-213 p-t-18">
                                {{setting('footer.site_phone')}}
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<i class="fa fa-envelope"></i>
						</span>
                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Sale Support
							</span>
                            <p class="stext-115 cl1 size-213 p-t-18">
                                {{setting('footer.site_email')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
