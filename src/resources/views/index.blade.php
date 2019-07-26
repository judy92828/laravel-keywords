<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文章违禁词查询</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <script src="http://cdn.staticfile.org/jquery/1.12.3/jquery.min.js"></script>
    <style>
        .body {
            width: 60%;
            margin: 0 auto;
            margin-top: 5%;
        }

        .panel {
            margin-top: 5%;
        }

        .panel-body {
            text-align: center;
        }
        .panel-body button{
            margin: 0 2%;
        }
    </style>
</head>
<body>
<div class="body">
    <div class="form-group">
        <label class="sr-only" for="exampleInputAmount">违禁词</label>
        <div class="input-group">
            <div class="input-group-addon">违 禁 词</div>
            <input type="text" class="form-control" name="keywords" placeholder="请输入违禁词 多个以 | 隔开">
        </div>
    </div>
    <div class="form-group">
        <label class="sr-only" for="exampleInputAmount">文章内容</label>
        <div class="input-group">
            <div class="input-group-addon">文章内容</div>
            <textarea class="form-control" rows="8" name="body" placeholder="请输入文章内容"></textarea>
        </div>
    </div>
    <button type="button" class="btn btn-success">提交验证</button>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">存在以下违禁词</h3>
        </div>
        <div class="panel-body">
            <button type="button" disabled class="btn btn-default noKeyword">暂未查询</button>
        </div>
    </div>
</div>
<script>
    $('button').click(function () {
        var keywords = $('input[name=keywords]');
        var contents = $('textarea[name=body]');
        if (keywords.val() == '') {
            alert('匹配关键词不能为空');
            keywords.focus();
            return false;
        }
        if (contents.val() == '') {
            alert('文章内容不能为空');
            contents.focus();
            return false;
        }
        $.post("{{route('keywords.store')}}",
            {
                keywords: keywords.val(),
                contents: contents.val()
            },
            function (data) {
                if (data == '') {
                    $('.panel-body').html('<button type="button" disabled class="btn btn-default noKeyword">无匹配违禁词</button>');
                } else {
                    $('.panel-body').empty();
                    $.each(data, function (index, item) {
                        $('.panel-body').append('<button type="button" disabled class="btn btn-warning noKeyword">' + item + '</button>');
                    });
                }
            });

    });
</script>
</body>
s
</html>