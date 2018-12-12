<template>

    <div class="row">
        <div class="col m4 offset-m5 center-align">
            <img :src="avatarUrl" class="responsive-img circle">
            <button class="waves-effect btn blue" @click="openUploadModal">Selecionar Avatar</button>
            <input type="file" ref="avatarInput" style="display:none" @change="onFilePicked" accept="image/*">
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            avatarUrl: '',
            avatar: ''
        }
    },

    methods: {
        openUploadModal() {
            this.$refs.avatarInput.click()
        },

        onFilePicked(event) {
            const files = event.target.files

            const fileReader = new FileReader()
            fileReader.addEventListener('load', () => {
                this.avatarUrl = fileReader.result
            })

            fileReader.readAsDataURL(files[0])
            this.avatar = files[0]
        }
    }
}
</script>

