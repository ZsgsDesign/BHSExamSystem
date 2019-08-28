@extends('layouts.app')

@section('template')

<style>
    paper-card {
        display: block;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        border-radius: 4px;
        transition: .2s ease-out .0s;
        color: #7a8e97;
        background: rgba(255, 255, 255, 0.9);
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

    .updating::after{
        content: " - 请等待"
    }

</style>

<div class="container mundb-standard-container">
    <div class="pt-5 pb-5" style="width:100%;">
        <paper-card>
            <p>修改密码</p>
            <div class="form-group">
                <label for="old-password" class="bmd-label-floating">旧密码</label>
                <input type="password" name="old-password" class="form-control" id="old-password" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="new-password" class="bmd-label-floating">新密码</label>
                <input type="password" name="new-password" class="form-control" id="new-password" autocomplete="new-password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password" class="bmd-label-floating">确认新密码</label>
                <input type="password" name="confirm-password" class="form-control" id="confirm-password" autocomplete="new-password" required>
            </div>
            <div class="text-center">
                <button id="password-change" class="btn btn-danger">修改</button>
            </div>
            <div id="password-tip" style="display: none;" class="text-center">
                <small id="password-tip-text" class="text-danger font-weight-bold"></small>
            </div>
        </paper-card>
    </div>
</div>
<script>
    window.addEventListener("load",function() {
        function slideUp(div_dom){
            $(div_dom).slideUp(100);
        }

        function error_tip(div_dom,text_dom,text){
            $(text_dom).addClass('text-danger');
            $(text_dom).removeClass('text-success');
            $(text_dom).text(text);
            $(div_dom).slideDown(100);
        }

        function seccess_tip(div_dom,text_dom,text){
            $(text_dom).addClass('text-success');
            $(text_dom).removeClass('text-danger');
            $(text_dom).text(text);
            $(div_dom).slideDown(100);
        }

        $('#password-change').on('click',function(){
            if($(this).is('.updating')){
                alert('slow down');
                return;
            }
            $(this).addClass('updating');
            slideUp('#password-tip');
            var old_password = $('#old-password').val();
            var new_password = $('#new-password').val();
            var confirm_password = $('#confirm-password').val();
            if(new_password != confirm_password){
                error_tip('#password-tip','#password-tip-text','Please confirm that the new passwords you entered are the same');
                $('#password-change').removeClass('updating');
                return;
            }
            if(old_password.length < 6 || new_password.length < 8){
                error_tip('#password-tip','#password-tip-text','The length of the password must be greater than 8 bits');
                $('#password-change').removeClass('updating');
                return;
            }
            $.ajax({
                url : '{{route("account_change_password")}}',
                type : 'POST',
                data : {
                    old_password : old_password,
                    new_password : new_password,
                    confirm_password : confirm_password
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(result){
                    if(result.ret == 200){
                        seccess_tip('#password-tip','#password-tip-text','Change Successfully, Please use the password you just set when logging in later')
                        $('#password-change').removeClass('updating');
                    }else{
                        error_tip('#password-tip','#password-tip-text',result.desc);
                        $('#password-change').removeClass('updating');
                    }
                }
            });
        });
    }, false);

</script>
@endsection
