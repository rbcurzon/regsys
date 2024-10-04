<select {{ $attributes->merge(["class" => "w-full px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-600 form-control rounded-md shadow-inner text-sm"]) }}>
    {{ $slot }}
</select>
