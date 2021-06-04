<label for="{{ $name }}" class="{{ $label_class }}">{{ $title }}</label>
<input type="text" id="{{ $name }}" name="{{ $name }}" class="{{ $input_class }}" value="{{ old($name) }}">
@error($name)
<div class="{{ $error_class }}">{{ $message }}</div>
@enderror