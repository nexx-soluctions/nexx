@extends('components.base-layout')

@section('body')
    <div class="bg-blue-500 p-4 shadow-lg">
        <nav class="flex items-center justify-between">    
            <div class="flex items-center space-x-2">
                <div class="text-white relative">
                    <x-filament::icon-button icon="heroicon-m-user"/>
                </div>
                <div class="text-white font-semibold">
                    <p><a href="{{ route('waiter.home') }}">Portal do Garçom</a></p>
                    <span class="text-sm">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </nav>
    </div>

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection