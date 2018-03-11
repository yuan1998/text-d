<div class="upload-container">
	<el-button icon='el-icon-upload' size="mini" :style="{background:color,borderColor:color}" @click=" dialogVisible=true" type="primary">上传图片
	</el-button>
	<el-dialog append-to-body :visible.sync="dialogVisible">
		<el-upload class="editor-slide-upload" action="https://httpbin.org/post" :multiple="true" :file-list="fileList" :show-file-list="true"
		list-type="picture-card" :on-remove="handleRemove" :on-success="handleSuccess" :before-upload="beforeUpload">
			<el-button size="small" type="primary">点击上传</el-button>
		</el-upload>
	  	<el-button @click="dialogVisible = false">取 消</el-button>
		<el-button type="primary" @click="handleSubmit">确 定</el-button>
	</el-dialog>
</div>


@push('scripts')
<script>

</script>


@endpush
