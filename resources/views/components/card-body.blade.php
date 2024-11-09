@props(['bg_color' => 'blue'])

<div {{ $attributes->merge()->class('font-bold text-xl mb-2 text-center border border-blue-400 rounded-md shadow-md bg-' . $bg_color . '-400')  }}>
    {{ $title ?? "unknown"  }}
</div>
<p class="text-gray-700 text-xl px-2 text-center">
    {{ $slot ?? -1 }}
</p>
