@blaze

{{-- Credit: Lucide (https://lucide.dev) --}}

@props([
    'variant' => 'outline',
])

@php
if ($variant === 'solid') {
    throw new \Exception('The "solid" variant is not supported in Lucide.');
}

$classes = Flux::classes('shrink-0')
    ->add(match($variant) {
        'outline' => '[:where(&)]:size-6',
        'solid' => '[:where(&)]:size-6',
        'mini' => '[:where(&)]:size-5',
        'micro' => '[:where(&)]:size-4',
    });

$strokeWidth = match ($variant) {
    'outline' => 2,
    'mini' => 2.25,
    'micro' => 2.5,
};
@endphp

{{-- <svg
    {{ $attributes->class($classes) }}
    data-flux-icon
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="{{ $strokeWidth }}"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    data-slot="icon"
>
  <path d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z" />
  <path d="M8 14v.5" />
  <path d="M16 14v.5" />
  <path d="M11.25 16.25h1.5L12 17l-.75-.75Z" />
</svg> --}}

<svg width="100%" height="100%" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;">
    <path d="M12,5C12.67,5 13.35,5.09 14,5.26C15.78,3.26 19.03,2.42 20.42,3C21.82,3.58 20,10 20,10C20.57,11.07 21,12.24 21,13.44C21,17.9 16.97,21 12,21C7.03,21 3,18 3,13.44C3,12.19 3.5,11.04 4,10C4,10 2.11,3.58 3.5,3C4.89,2.42 8.22,3.23 10,5.23C10.656,5.079 11.327,5.002 12,5Z" style="fill:none;fill-rule:nonzero;stroke:currentColor;stroke-width:2px;"/>
    <path d="M8,14L8,14.5" style="fill:none;fill-rule:nonzero;stroke:currentColor;stroke-width:2px;"/>
    <path d="M16,14L16,14.5" style="fill:none;fill-rule:nonzero;stroke:currentColor;stroke-width:2px;"/>
    <path d="M13.75,21.856L10.25,21.856C9.694,21.856 9.167,21.606 8.815,21.176C8.463,20.747 8.321,20.181 8.43,19.636L10.18,10.886C10.354,10.019 11.115,9.394 12,9.394C12.885,9.394 13.646,10.019 13.82,10.886L15.57,19.636C15.679,20.181 15.537,20.747 15.185,21.176C14.833,21.606 14.306,21.856 13.75,21.856ZM11.25,15.25C10.846,15.25 10.481,15.494 10.326,15.867C10.171,16.241 10.257,16.671 10.543,16.957L11.293,17.707C11.683,18.098 12.317,18.098 12.707,17.707L13.457,16.957C13.743,16.671 13.829,16.241 13.674,15.867C13.519,15.494 13.154,15.25 12.75,15.25L11.25,15.25Z" style="fill:currentColor;"/>
</svg>
