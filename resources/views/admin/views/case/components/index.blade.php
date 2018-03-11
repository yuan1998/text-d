<div id="case-bar">
	<div class="case-container">
		<el-form>
			<el-form-item class="form-container" label-position="top" :model="caseForm" :rules="rules" ref="postForm">
				<el-form-item label="封面图片">
					<el-upload
                        class="avatar-uploader"
                      :action="uploadUrl"
                      :show-file-list="false"
                      name="img"
                      accept="image"
                      :on-success="handleCoverSuccess"
                      :before-upload="beforeCoverUpload">
                        <img v-if="caseForm.cover" :src="caseForm.cover" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
				</el-form-item>
				<el-form-item label="标题">
					<el-input placeholder="案例的标题" v-model="caseForm.title"></el-input>
				</el-form-item>
				<el-row >
					<el-col :span="8">
						<el-form-item label="项目">
							<el-cascader
							  :options="projectOptions"
							  v-model="project_id"
							  @change="projectChange"
							  :show-all-levels="false">
							</el-cascader>
						</el-form-item>
					</el-col>
					<el-col :span="8">
						<el-form-item label="姓名">
							<el-input placeholder="姓名" v-model="caseForm.name"></el-input>
						</el-form-item>
					</el-col>
					<el-col :span="8">
						<el-form-item label="性别">
							<el-select v-model="caseForm.sex" placeholder="请选择">
		                        <el-option
		                          v-for="item in sexOptions"
		                          :key="item.value"
		                          :label="item.label"
		                          :value="item.value">
		                        </el-option>
		                    </el-select>
						</el-form-item>
					</el-col>
				</el-row>
				<el-form-item label="项目名称">
					<el-input placeholder="接受的项目" v-model="caseForm.project"></el-input>
				</el-form-item>
				<el-form-item label="专家">
					<el-select v-model="caseForm.expert_id" placeholder="请选择">
                        <el-option
                          v-for="item in expertOptions"
                          :key="item.value"
                          :label="item.label"
                          :value="item.value">
                        </el-option>
                    </el-select>
				</el-form-item>
				<el-form-item label="病情描述">
					<el-input v-model='caseForm.desc' type="textarea" placeholder="病情描述"></el-input>
				</el-form-item>
				<el-form-item label="专家描述">
					<el-input v-model="caseForm.expert_desc" type="textarea" placeholder="专家描述"></el-input>
				</el-form-item>
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
				<el-row >
					<el-col :span="12">
						<el-form-item label="Before">
							<el-upload
		                      class="avatar-uploader"
		                      :action="uploadUrl"
		                      :show-file-list="false"
		                      name="img"
		                      accept="image"
		                      :on-success="handleBeforeSuccess"
		                      :before-upload="beforeCoverUpload">
		                        <img v-if="caseForm.before_img" :src="caseForm.before_img" class="avatar">
		                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
		                    </el-upload>
						</el-form-item>
					</el-col>
					<el-col :span="12">
						<el-form-item label="After">
							<el-row >
								<el-upload
		                          class="avatar-uploader"
			                      :action="uploadUrl"
			                      :show-file-list="false"
			                      name="img"
			                      accept="image"
			                      :on-success="handleAfterSuccess"
			                      :before-upload="beforeCoverUpload">
			                        <img v-if="caseForm.after_img" :src="caseForm.after_img" class="avatar">
			                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
			                    </el-upload>
							</el-row>
						</el-form-item>
					</el-col>
				</el-row>
				<el-form-item label="链接">
					<el-input v-model="caseForm.link" placeholder="跳转的链接"></el-input>
				</el-form-item>
				<el-row >
					<el-button @click="submitCase" type="primary">发布</el-button>
					<el-button >取消</el-button>
				</el-row>
			</el-form-item>
		</el-form>
	</div>
</div>

@push('scripts')

<script>
const caseForm = {
	'name':'',
	'sex':'male',
	'expert_id':'',
	'expert_desc':'',
	'project':'',
	'desc':'',
	'cover':'',
	'after_img':'',
	'before_img':'',
	'project_id':'',
	'title':'',
}


const pickerOption =  {
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


const sexOptions = [
	{
		'value':'female',
		'label':'女'
	},
	{
		'value':'male',
		'label':'男'
	}
]

const expertOptions = [
	{
		value:'',
		label:'请先选择项目.'
	}
]


const projectOptions = @json($tree);



	new Vue({
		el:"#app",
		data:{
			caseForm: Object.assign({},caseForm),
			pickerOptions: Object.assign({} , pickerOption),
        	sexOptions: sexOptions.slice(0),
        	projectOptions: projectOptions.slice(0),
        	uploadUrl: _env.uploadUrl,
        	expertOptions : expertOptions.slice(0),
			time:'',
			project_id :[],
			rules:{}
		},
		methods:{
			beforeCoverUpload(file){
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
	        handleCoverSuccess(res){
	        	this.caseForm.cover = res.data;
	        },
	        handleAfterSuccess(res){
	        	this.caseForm.after_img = res.data;
	        },
	        handleBeforeSuccess(res){
	        	this.caseForm.before_img = res.data;
	        },
	        findExpert(id){
	        	service({
	        		url:'expert/fetchProject',
	        		params:{id},
	        		method:'post'
	        	}).then(res=>{

	        	})
	        },
	        projectChange(val){
	        	this.caseForm.project_id = val[val.length-1];
	        },
	        submitCase(){
	        	console.log(this.caseForm);
	        }
		}
	})

</script>


@endpush


@push('styles')
<style>
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
