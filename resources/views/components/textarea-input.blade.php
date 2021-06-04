<label for="{{ $name }}" class="{{ $label_class }}">{{ $title }}</label>
<textarea type="text" id="{{ $name }}" name="{{ $name }}" class="{{ $textarea_class }} tiny">{{ old($name) }}</textarea>
@error($name)
<div class="{{ $error_class }}">{{ $message }}</div>
@enderror