

<div id="y-article-bar">
    <div class="createPost-container">
        <el-form class="form-container" label-position="top" :model="postForm" :rules="rules" ref="postForm">
            <el-form-item label="标题">
                <el-input v-model="postForm.title" placeholder="请输入标题"></el-input>
            </el-form-item>
            <el-row type="flex" :gutter="25">
                <el-col :span="5">
                    <el-form-item label="作者">
                        <el-input v-model="postForm.author"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item label="项目分类">
                        <el-select v-model="postForm.cat_id" placeholder="请选择">
                            <el-option
                              v-for="item in options"
                              :key="item.value"
                              :label="item.label"
                              :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item label="发表时间">
                        <el-date-picker
                          v-model="time"
                          :editable="false"
                          align="right"
                          type="date"
                          placeholder="选择日期"
                          :picker-options="pickerOptions">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-form-item label="摘要">
                <el-input v-model="postForm.summary"></el-input>
            </el-form-item>
            <el-form-item label="封面图片">
                <el-row >
                    <el-col :span="24">
                        <el-upload
                            class="avatar-uploader"
                          :action="uploadUrl"
                          :show-file-list="false"
                          name="img"
                          accept="image"
                          :on-success="handleAvatarSuccess"
                          :before-upload="beforeAvatarUpload">
                            <img v-if="postForm.cover" :src="postForm.cover" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-col>
                </el-row>
            </el-form-item>
            <el-row>
                <el-col :span="24">
                    <el-form-item label="文本内容">
                        <div class="tinymce-container editor-container">
                            <textarea id="tinymce-y"></textarea>
                            <div class="editor-custom-btn-container">
                                <div class="editor-custom-btn-container">
                                    <div class="upload-container">
                                        <el-button icon='el-icon-upload' size="mini" :style="{background:color,borderColor:color}" @click="dialogVisible = true" type="primary">
                                            上传图片
                                        </el-button>
                                        <el-dialog append-to-body :visible.sync="dialogVisible">
                                          <el-upload class="editor-slide-upload" :action="uploadUrl" name="img" :multiple="true" :file-list="fileList" :show-file-list="true"
                                            list-type="picture-card" :on-remove="handleRemove" :on-success="handleSuccess" :before-upload="beforeUpload">
                                            <el-button size="small" type="primary">点击上传</el-button>
                                          </el-upload>
                                          <el-button @click="dialogVisible = false">取 消</el-button>
                                          <el-button type="primary" @click="handleSubmit">确 定</el-button>
                                        </el-dialog>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <tinymce :edit="postForm.content" @syncContent="getContent"></tinymce> -->

                    </el-form-item>
                </el-col>
            </el-row>
            <el-form-item label="查看次数">
                <el-col :span="4">
                    <el-input v-model="postForm.look"></el-input>

                </el-col>
            </el-form-item>
            <el-form-item>
                <div class="article-submit-btn-group">
                    <el-row type="flex" justify="center">
                        <el-col :span="2">
                            <el-button @click="submitArticle" type='primary'> @{{edit ? "保存" : "发布"}}</el-button>
                        </el-col>
                        <el-col :span="2">
                            <el-button >取消</el-button>
                        </el-col>
                    </el-row>
                </div>
            </el-form-item>

        </el-form>
    </div>
</div>


@push('scripts')
<script src="/js/api/article.js"></script>

<script src="/node_modules/tinymce/tinymce.min.js"></script>

<script>
const isEdit = @json($isEdit);

const postDefault = {
    title:'',
    push_time:'',
    content:'',
    author:'',
    summary:'',
    cover:'',
    look:'',
    cat_id:''
}

const pickerOption =  {
    disabledDate(time) {
        // return false;
        return time.getTime() > Date.now();
    },
    shortcuts: [
        {
            text: '今天',
            onClick(picker) {
                picker.$emit('pick', new Date());
            }
        },
        {
            text: '昨天',
            onClick(picker) {
                const date = new Date();
                date.setTime(date.getTime() - 3600 * 1000 * 24);
                picker.$emit('pick', date);
            }
        },
        {
            text: '一周前',
            onClick(picker) {
                const date = new Date();
                date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
                picker.$emit('pick', date);
            }
        }
    ]
}

const options = [
    {
        value:'1',
        label:'1'
    },
    {
        value:'2',
        label:'2'
    },
    {
        value:'3',
        label:'3'
    },
    {
        value:'4',
        label:'4'
    },
    {
        value:'5',
        label:'5'
    },
    {
        value:'6',
        label:'6'
    },
    {
        value:'7',
        label:'7'
    }
]

const toolbar = ['bold italic underline strikethrough alignleft aligncenter alignright outdent indent  blockquote undo redo removeformat subscript superscript code codesample', 'hr bullist numlist link image charmap  preview anchor pagebreak fullscreen insertdatetime media table emoticons forecolor backcolor']

const plugins = ['advlist anchor autolink autoresize autosave bbcode code codesample colorpicker colorpicker contextmenu directionality emoticons fullpage fullscreen hr image imagetools importcss insertdatetime legacyoutput link lists media nonbreaking noneditable pagebreak paste preview print save searchreplace spellchecker tabfocus table template textcolor textpattern visualblocks visualchars wordcount']




