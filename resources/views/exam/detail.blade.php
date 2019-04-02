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
    }

    .cm-oj{
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        margin-bottom: 2rem;
        padding: 0.5rem 1rem;
        background: rgb(255, 255, 255);
    }


    exam-card{
        display: block;
        padding: 1rem;
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        margin-bottom: 2rem;
        transition: .2s ease-out .0s;
        cursor: pointer;
    }

    exam-card h5{
        font-size: 1.2rem;
        margin:0;
    }

    exam-card p{
        font-size: 0.85rem;
        margin:0;
        color:rgba(0,0,0,0.54);
        /* text-align: right; */
    }

    exam-card score-section{
        display:flex;
        height:8rem;
        justify-content: center;
        align-items: center;
    }

    exam-card score-section current-score{
        display:inline-block;
        font-size:3rem;
    }

    exam-card score-section tot-score{
        display:inline-block;
        font-size:1rem;
    }

    exam-card score-section span{
        display:inline-block;
        font-size:2rem;
        color: rgba(0,0,0,0.54);
    }

    exam-card:hover {
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
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

    .mundb-standard-container{
        display: flex;
        /* justify-content: center; */
        align-items: center;
    }

    info-badge{
        display: inline-block;
        padding-right:1rem;
        color:rgba(0, 0, 0, 0.54);
    }

</style>

<div class="container mundb-standard-container">
    <div class="pt-5 pb-5">
        <h1 class="cm-title">{{$detail["exam_name"]}}</h1>
        <p><info-badge><i class="MDI clock"></i> {{$detail["exam_due"]}} 截止</info-badge> <info-badge><i class="MDI check-circle"></i> @if(is_null($detail["score"])) 尚未作答 @else 我的最高得分 {{$detail["score"]}}@endif</info-badge></p>
        <p class="mb-5">{{$detail["description"]}}</p>
        <button type="button" class="btn btn-raised btn-primary" onclick="startTest()">开始测试</button>
        <button type="button" class="btn btn-raised btn-secondary">历史纪录</button>
    </div>
</div>
<script>
    window.addEventListener("load",function() {

    }, false);

    function startTest(){
        location.href="/test/1";
    }

</script>
@endsection
