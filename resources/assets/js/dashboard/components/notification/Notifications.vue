<template>
	<div class="row">
		<div class="col-md-12">
			<ul class="timeline">
				<li v-for="(notification, index) in notifications" v-if="index < maxNotifications">
					<i class="fa" :class="notification.data.class"></i>
					<div class="timeline-item clickable" @click="redirectTo(notification.data.link)">
						<span class="time"><i class="fa fa-clock-o"></i> {{ formatDate(notification.created_at) }}</span>
						<h3 class="timeline-header" v-text="notification.data.title"></h3>
						<div class="timeline-body" v-text="notification.data.message"></div>
					</div>
				</li>
			</ul>
			<div class="col-md-5 centered" v-if="maxNotifications < countNotifications()">
				<a class="btn btn-primary btn-block" @click="loadMore()">Carregar mais</a>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			getNotificationsApi: {
				type: String,
				required: true
			}
		},

		data() {
			return {
				notifications: [],
				maxNotifications: 10
			}
		},

		mounted() {
			this.getNotifications();
		},

		methods: {
			getNotifications() {
				axios.get(this.getNotificationsApi)
				.then(function(response) {
					this.notifications = response.data[0];
				}.bind(this))
			},

			formatDate(date) {
				function pad(s) { return (s < 10) ? '0' + s : s; }
				  var d = new Date(date);
				return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/') + ' ' + [pad(d.getHours()), pad(d.getMinutes()), pad(d.getSeconds())].join(':');
			},

			loadMore() {
				this.maxNotifications += 5;
			},

			countNotifications() {
				return this.notifications.length;
			},

			redirectTo(link) {
				window.location.href = link;
			}
		}
	}
</script>

<style>
	.clickable:hover {
		cursor: pointer;
	}
</style>