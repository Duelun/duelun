@extends('app')

@section('content')
<div class="container side">
    <div class="pane">
        <h1>Terms & Conditions</h1>
        <p class="text">This work is protected in its details and in its entirety by copyright. Any use of the written material is subject to the permission of the author.
The hypothesis, until scientific acceptance, is only fiction, so copyright extends to this as well.</p>
        <p class="text">In the name of free development of science, I consent to:</p><p>to quote the work in part, to store the details of the work of reasonable size for own use, to further the hypothesis, to use the hypothesis in an experiment,</p><p> as long as:</p>
        <p class="text"></p>
        <ul class="margin-left">
            <li><p>there is no financial benefit related to this activity,</p></li>
            <li><p>the user shares with me the fact of the use, the changed version of the hypothesis, the detailed description and result of the experiment (<a href="{{url('/contact')}}">www.duelun.com/contact</a>),</p></li>
            <li><p>his/her publication clearly and conspicuously shows the name of the hypothesis (Dual Element Universe) and official web address of hypothesis (<a href="{{url('/')}}">www.duelun.com</a>),</p></li>
            <li><p>contributes to the integration of his/her result into hypothesis, with an indication of the source.</p></li>
        </ul>
        <p class="text">If the above activity subsequently brings revenue to the user, the right of use will not be terminated, but I will ask a fair share of the revenue.</p>
        <p class="text">Any industrial use of the hypothesis, registration of a patent right based on or using the hypothesis is only possible with the prior consent of the author.</p>
        <p class="text double">If the hypothesis is scientifically accepted, it is considered a description of natural phenomena and can be used freely by everyone. I ask the user if he/she is gaining revenue from using the hypothesis, to ask himself/herself if my hypothesis has helped him/her in this; and if the answer is yes, please share a fair share of the revenue with me.</p>
        <p class="text double">I reserve the right to make changes at any time. 12/07/2021.</p>
    </div>
    <div class="pane">
        @include('supporters')
    </div>
</div>
@endsection
