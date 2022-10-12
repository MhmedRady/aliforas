<img {{ @$vue===true ? ':' : '' }}src="@if(@$vue===true)'@endif{{ asset(@$default ?: 'storage/uploads/default.png') }}@if(@$vue===true)'@endif"
     @if(!empty(@$url)) {{ @$vue===true ? ':' : '' }}data-src="{{ $url }}" @endif
     @isset($alt) alt="{{ $alt }}" @endisset @class(array_merge(['lazy' => !empty(@$url)], (is_array($class) ? $class : (is_string($class) ? [$class] : []))))>
