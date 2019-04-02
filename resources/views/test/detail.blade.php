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

</style>

<div class="container mundb-standard-container">
    <div class="pt-5 pb-5">
        <div class="cm-title"><h1>大学生诚信教育测试</h1><h1><span>1</span><small> / 50</small></h1></div>
        <p class="mb-5"><info-badge><i class="MDI clock"></i> 00:30:00</info-badge> <info-badge><i class="MDI buffer"></i> 50 题</info-badge> </p>
        <test-card data-pcode="1">
            <div class="tab-content">
                @foreach ($testProb as $p)
                    <div class="tab-pane fade @unless($loop->index) active show @endunless" role="tabpanel" id="pcode{{$p["pcode"]}}">
                        <div class="animated fadeIn">
                            <p>{{$p["pcode"]}}. {{$p["desc"]}}</p>
                            <choice-section>
                                @foreach ($p["choices"] as $c)
                                    <choice-item onclick="selectChoice(this)" data-pcode="{{$p["pcode"]}}" data-md5="{{$c["md5"]}}" data-acode="{{chr(65+$loop->index)}}">{{$c["content"]}}</choice-item>
                                @endforeach
                            </choice-section>
                        </div>
                    </div>
                @endforeach
            </div>
            <action-section role="tablist">
                <button type="button" class="btn btn-primary" id="prevProb" onclick="prevProb()" disabled><i class="MDI arrow-left-bold"></i> 上一题</button>
                <button class="btn btn-primary" id="nextProb" onclick="nextProb()">下一题 <i class="MDI arrow-right-bold"></i></button>
            </action-section>
        </test-card>
    </div>
</div>
<script>

    var curProb=1;
    var maxProb=50;
    var minProb=1;

    window.addEventListener("load",function() {

    }, false);

    function selectChoice(e){
        console.log($(e).attr("data-md5"));
        $(`choice-item[data-pcode="${$(e).attr("data-pcode")}"]`).removeClass("bhs-selected");
        $(e).addClass("bhs-selected");
    }

    function submitAns(){
        alert("提交问题");
    }

    function nextProb(){
        if(curProb>=maxProb){
            return submitAns();
        }else{
            $(`#pcode${curProb}`).removeClass("active");
            $(`#pcode${curProb}`).removeClass("show");
            $(`#pcode${curProb}`).removeClass("fadeIn");
            $(`#pcode${curProb}`).addClass("fadeOut");
            curProb++;
            $(`#pcode${curProb}`).addClass("active");
            $(`#pcode${curProb}`).addClass("show");
            $(`#pcode${curProb}`).addClass("fadeIn");
            $(`#pcode${curProb}`).removeClass("fadeOut");
            $(".cm-title span").text(curProb);
        }
        if(curProb>minProb){
            $("#prevProb").attr("disabled",false);
        }
        if(curProb>=maxProb){
            $("#nextProb").html(`提交 <i class="MDI send"></i>`);
            $("#nextProb").addClass("btn-warning");
            $("#nextProb").removeClass("btn-primary");
        }
    }

    function prevProb(){
        if(curProb<=minProb){
            return;
        }else{
            $(`#pcode${curProb}`).removeClass("active");
            $(`#pcode${curProb}`).removeClass("show");
            $(`#pcode${curProb}`).removeClass("fadeIn");
            $(`#pcode${curProb}`).addClass("fadeOut");
            curProb--;
            $(`#pcode${curProb}`).addClass("active");
            $(`#pcode${curProb}`).addClass("show");
            $(`#pcode${curProb}`).addClass("fadeIn");
            $(`#pcode${curProb}`).removeClass("fadeOut");
            $(".cm-title span").text(curProb);
        }
        if(curProb<=minProb){
            $("#prevProb").attr("disabled",true);
        }
        if(curProb<maxProb){
            $("#nextProb").html(`下一题 <i class="MDI arrow-right-bold"></i>`);
            $("#nextProb").removeClass("btn-warning");
            $("#nextProb").addClass("btn-primary");
        }
    }

</script>
@endsection
