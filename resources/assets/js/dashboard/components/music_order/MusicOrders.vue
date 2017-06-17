<template>
	<div class="row">
		<div class="col-md-12">
			<ul class="timeline">
				<li v-for="musicOrder in musicOrders">
					<i class="fa fa-comment text-blue"></i>
					<div class="timeline-item">
						<span class="time"><i class="fa fa-clock-o"></i> {{ formatDate(musicOrder.created_at) }}</span>
						<h3 class="timeline-header">De: {{ musicOrder.name }}</h3>
						<div class="timeline-body" v-text="musicOrder.content"></div>
					</div>
				</li>
			</ul>
			<!--<pagination :pagination="pagination"></pagination>-->
		</div>
	</div>
</template>

<script>
	import Pagination from '../partials/Pagination.vue';

	export default {
		props: {
			getMusicOrderApi: {
				type: String,
				required: true
			}
		},

		components: {
			Pagination
		},

		data() {
			return {
				musicOrders: [],
				pagination: null,
				totalPage: 0,
                currentPage: 0
			}
		},

		mounted() {
			this.loadData();
		},

		methods: {
			loadPage(page) {
                if (page == 'prev') {
                    this.goPreviousPage()
                } else if (page == 'next') {
                    this.goNextPage()
                } else {
                    this.goPage(page)
                }
            },

            loadData() {
            	var url = this.getMusicOrderApi;

                if (this.currentPage) {
                    let page = ''
                    if (url.indexOf('?') != -1) {
                        page = '&page='
                    } else {
                        page = '?page='
                    }
                    url = url + page + this.currentPage
                }

                axios.get(url)
				.then(function(response) {
					console.log(response.data);
					this.musicOrders = response.data.data;
					this.pagination = {
						current_page: response.data.current_page,
						totalPage: response.data.last_page,
						per_page: response.data.per_page,
						total: response.data.total
					};
				}.bind(this))
            },
			formatDate(date) {
				function pad(s) { return (s < 10) ? '0' + s : s; }
				  var d = new Date(date);
				return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/') + ' ' + [pad(d.getHours()), pad(d.getMinutes()), pad(d.getSeconds())].join(':');
			}
		}
	}
</script>

<style>
	.clickable:hover {
		cursor: pointer;
	}
</style>