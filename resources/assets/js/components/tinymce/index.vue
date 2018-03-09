<template>
	<div class="">
	 	 <quill-editor v-model="content"
            ref="myQuillEditor"
            :options="editorOption">
		 </quill-editor>
	</div>
</template>

<script>
	import 'quill/dist/quill.core.css'
	import 'quill/dist/quill.snow.css'
	import 'quill/dist/quill.bubble.css'

	import {quillRedefine} from 'vue-quill-editor-upload'
 	import {quillEditor} from 'vue-quill-editor'


	export default{
		name:'tinymce',
		components: {quillEditor, quillRedefine},
		data(){
			return {
				content: '',
        		editorOption: {}
			}
		},
		created () {

	      	this.editorOption = quillRedefine(
        	{
	          	// 图片上传的设置
	          	uploadConfig: {
	            	action: 'http://localhost:1234/api/img/upload',  // 必填参数 图片上传地址
	            	// 必选参数  res是一个函数，函数接收的response为上传成功时服务器返回的数据
	            	// 你必须把返回的数据中所包含的图片地址 return 回去
	            	res: (respnse) => {
	            		return respnse;
              			// return respnse.info
            		},
            		name: 'img'  // 图片上传参数名
          		}
        	})
	    }
	}
</script>