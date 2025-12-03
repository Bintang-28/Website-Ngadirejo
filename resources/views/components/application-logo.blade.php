@php
    $siteLogo = App\Models\Setting::get('site_logo');
    $logoPath = $siteLogo 
        ? asset('storage/' . $siteLogo) 
        : asset('images/logokabmadiun.png');
@endphp

<img src="{{ $logoPath }}" {{ $attributes->merge(['alt' => 'Logo']) }}>