@extends('app')

@section('content')
<div class="container side">
    <div class="pane">
        <h1>Support</h1>
        <p class="justify">Describing the hypothesis is time consuming, a bit strenuous in addition to work and would require some experimentation as well. Nevertheless, I would like to continue the work and produce a fully detailed, correctly proven theoretical description. Since I am not a physicist, in fact not any scientist, I don't have any publications or any scientific background, I can only count on community help to continue my work.
If you are reading this page, I think, you are convinced my hypothesis may be correct and worthy of improvement, so if you have the opportunity, please, support me in achieving of my goal.</p>

        <p class="underline text double">Financial support, sponsorship</p>
        <p class="justify">I know I still have a lot of work to do with my hypothesis that could be done effectively on a full-time basis. I and my family, like everyone else, need money for life and earning it is only possible by daily work. If you can support me with any amount, you facilitate me to make my research activity a full-time job. With this, you too can be part of perfecting this - in my opinion – great hypothesis.</p>

        <p class="underline text">Opinion, criticism</p>
        <p class="justify">The big trap of any unique hypothesis is, that the thoughts of its inventor are locked in into the hypothesis. To avoid this trap, I would also need the opinion of outside observers. So if you find a mistake in the hypothesis, have criticism, or just have a question, please share it with me on the forum and let’s discuss it. Of course, I also welcome any positive feedback as well.</p>

        <p class="underline text">Translation</p>
        <p class="justify">One of the foundations of scientific acceptance of my hypothesis is to get to know as many people as possible. Since I can only describe the hypothesis in Hungarian and English - and the English version not perfectly either - I am counting on your help for the translations. If you think you are capable to translate my work to any other language, please contact me.</p>

        <p class="underline text">Mathematical calculations, modeling</p>
        <p class="justify">As I have already written, I am not a physicist, and I am not a mathematician either. I have some mathematical background, but that’s not enough to set up all the mathematical equations in my hypothesis without further learning. Even if I manage to work full-time on my hypothesis, due to the volume of the topic, in my time on this earth, I will not have time to do the correct mathematical description of my hypothesis and computer modeling of multi-element systems. In the absence of any other solution, I would rather entrust this to the pros. Perhaps, you will be the one who provides conclusive evidence to my hypothesis by your mathematical calculations or computer modeling of multi-element systems.</p>



    </div>
    <div class="pane">
        @include('supporters')
    </div>
</div>
@endsection