new Vue({
    el:'#app',
    data:{
        postForm: Object.assign({}, postDefault),
        pickerOptions: Object.assign({} , pickerOption),
        uploadUrl:_env.uploadUrl,
        options: Object.assign({}, options),
        rules:{},
        time:'',
        hasChange: false,
        hasInit: false,
        dialogVisible: false,
        listObj: {},
        fileList: [],
        color:'#1890ff',
        edit:false
    },
    methods:{
        handleAvatarSuccess(res){
            this.postForm.cover = res.data;
        },
        checkAllSuccess(){
            return Object.keys(this.listObj).every(item => this.listObj[item].hasSuccess)
        },
        handleSubmit() {
          const arr = Object.keys(this.listObj).map(v => this.listObj[v])
          if (!this.checkAllSuccess()) {
            this.$message('请等待所有图片上传成功 或 出现了网络问题，请刷新页面重新上传！')
            return
          }
          console.log(arr)
          this.imageSuccessCBK(arr)
          // this.$emit('successCBK', arr)
          this.listObj = {}
          this.fileList = []
          this.dialogVisible = false
        },
        handleSuccess(response, file) {
          const uid = file.uid
          const objKeyArr = Object.keys(this.listObj)

          for (let i = 0, len = objKeyArr.length; i < len; i++) {
            if (this.listObj[objKeyArr[i]].uid === uid) {
              this.listObj[objKeyArr[i]].url = response.data
              this.listObj[objKeyArr[i]].hasSuccess = true
              return
            }
          }
        },
        handleRemove(file) {
          const uid = file.uid
          const objKeyArr = Object.keys(this.listObj)
          for (let i = 0, len = objKeyArr.length; i < len; i++) {
            if (this.listObj[objKeyArr[i]].uid === uid) {
              delete this.listObj[objKeyArr[i]]
              return
            }
          }
        },
        beforeUpload(file) {
          const _self = this
          const _URL = window.URL || window.webkitURL
          const fileName = file.uid
          this.listObj[fileName] = {}
          return new Promise((resolve, reject) => {
            const img = new Image()
            img.src = _URL.createObjectURL(file)
            img.onload = function() {
              _self.listObj[fileName] = { hasSuccess: false, uid: file.uid, width: this.width, height: this.height }
            }
            resolve(true)
          })
        },
        imageSuccessCBK(arr) {
          const _this = this
          arr.forEach(v => {
            let t = window.tinymce.get('tinymce-y');
            t.insertContent(`<img class="wscnph" src="${v.url}">`)
          })
        },
        beforeAvatarUpload(file){
            const isJPG = file.type === 'image/jpeg';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
              this.$message.error('上传头像图片只能是 JPG 格式!');
            }
            if (!isLt2M) {
              this.$message.error('图片不能超过 2MB!');
            }
            return isJPG && isLt2M;
        },
        submitArticle(){


            ( this.edit ? articleEdit(this.postForm) : createArticle(this.postForm)  )
            .then(res=>{
                this.loading = true
                this.$notify({
                    title: '成功',
                    message: (this.edit ? '修改' : '发布') +'文章成功',
                    type: 'success',
                    duration: 2000
                })
            }).catch(err => {
                console.log(err)
            });



        },
        getContent(content){
            this.postForm.content = content;
        }
    },
    created(){
        let data;

        if(isEdit){
            data  = @json($data);
            if(!data)
                return;
            this.time = data.push_time;
            this.postForm = data;
            this.edit = true;
        }

        let _this = this;
        window.tinymce.init({
            selector:'#tinymce-y',
            relative_urls: false,
            remove_script_host: false,
            height: 500,
            body_class: 'panel-body ',
            object_resizing: false,
            toolbar:  toolbar,
            menubar: 'file edit insert view format table',
            plugins: plugins,
            end_container_on_empty_block: true,
            powerpaste_word_import: 'clean',
            code_dialog_height: 450,
            code_dialog_width: 1000,
            advlist_bullet_styles: 'square',
            advlist_number_styles: 'default',
            imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
            default_link_target: '_blank',
            link_title: false,
            init_instance_callback: editor => {
              if (_this.value) {
                editor.setContent(_this.value)
              }
              _this.hasInit = true
              editor.on('NodeChange Change KeyUp SetContent', () => {
                this.postForm.content = editor.getContent();
              })
            },
            setup: function (ed){
                ed.on('init' ,function(e){
                    if(_this.edit)
                        e.target.setContent(data.content);
                })
            },
            images_dataimg_filter(img){
                setTime(_=>{
                    console.log(22);
                    console.log($(img));
                },0)
            },
            images_upload_handler(blobInfo, success, failure, progress){
                progress(0);
                const formData = new FormData();
                console.log(blobInfo.blob());
                formData.append('img', blobInfo.blob());
                axios.post(uploadUrl,formData).then(res=>{
                    success(res.data.data);
                    progress(100);
                }).catch(err => {
                    failure('出现未知问题，刷新页面，或者联系程序员')
                    console.log(err);
                });
            }
          })
    },
    watch:{
        time(val){
            this.postForm.push_time = new Date(val).toMysqlFormat();
        }
    }
})
</script>


@endpush


@push('styles')

<style rel="stylesheet/scss" lang="scss" scoped>

.tinymce-container {
  position: relative
}
.tinymce-textarea {
  visibility: hidden;
  z-index: -1;
}
.editor-custom-btn-container {
  position: absolute;
  right: 4px;
  top: -2px;
  /*z-index: 2005;*/
}
.editor-upload-btn {
  display: inline-block;
}

.upload-container {
  .editor-slide-upload {
    margin-bottom: 20px;
  }
}
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9 ;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }

    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }

    .article-submit-btn-group{
        margin-top: 20px;
    }


</style>

@endpush




