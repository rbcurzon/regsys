@props(["name"])

@error($name)
    <p class="text-red-900 italic mt-4 rounded-md bg-white" role="alert"> {{ $message }}</p>
@enderror
