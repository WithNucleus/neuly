<?php
/**
Default Sort Button - Ascending
 * @param $asc
 * @param $desc
 * @param $label
 */
?>

<span class="sort-container mr-4">
    @if($sort == $asc OR $sort == $desc)

        <?php
        if ($sort == $desc) : ?>
        <button data-sort="{{ $asc }}" class="sort-records btn sort-button">
                {{ $label }} <i class="fad fa-arrow-square-down ml-1"></i>
            </button>
        <?php else : ?>
        <button data-sort="{{ $desc }}" class="sort-records btn sort-button">
                {{ $label }} <i class="fad fa-arrow-square-up ml-1"></i>
            </button>
        <?php endif; ?>

    @elseif($sort == '')

        <button data-sort="{{ $desc }}" class="sort-records btn sort-button">
            {{ $label }} <i class="fad fa-arrow-square-up ml-1"></i>
        </button>

    @else

        <button data-sort="{{ $asc }}" class="sort-records btn sort-button inactive">
            {{ $label }} <i class="fad fa-arrow-square-up ml-1"></i>
        </button>

    @endif
</span>
