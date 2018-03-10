<template>
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
                        <tinymce :edit="postForm.content" @syncContent="getContent"></tinymce>
                    </el-form-item>
                </el-col>
            </el-row>
            <div class="article-submit-btn-group">
                <el-row type="flex" justify="center">
                    <el-col :span="2">
                        <el-button @click="submitArticle" type='primary'>{{isEdit ? '保存' : '发布'}}</el-button>
                    </el-col>
                    <el-col :span="2">
                        <el-button >取消</el-button>
                    </el-col>
                </el-row>
            </div>
        </el-form>
    </div>
</template>

<script>
import {uploadUrl} from 'Admin/config/env.js'
import {createArticle , fetchArticle} from 'Admin/api/article.js'

import tinymce from 'Admin/components/tinymce/index'

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

export default {
    name : 'article-detail',
    components:{tinymce},
    props:{
        isEdit:{
            type:Boolean,
            default:false
        },
        id:{
            type:Number
        }
    },
    data(){
        return {
            postForm: Object.assign({}, postDefault),
            pickerOptions: Object.assign({} , pickerOption),
            uploadUrl,
            options: Object.assign({}, options),
            rules:{},
            time:''
        }
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
        console.log(this.$route,this.isEdit);
        if(!this.isEdit || this.id == '')
            return;

        fetchArticle({id:this.id})
        .then(res=>{
            this.postForm = Object.assign({}, res.data.data);
            this.time = new Date(this.postForm.push_time);
        })


    },
    watch:{
        time(val){
            this.postForm.push_time = new Date(val).toMysqlFormat();
        }
    }

}
</script>

<style rel="stylesheet/scss" lang="css">

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
