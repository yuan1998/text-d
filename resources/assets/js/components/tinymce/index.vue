<template>
    <div class="">
         <quill-editor :style="{heigth:height + 'px'}" v-model="content"
            ref="myQuillEditor"
            :options="editorOption">
         </quill-editor>
    </div>
</template>

<script>
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import VueQuillEditor, { quillEditor, Quill } from 'vue-quill-editor'
    import { ImageDrop } from 'quill-image-drop-module'
    import ImageResize from 'quill-image-resize-module';
    Quill.register('modules/imageDrop', ImageDrop);
    Quill.register('modules/imageResize', ImageResize);


  /*
    import {quillRedefine} from 'vue-quill-editor-upload'

    // import ImageResize from 'quill-image-resize-module'

    // console.log(Quill.register());
    // Quill.register('modules/imageResize', ImageResize);

    */


    import {container, ImageExtend, QuillWatch} from 'quill-image-extend-module'
    // import ImageResize from 'quill-image-resize-module'

    Quill.register('modules/ImageExtend', ImageExtend)
    // use resize module
    // Quill.register('modules/ImageResize', ImageResize)


    // console.log(ImageResize);

    export default{
        name:'tinymce',
        props:{
            edit:{
                type: String,
            },
            height:{
                type:Number,
                default:500,
            }
        },
        components: {quillEditor},
        data(){
            return {
                content:'',
                editorOption: {
                    modules: {
                        toolbar: {
                            container: container,
                            handlers: {
                                'image': function () {
                                    QuillWatch.emit(this.quill.id)
                                }
                            }
                        },
                        history: {
                            delay: 1000,
                            maxStack: 50,
                            userOnly: false
                        },
                        imageDrop: true,
                        ImageExtend: {
                            name: 'img',
                            size: 2,  // 单位为M, 1M = 1024KB
                            action: "http://localhost:1234/api/img/upload",
                            headers: (xhr) => {
                            },
                            response: (res) => {
                                return res.data;
                            },
                            sizeError:(res)=>{
                                this.$message({
                                    type:'error',
                                    message:'上传图片太大了.'
                                })
                            },
                            success:(res)=>{
                                this.$message({
                                    type:'success',
                                    message:'上传成功.'
                                })
                            },
                            error:(res)=>{
                                this.$message({
                                    type:'error',
                                    message:"上传失败,请重新上传或联系程序员."
                                })
                            }
                        },
                        imageResize: {
                            displayStyles: {
                                backgroundColor: 'black',
                                border: 'none',
                                color: 'white'
                            },
                            modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
                        }
                    }
                }
            }
        },
        created(){
            console.log(this.edit);
        },
        watch:{
            content(val){
                this.$emit('syncContent',val);
            },
            edit(val){
                if(val == '' || val == this.content)
                    return;
                this.content = val;
                // console.log(val , '2');
            }
        }
    }
</script>

<style>

</style>
