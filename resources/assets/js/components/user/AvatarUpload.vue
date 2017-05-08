<template>
	<div class="box box-widget">
		<form action="uploadAvatar" method="POST" enctype="multipart/form-data">
			<slot name="token"></slot>
			<div class="form-group">
				<label for="file">Escolha sua foto: </label>
				<input id="file" type="file" name="avatar" @change="onFileChange">
			</div>
			<div class="row">
				<div class="col-lg-3">
					<img class="img-circle img-responsive" :src="image">
				</div>
			</div>
			<button class="btn btn-primary">Enviar</button>
		</form>
	</div>
</template>

<script>

export default {
	props: ['token'],
	data() {
		return {
			image: ''
		}
	},

	methods: {
	onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    }
	}
}
</script>

<style>

</style>