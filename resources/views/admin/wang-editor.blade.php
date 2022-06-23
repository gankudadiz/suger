<div class="{{$viewClass['form-group']}}">

    <label class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div {!! $attributes !!} style="width: 100%; height: 100%;">
            <p>{!! $value !!}</p>
        </div>

        <input type="hidden" name="{{$name}}" value="{{ old($column,$value) }}" />

        @include('admin::form.help-block')

    </div>
</div>

<!-- script标签加上 "init" 属性后会自动使用 Dcat.init() 方法动态监听元素生成 -->
<script require="@wang-editor" init="{!! $selector !!}">
    var E = window.wangEditor
    // id 变量是 Dcat.init() 自动生成的，是一个唯一的随机字符串
    var editor = new E('#' + id);
    editor.config.zIndex = 0,
    editor.config.uploadImgShowBase64 = true,
    editor.config.uploadFileName = 'mypic[]',
    editor.config.uploadImgServer = '/uploadFile',
    editor.config.uploadImgMaxSize = 10 * 1024 * 1024,// 10M
    editor.config.showLinkImg = false //隐藏插入网络图片的功能
    editor.config.uploadImgMaxLength = 1 // 一次最多上传 5 个图片
    editor.config.onchange = function (html) {
        $this.parents('.form-field').find('input[type="hidden"]').val(html);
    }
    editor.config.uploadImgHooks = {
        // 上传图片之前
        before: function(xhr) {
            console.log(xhr)

            // 可阻止图片上传
            // return {
            //     prevent: true,
            //     msg: '需要提示给用户的错误信息'
            // }
        },
        // 图片上传并返回了结果，图片插入已成功
        success: function(xhr) {
            console.log('success', xhr)
        },
        // 图片上传并返回了结果，但图片插入时出错了
        fail: function(xhr, editor, resData) {
            console.log('fail', resData)
        },
        // 上传图片出错，一般为 http 请求的错误
        error: function(xhr, editor, resData) {
            console.log('error', xhr, resData)
        },
        // 上传图片超时
        timeout: function(xhr) {
            console.log('timeout')
        },
        // 图片上传并返回了结果，想要自己把图片插入到编辑器中
        // 例如服务器端返回的不是 { errno: 0, data: [...] } 这种格式，可使用 customInsert
        customInsert: function(insertImgFn, result) {
            // result 即服务端返回的接口
             console.log('customInsert', result)

            // insertImgFn 可把图片插入到编辑器，传入图片 src ，执行函数即可
            insertImgFn(result.data[0].url)
        }
    }
    editor.create()
</script>
