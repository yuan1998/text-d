
<head>
    @stack('styles')
    @stack('scripts')
    <script src="node_modules/tinymce/tinymce.min.js"></script>

</head>


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
                <el-col :span='5'>
                    <el-form-item label="查看次数">
                        <el-input v-model="postForm.look"></el-input>
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
                        <!-- <tinymce :edit="postForm.content" @syncContent="getContent"></tinymce> -->
                        <textarea id="tinymce-y"></textarea>
                    </el-form-item>
                </el-col>
            </el-row>
            <div class="article-submit-btn-group">
                <el-row type="flex" justify="center">
                    <el-col :span="2">
                        <el-button @click="submitArticle" type='primary'>保存</el-button>
                    </el-col>
                    <el-col :span="2">
                        <el-button >取消</el-button>
                    </el-col>
                </el-row>
            </div>
        </el-form>
    </div>
</div>

<script>

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
console.log(Vue);

new Vue({
    el:'#app',
    data:{
        postForm: Object.assign({}, postDefault),
        pickerOptions: Object.assign({} , pickerOption),
        uploadUrl,
        options: Object.assign({}, options),
        rules:{},
        time:''
    },
    methods:{
        handleAvatarSuccess(res){
            this.postForm.cover = res.data;
        },
        beforeAvatarUpload(file){
            const isJPG = file.type === 'image/jpeg';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
              this.$message.error('上传头像图片只能是 JPG 格式!');
            }
            if (!isLt2M) {
              this.$message.error('上传头像图片大小不能超过 2MB!');
            }
            return isJPG && isLt2M;
        },
        submitArticle(){
            createArticle(this.postForm)
            .then(res=>{
                this.loading = true
                this.$notify({
                    title: '成功',
                    message: '发布文章成功',
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
        window.tinymce.init({
            selector:'#tinymce-y',
        })
    },
    watch:{
        time(val){
            this.postForm.push_time = new Date(val).toMysqlFormat();
        }
    }
})
</script>
