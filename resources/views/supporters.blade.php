<div>

    <section class="sub">
        <p class="justify">Thank you to those, who supported me with their donations so that I could spend as much time as possible to develop my hypothesis. If you want to support me, I thank you too, and you can do it here.</p>
        <a href="https://www.justgiving.com/crowdfunding/duelun?utm_term=nnx5yXRDX" target="_blank" id="pp_redir"><button class="btn">Donate</button></a>
    </section>

    <section class="sub">
        <p class="justify">Thank you to those, who helped me in my work with opinions and criticism. If you have an opinion or critique related to my hypothesis, or just want to ask questions, we can discuss it here.</p>
        <a href="//duelun.webforum.eu" target="_blank" id="forum_redir"><button class="btn">Discuss</button></a>
    </section>

    <section class="sub">
        <p>Thanks to those, who helped me in any other ways.</p>
        <ul>
            @foreach($supporters as $supporter)
            <div class="supporter-row">
                <p class="name">{{$supporter->name}}</p>
                <p class="details">{{$supporter->details}}</p>
            </div>
            @endforeach

        </ul>
    </section>

</div>
