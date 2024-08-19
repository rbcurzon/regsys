@props(["name"])

@error($name)
    <p class="text-danger fst-italic mt-4" role="alert"> {{ $message }}</p>
@enderror
