<select name="{{ $name }}" {{ $attributes }}>
   {{ $slot }}
</select>
<x-validation-error item="{{ $name }}" />