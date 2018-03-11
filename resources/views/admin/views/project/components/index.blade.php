<div class="project-bar">

	<el-form >
		<el-form-item label="项目名称">
			<el-input placeholder="项目名称" v-model="projectForm.title"></el-input>
		</el-form-item>
		<el-form-item label="父级分类">
			 <el-select >
				<el-option
                  v-for="item in catOptions"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value">
                </el-option>
			 </el-select>
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
                <img v-if="projectForm.cover" :src="projectForm.cover" class="avatar">
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
		</el-form-item>
		<el-form-item label="项目描述">
			<el-input placeholder="描述一下该项目" type="textarea" v-model="projectForm.desc"></el-input>
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
	cover:'',
	title:'',

}

const catOptions = @json($tree);


	new Vue({
		el:'#app',
		data:{
			catOptions: catOptions.slice(0),
		},
		create(){


		}
	})

</script>

@endpush