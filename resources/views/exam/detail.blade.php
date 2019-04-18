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
        @if(strtotime($detail["exam_due"])<time())
        <button type="button" class="btn btn-raised btn-secondary" disabled>已截止</button>
        @else
        <button type="button" class="btn btn-raised btn-primary" onclick="startTest()">开始测试</button>
        @endif
        <button type="button" class="btn btn-raised btn-secondary" onclick="history()">历史纪录</button>
    </div>
</div>
<script>
    window.addEventListener("load",function() {

    }, false);
    @if(strtotime($detail["exam_due"])>=time())
    function startTest(){
        location.href="{{route('exam_start', ['eid' => $detail['eid']])}}";
    }
    @endif

    function history(){
        $.ajax({
            type: 'POST',
            url: '/ajax/exam/getHistory',
            data: {
                eid: {{$detail["eid"]}}
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(ret){
                console.log(ret);
                if(ret.ret==200){
                    console.log(ret);
                    var logs=`
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">时间</th>
                                <th scope="col">得分</th>
                                <th scope="col">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    ret.data.forEach(function(ele){
                        logs+=`
                            <tr>
                                <th scope="row">${ele.tid}</th>
                                <td>${ele.time}</td>
                                <td>${ele.score}</td>
                                <td><a href="/test/${ele.tid}">详情</a></td>
                            </tr>
                        `;
                    });

                    logs+=`
                            </tbody>
                        </table>
                    `;

                    alert(logs,"历史");
                } else {
                    alert(ret.desc);
                }
            }, error: function(xhr, type){
                console.log(xhr);
                switch(xhr.status) {
                    case 422:
                        alert(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[0]][0], xhr.responseJSON.message);
                        break;
                    default:
                        alert("服务器连接错误");
                }
            }
        });
    }

</script>
@endsection
