<div class="controleideias row mt-2 mb-1">
    <div class="action_links col-8 col-sm-9 pl-5">
        <a dusk="like" href="{{ route('proposal.like', ['id' => $proposal->id]) }}">
            <i class="far fa-thumbs-up" aria-hidden="true"></i><span class="hidden-xs">Curtir</span></a>

        <a dusk="dislike" href="{{ route('proposal.unlike', ['id' => $proposal->id]) }}">
            <i class="far fa-thumbs-down" aria-hidden="true"></i><span class="hidden-xs">Descurtir</span></a>

        @if (!Auth::check())
            <a dusk="support" href="{{ route('proposal.approval', $proposal->id) }}" onclick="if(!confirm('Para apoiar oficialmente uma ideia legislativa você precisa criar uma conta na página da ALERJ.')){return false;};">
                <i class="far fa-star" aria-hidden="true"></i><span class="hidden-xs">Apoiar!</span></a>
        @else
            <a dusk="support" href="{{ route('proposal.approval', $proposal->id) }}">
                <i class="far fa-star" aria-hidden="true"></i><span class="hidden-xs">Apoiar!</span></a>
        @endif

        @if (!Auth::check())
            <a href="{{ route('proposal.follow', $proposal->id) }}" onclick="if(!confirm('Para acompanhar uma ideia legislativa você precisa criar uma conta na página da ALERJ.')){return false;};">
                <i class="fas fa-asterisk" aria-hidden="true"></i><span class="hidden-xs">Acompanhar essa Ideia!</span></a>
        @else
            <a href="{{ route('proposal.follow', $proposal->id) }}">
                <i class="fas fa-asterisk" aria-hidden="true"></i><span class="hidden-xs">Acompanhar essa Ideia!</span></a>
        @endif
    </div>


    <div class="share_links col-4 col-sm-3 pr-5">
        <div class="float-right">
            <a href="mailto:&amp;subject={{ config('app.name') }}&amp;body={{ urlencode($url) }} ">
                <i class="fas fa-envelope-square"></i>
            </a>


            <a href="#"
               target="_blank"><i class="fab fa-whatsapp-square"></i>
            </a>




            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
               target="_blank"><i class="fab fa-facebook-square"></i>
            </a>

            <a href="https://twitter.com/intent/tweet?text=Proponha%20sua%20Ideia%20Legislativa%20Aqui!&url={{ urlencode($url) }}&via=Legislaqui! - ALERJ&hashtags={!! config('app.name') !!},e-democracia,e-cidadania"
               target="_blank"><i class="fab fa-twitter-square"></i>
            </a>

{{--            <a href="https://plus.google.com/share?url={{ urlencode($url) }}"
               target="_blank"><i class="fa fa-google-plus-square"></i></a>--}}



        </div>
    </div>
</div>

