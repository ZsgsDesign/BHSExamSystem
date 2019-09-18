@extends('layouts.app')

@section('template')

<link rel="stylesheet" href="/static/fonts/Raleway/raleway.css">
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
        background: rgba(255, 255, 255, 0.9);
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

</style>

<div class="container mundb-standard-container">
    <h1 class="cm-title">我的考试及学习资料</h1>
    <div class="row">

        @foreach ($exams as $e)

            @if($e['file'])
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <exam-card onclick="location.href='{{$e["file_url"]}}'">
                        <h5><i class="MDI file-pdf"></i> {{$e["exam_name"]}}</h5>
                        <score-section>
                            <div>
                                <span>资料下载</span>
                            </div>
                        </score-section>
                        <p><i class="MDI download"></i> {{$e["file_name"]}}</p>
                    </exam-card>
                </div>
            @endif

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <exam-card onclick="location.href='/exam/{{$e["eid"]}}'">
                    <h5><i class="MDI school"></i> {{$e["exam_name"]}}</h5>
                    <score-section>
                        <div>
                            @if(is_null($e["score"]))
                                <span>尚未作答</span>
                            @else
                                <current-score class="{{$e["score"]>=$e["exam_line"]?"wemd-green-text":"wemd-red-text"}}">{{$e["score"]}}</current-score>
                                <tot-score>/ 100</tot-score>
                            @endif
                        </div>
                    </score-section>
                    <p><i class="MDI clock"></i> {{$e["exam_due"]}} 截止</p>
                </exam-card>
            </div>

        @endforeach
{{--
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <exam-card onclick="location.href='/exam/1'">
                <h5><i class="MDI school"></i> 这是第二个测试</h5>
                <score-section>
                    <div>
                        <span>尚未作答</span>
                    </div>
                </score-section>
                <p><i class="MDI clock"></i> 2019年3月28日 截止</p>
            </exam-card>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <exam-card onclick="location.href='/exam/1'">
                <h5><i class="MDI school"></i> 大学生第三个测试</h5>
                <score-section>
                    <div>
                        <current-score class="wemd-red-text">86</current-score>
                        <tot-score>/ 100</tot-score>
                    </div>
                </score-section>
                <p><i class="MDI clock"></i> 2019年3月28日 截止</p>
            </exam-card>
        </div> --}}
    </div>
</div>
<script>
    window.addEventListener("load",function() {

    }, false);

</script>
@endsection
