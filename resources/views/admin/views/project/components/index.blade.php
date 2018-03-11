<div class="project-bar">

	<el-form class="form-container" :model="projectForm" :rules="rules" ref="projectForm">
		<el-form-item label="项目名称">
			<el-input placeholder="项目名称" v-model="projectForm.title"></el-input>
		</el-form-item>
		<el-form-item label="父级分类">
				<el-cascader
				  :options="projectOptions"
				  v-model="parent_id"
				  @change="projectChange"
				  :change-on-select="true">
				</el-cascader>
		</el-form-item>
		<el-form-item label="项目封面">
			<el-upload
                class="avatar-uploader"
              :action="uploadUrl"
              :show-file-list="false"
              name="img"
              accept="image"
              :on-success="handleCoverSuccess"
              :before-upload="beforeCoverUpload">
                <img v-if="projectForm.cover_url" :src="projectForm.cover_url" class="avatar">
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
		</el-form-item>
		<el-form-item label="项目描述">
			<el-input placeholder="描述一下该项目" type="textarea" v-model="projectForm.desc"></el-input>
		</el-form-item>
		<el-form-item label="治疗方案">
			<el-input placeholder="治疗方案" type="textarea" v-model="projectForm.treatment"></el-input>
		</el-form-item>
		<el-form-item label="病发原因">
			<el-input placeholder="病发原因" type="textarea" v-model="projectForm.reason"></el-input>
		</el-form-item>
		<el-form-item label="症状">
			<el-input placeholder="症状" type="textarea" v-model="projectForm.symptom"></el-input>
		</el-form-item>
		<el-form-item label="危害">
			<el-input placeholder="危害" type="textarea" v-model="projectForm.harm"></el-input>
		</el-form-item>
		<el-form-item label="其他图片">
			<el-upload class="editor-slide-upload" :action="uploadUrl" name="img" :multiple="true" :file-list="projectForm.image" :show-file-list="true"
            list-type="picture-card" :on-remove="handleRemove" :on-success="handleSuccess">
            	<el-button size="small" type="primary">点击上传</el-button>
          	</el-upload>
		</el-form-item>
		<div>
			<el-button type="primary">创建</el-button>
			<el-button>取消</el-button>
		</div>
	</el-form>
</div>

@push('scripts')
<script type="text/javascript" src="/js/api/project.js"></script>

<script>

const projectForm = {
	cover_url:'',
	title:'',
	desc:'',
	parent_id:'',
	treatment:'',
	reason:'',
	symptom:'',
	image:[],
	harm:''
}

const projectOptions = @json($tree);

	new Vue({
		el:'#app',
		data:{
			projectOptions: projectOptions.slice(0),
			projectForm : Object.assign({},projectForm),
			uploadUrl:_env.uploadUrl,
			parent_id:[],
			rules:{}
		},
		methods:{
			handleRemove(){

			},
			projectChange(val){
				this.projectForm.parent_id = val[val.length -1];
			},
			handleSuccess(response, file) {
	        },
	        handleCoverSuccess(res){
	        	this.projectForm.cover_url = res.data;
	        },
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
		},

	})

</script>

@endpush