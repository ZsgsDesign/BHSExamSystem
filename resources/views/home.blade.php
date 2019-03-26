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


    contest-card{
        display: block;
        padding: 1rem;
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        margin-bottom: 2rem;
    }

    contest-card h5{
        font-size: 1.2rem;
        margin:0;
    }

    contest-card p{
        font-size: 0.85rem;
        margin:0;
        color:rgba(0,0,0,0.54);
        /* text-align: right; */
    }

    contest-card score-section{
        display:flex;
        height:8rem;
        justify-content: center;
        align-items: center;
    }

    contest-card score-section current-score{
        display:inline-block;
        font-size:3rem;
    }

    contest-card score-section tot-score{
        display:inline-block;
        font-size:1rem;
    }

    contest-card score-section span{
        display:inline-block;
        font-size:2rem;
        color: rgba(0,0,0,0.54);
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
    <h1 class="cm-title">我的考试</h1>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <contest-card>
                <h5><i class="MDI school"></i> 大学生诚信教育测试</h5>
                <score-section>
                    <div>
                        <current-score class="wemd-green-text">98</current-score>
                        <tot-score>/ 100</tot-score>
                    </div>
                </score-section>
                <p><i class="MDI clock"></i> 2019年3月28日 截止</p>
            </contest-card>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <contest-card>
                <h5><i class="MDI school"></i> 这是第二个测试</h5>
                <score-section>
                    <div>
                        <span>尚未作答</span>
                    </div>
                </score-section>
                <p><i class="MDI clock"></i> 2019年3月28日 截止</p>
            </contest-card>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <contest-card>
                <h5><i class="MDI school"></i> 大学生第三个测试</h5>
                <score-section>
                    <div>
                        <current-score class="wemd-red-text">86</current-score>
                        <tot-score>/ 100</tot-score>
                    </div>
                </score-section>
                <p><i class="MDI clock"></i> 2019年3月28日 截止</p>
            </contest-card>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load",function() {

    }, false);

</script>
@endsection
