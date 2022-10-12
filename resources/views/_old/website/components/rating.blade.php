<div class="rating-star">
    @if($rate == 0)
        @for($i=0;$i<5;$i++)
            <i class="fa fa-star-o"></i>
        @endfor
    @elseif($rate <6)
        @for($i=0;$i<$rate;$i++)
            <i class="fa fa-star"></i>
        @endfor
        @for($i=0;$i<(5-$rate);$i++)
            <i class="fa fa-star-o"></i>
        @endfor
    @else
        @for($i=0;$i<5;$i++)
            <i class="fa fa-star"></i>
        @endfor
    @endif
</div>