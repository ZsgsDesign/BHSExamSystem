@extends('layouts.app')

@section('template')

<style>
    paper-card {
        display: block;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        border-radius: 4px;
        transition: .2s ease-out .0s;
        color: #7a8e97;
        background: #fff;
        padding: 1rem;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.15);
        margin-bottom: 2rem;
    }

    paper-card:hover {
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 40px;
    }

    .cm-title{
        margin-bottom:2rem;
        color: #3E4551;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cm-title h1:last-of-type{
        flex-shrink: 0;
        flex-grow: 0;
        padding-left: 1rem;
    }

    .cm-title small{
        color: rgba(0, 0, 0, 0.54);
        font-size: 50%;
    }

    .cm-oj{
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        margin-bottom: 2rem;
        padding: 0.5rem 1rem;
        background: rgb(255, 255, 255);
    }


    test-card{
        display: block;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        margin-bottom: 2rem;
        transition: .2s ease-out .0s;
    }

    test-card h5{
        font-size: 1.2rem;
        margin:0;
    }

    test-card score-section{
        display:flex;
        height:8rem;
        justify-content: center;
        align-items: center;
    }

    test-card score-section current-score{
        display:inline-block;
        font-size:3rem;
    }

    test-card score-section tot-score{
        display:inline-block;
        font-size:1rem;
    }

    test-card score-section span{
        display:inline-block;
        font-size:2rem;
        color: rgba(0,0,0,0.54);
    }

    test-card choice-section{
        display: block;
    }

    test-card choice-section choice-item{
        display: block;
        /* height: 4rem; */
        line-height: 2rem;
        border-bottom:1px solid rgba(0, 0, 0, 0.15);
        transition: .2s ease-out .0s;
        padding-top:1rem;
        padding-bottom:1rem;
    }

    test-card choice-section choice-item:last-of-type{
        border-bottom:none;
    }

    test-card action-section{
        display: flex;
        justify-content: space-between;
        margin-top:1rem;
    }

    test-card choice-section choice-item::before{
        display: inline-block;
        line-height: 2rem;
        content: attr(data-acode);
        margin-right:1rem;
        width:2rem;
        height: 2rem;
        border-radius: 200px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        text-align: center;
        color: rgba(0, 0, 0, 0.54);
        transition: .2s ease-out .0s;
    }

    test-card choice-section choice-item.bhs-wrong::before{
        border: 1px solid #f44336;
        background: #f44336;
        color: rgba(255, 255, 255, 1);
    }

    test-card choice-section choice-item.bhs-correct::before{
        border: 1px solid #4caf50 ;
        background: #4caf50 ;
        color: rgba(255, 255, 255, 1);
    }

    test-card:hover {
        /* box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px; */
        display: block;
    }


    .cm-avatar{
        width:2.5rem;
        height:2.5rem;
        border-radius: 200px;
    }

    .cm-anno{
        color:rgba(0,0,0,0.54);
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    info-badge{
        display: inline-block;
        padding-right:1rem;
        color:rgba(0, 0, 0, 0.54);
    }

    button[disabled]{
        pointer-events: none;
    }

    .tab-pane.fade{
        pointer-events: none!important;
    }

    .tab-pane.fade.show{
        pointer-events: auto!important;
    }

    test-card > div:first-of-type{
        margin-top:0!important;
    }

    test-card > div:last-of-type{
        margin-bottom:0!important;
    }

</style>

<div class="container mundb-standard-container">
    <div class="pt-5 pb-5" style="text-align: center;">
        <h1><span class="{{$testInfo["score"]>=$examInfo["exam_line"]?"wemd-green-text":"wemd-red-text"}}">{{$testInfo["score"]}}</span> <small>/ 100</small></h1>
        <h1 class="mb-0">{{$examInfo["exam_name"]}}</h1>
        <p class="mb-5"><i class="MDI {{$testInfo["score"]>=$examInfo["exam_line"]?"check-circle":"close-circle"}}"></i> 本次测试{{$testInfo["score"]>=$examInfo["exam_line"]?"已":"未"}}通过</p>
        @if(strtotime($examInfo["exam_due"])<time())
        <button type="button" class="btn btn-raised btn-secondary" disabled>已截止</button>
        @else
        <a href="{{route('exam_start', ['eid' =>$examInfo["eid"]])}}"><button type="button" class="btn btn-raised btn-primary">再测一次</button></a>
        @endif
        <a href="/"><button type="button" class="btn btn-raised btn-secondary">返回首页</button></a>
    </div>
    <test-card>
            @foreach($testResult as $t)
            <div class="mt-5 mb-5">
                <p>{{$t["pcode"]}}. {{$t["desc"]}}</p>
                <choice-section>
                    @foreach ($t["choices"] as $c)
                        <choice-item data-acode="{{chr(65+$loop->index)}}" class="@if(md5($c["content"])==$t["cur_ans"]) bhs-wrong @endif @if(md5($c["content"])==$t["correctAns"]) bhs-correct @endif">{{$c["content"]}}</choice-item>
                    @endforeach
                </choice-section>
            </div>
            @endforeach
    </test-card>
</div>
<script>

    window.addEventListener("load",function() {

    }, false);

</script>
@endsection
