<label for="{{ $id }}" class="{{ $label_class }}">{{ $title }}</label>
<textarea type="text" id="{{ $id }}" name="{{ $name }}"
		  placeholder="{{ $placeholder }}"
		  class="{{ $textarea_class }} @if($isTiny) tiny @endif">{{ old($name) }}</textarea>
@error($name)
<div class="{{ $error_class }}">{{ $message }}</div>
@enderror