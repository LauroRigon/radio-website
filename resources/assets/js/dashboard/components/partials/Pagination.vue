<template>
	<div>
		<ul class="pagination pagination-md no-margin pull-right">
		    <li :class="isOnFirstPage? 'disabled': ''"><a>«</a></li>
		    <li><a href="#">»</a></li>
			<template v-if="notEnoughPages">
	            <template v-for="n in totalPage">
	                <li :class="isCurrentPage(n) ? 'active' : ''">
	                    <a @click="loadPage(n)"> {{ n }} </a>
	                </li>
	            </template>
	        </template>
        </ul>
	</div>
</template>

<script>
	
	export default {
		props: {
			pagination: {
                type: Object,
                default() {
                    return null
                }
            }
		},

		data() {
            return {
                onEachSide: 3
            }
        },

		computed: {
			totalPage() {
                return this.pagination == null? 0: this.pagination.total_pages;
            },

			isOnFirstPage() {
                return this.pagination == null? false: this.pagination.current_page == 1;
            },

            notEnoughPages() {
                return this.totalPage < (this.onEachSide * 2) + 1;
            },
		},

		methods: {
			loadPage(page) {
                this.$emit('loadPage', page)
            },

			isCurrentPage(page) {
                return page == this.pagination.current_page;
            }
		}
	}
</script>