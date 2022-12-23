<?php
/**
 * @var string $iconClass
 * @var array $items
 */
?>
<span class="mr-3">
    <i class="fad {{ $iconClass }} text-secondarydark"></i>
    @foreach ($items as $item)
        {{ $item }}
        @if (!$loop->last)
            <strong class="text-black-50">/</strong>
        @endif
    @endforeach
</span>
