<template>
	<div>
		<ul class="pagination right">
		    <li :class="isOnFirstPage? 'disabled': ''"><a href="#" @click.prevent="loadPage('prev')"><i class="material-icons">chevron_left</i></a></li>
	            <template v-for="n in totalPage">
	                <li :class="isCurrentPage(n) ? 'active' : ''">
	                    <a href="#" @click.prevent="loadPage(n)"> {{ n }} </a>
	                </li>
	            </template>
		    <li :class="isOnLastPage? 'disabled': ''"><a href="#" @click.prevent="loadPage('next')"><i class="material-icons">chevron_right</i></a></li>
			
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
            },

            onEachSide: {
            	type: Number,
            	default() {
            		return 3;
            	}
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

            isOnLastPage() {
            	return this.pagination == null? false: this.pagination.current_page == this.pagination.total_pages;
            }
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