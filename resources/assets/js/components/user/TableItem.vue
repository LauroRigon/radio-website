<template>
	<tr v-show="isVisible">
      <td v-for="data in datas">{{data}}</td>
      <td><a href="">{{data}}</a></td>
      <td>
        <slot name="action"></slot>
      </td>
    </tr>
</template>

<script>

	export default {
		props: ['datas'],
		data() {
			return {
				isVisible: true
			}
		}
	}
</script>
