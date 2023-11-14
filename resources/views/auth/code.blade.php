@extends('layouts.master')
@section('title')
    CODE
@endsection

@section('content')

    <div class="flex items-center p-6 bg-gray-50 my-8">
        <div class="flex-1 max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img class="object-cover w-full h-full" src="{{asset('/images/forgot-password-office.jpeg')}}" alt="Office"/>
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Enter code
                        </h1>
                        <form action="{{route('reset.code')}}" method="POST">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Code</span>
                                <input type="text" class="w-full mt-1 text-sm focus:border-purple-400 focus:outline-none form-input border"
                                       placeholder="000000" name="code" required/>
                            </label>
                            @error('code')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
