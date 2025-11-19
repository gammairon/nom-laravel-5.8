<div class="faq__items" itemscope="" itemtype="https://schema.org/FAQPage">

    @foreach($faqs as $faq)
        <div itemprop="mainEntity" itemscope="" itemtype="https://schema.org/Question">
            <h3 itemprop="name">{{$faq->question}}</h3>
            <div itemprop="acceptedAnswer" itemscope="" itemtype="https://schema.org/Answer">
                <div itemprop="text">
                    {{$faq->answer}}
                </div>
            </div>
        </div>
    @endforeach

</div>
