@extends('app')

@section('content')
<div class="container side">
    <div class="pane btm">
        <section>
            <h1>Dual Element Universe</h1>

            <p class="text">When my big son, Peter, was studying at university, he visited us regularly on Sundays. At these family gatherings we discussed our stuff and shared to each other our 'earth-shattering' thoughts and ideas.
On a sunny Sunday in early winter of 2019, the discussion came to quantum physics. I read Hawking’s brainstorming not long before. My child is a big fan of Hawking, so his eyes widened when I said Hawking was wrong about time as well. And even raising up the bet, I also mentioned that I think Einstein had more mistakes in the theory of relativity. Peter and I agreed that the explanation of quantum physics is weak and its truthfulness is in doubt, but it was too much. He said that if I can criticize such great minds, then the minimum is to prove my declaration. I irresponsibly answered; I will prove it, of course.
</p><p class="justify">A few weeks later, Peter asked me how my progress is in proving my declaration. Of course, I haven’t started it, I forgot about it. He just didn’t let go of the topic and asked me week after week. Following the principle of ‘do it, you get rid faster’, I decided to really prove my declaration. I admit, I was also excited about the thing, but I needed some motivating force that makes me capable to do hard thinking after an exhausting workday.</p><p> So I immersed myself in the topic.
</p>
            <p class="text">My first basic assumption was that the Universe does not know logic, makes no distinction between small and large, neither in energy nor in dimension. In all sizes and energy ranges, the same laws operate in the world. So, Newtonian physics must be valid in the subatomic range as well.
</p><p class="justify">From this came my second basic assumption that space cannot be empty, because the energy does not exist without matter. We know the ‘nothing’ in the outer space is not absolutely zero degrees. So there has to be some substance that transmits energy where there is 'nothing' according to today’s physics.
</p><p class="justify">My third basic assumption was that there is no pulling force. In our macro world there is no known connection - except the atomic contacts - which could convey an attractive effect. Because I considered physical laws to be universal in different size ranges, I presume the assumption, there are no attractive forces on the subatomic range either.
</p>
            <p class="text">Based on these assumptions, I first started thinking about how gravity can work without an attractive force.</p><p class="justify">Actually it is simple: by pushing effect. But what could have a pushing effect? For example, a lot of very tiny, high-velocity particles that move among atoms. With this, the gravity seems to work, because two atoms are able to shadow each other against the tiny particles, and then more particles collide to the outer surface of atoms than to the surface between the two atoms, which has a ‘pulling’ effect between the two atoms.
</p><p class="justify">Ok, it is fine, but small particles lose their kinetic energy in every collision, and atoms increase their energy. After a few bad ideas came up that, something that fills ‘nothing’ could be a substance that not only stores energy and refills the lost kinetic energy to small particles, but also diverts it from atoms. It creates an energy flow that balances the energy of the elementary parts.
</p><p class="justify">Thought followed thought and the model seemed to work. In fact, an exciting thing happened, when I analysed the behaviour of the model by changing the parameters of the system and type and number of nucleons; the result gave automatic explanation to other physical phenomena. That is, the study of the operation of gravity provided the explanation for the electric charge, core force, magnetism, electron and proton formation, origin of atomic bonds, mass increase, and almost all physical phenomena without having to look separately.</p><p class="justify">After that, I had to ‘just’ put my thoughts into an understandable form and by now the hypothesis of the Dual Element Universe was born.
</p>
            <p class="text">The hypothesis correctly describes facts, explains the phenomena of experiential physics, and has a much simpler structure than the current material model. It brings together all physical phenomena, provides a consistent and simple explanation for issues that are still difficult to explain or cannot be explained at all.</p>
            <p class="text">I hope my introduction made your feel so you will read the full hypothesis. I reassure everyone, it is not very long (~ 90 pages), even though it contains the whole of quantum physics - just as a sketch, of course. And I hope it’s not even complicated. I have tried to present the system and the proofs in such a way that if one is familiar with the basic knowledge of high school physics, they can already understand it.</p>

            <p class="text double">If you think it is worth for me to continue working on my hypothesis, please support me. You can get more information on <a href="{{ url('/support') }}">duelun.com/support</a> about support options.</p>
            <p class="text double">And did I prove my declaration? Peter accepted it, but it is up to each reader to decide for themselves. Visit <a href="{{url('/documents') }}">duelun.com/documents</a> to read for yourself.</p>
            <p class="text">Thank you for your attention!</p>
        </section>

        <section>

            @foreach($posts as $post)
                <div class="post">
                    <p class="date">{{$post->release_on}}</p>
                    <p class="text">{{$post->content}}</p>
                </div>
            @endforeach
        </section>
    </div>
    <div class="pane">
        @include('supporters')
    </div>

</div>
@endsection
