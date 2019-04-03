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

    h1{
        margin-bottom:2rem;
        color: #3E4551;
    }

    h1 small{
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
        background: #fff;
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
        height: 4rem;
        line-height: 4rem;
        border-bottom:1px solid rgba(0, 0, 0, 0.15);
        transition: .2s ease-out .0s;
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

    test-card choice-section choice-item.bhs-selected::before{
        border: 1px solid #f44336;
        background: #f44336;
        color: rgba(255, 255, 255, 1);
    }

    test-card:hover {
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
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

    .mundb-standard-container {
        flex-shrink: 0;
        flex-grow: 1;
        padding-top: 0;
        align-items: center;
        display: flex;
        justify-content: center;
    }

</style>

<div class="container mundb-standard-container">
    <div class="pt-5 pb-5" style="text-align: center;">
        <h1><span class="{{$testInfo["score"]>=$examInfo["exam_line"]?"wemd-green-text":"wemd-red-text"}}">{{$testInfo["score"]}}</span> <small>/ 100</small></h1>
        <h1 class="mb-0">{{$examInfo["exam_name"]}}</h1>
        <p class="mb-5"><i class="MDI {{$testInfo["score"]>=$examInfo["exam_line"]?"check-circle":"close-circle"}}"></i> 本次测试{{$testInfo["score"]>=$examInfo["exam_line"]?"已":"未"}}通过</p>
        <a href="/exam/{{$examInfo["eid"]}}"><button type="button" class="btn btn-raised btn-primary">再测一次</button></a>
        <a href="/"><button type="button" class="btn btn-raised btn-secondary">返回首页</button></a>
    </div>
</div>
<script>

    window.addEventListener("load",function() {

    }, false);

</script>
@endsection