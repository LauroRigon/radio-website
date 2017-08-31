<template>
	<ul class="nav navbar-nav">
		<li class="dropdown notifications-menu">
			<a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false" @click="hasUnread()"><i class="fa fa-bell-o"></i> <span class="label label-warning" v-text="countNotifications" v-show="countNotifications != 0"></span></a> 
			<ul class="dropdown-menu">
				<li class="header"><b>Notificações</b></li> 
				<li class="notifications" v-for="(notification, index) in notifications" v-if="index < maxNotifications" style="border: 0px">
					<ul class="menu">
						<li :class="(notification.read_at == null)? 'un-read': ''"><a :href="notification.data.link"><i class="fa" :class="notification.data.class"></i> {{ notification.data.title }}
		    				</a>
		    				<p>{{ limitMessage(notification.data.message) }}</p>
	    				</li>
	    			</ul>
	    		</li>

	    		<li class="footer"><a href="/admin/notifications">Ver todas</a></li>
	    	</ul>
	    </li>
	</ul>
</template>

<script>
	export default {
		props: {
			getNotificationsApi: {
				type: String,
				required: true
			},

			markAsReadApi: {
				type: String
			}
		},

		data() {
			return {
				notifications: [],
				maxNotifications: 7
			}
		},

		mounted() {
			this.getNotifications();
		},

		computed: {
			countNotifications() {

				var unreadNotifications = this.notifications.filter(function(notification) {
					return notification.read_at == null;
				});
				return unreadNotifications.length;
			}
		},

		methods: {
			getNotifications() {
				axios.get(this.getNotificationsApi)
				.then(function(response) {
					this.notifications = response.data[0];
				}.bind(this))
			},

			limitMessage(message) {
				var wordsLimit = 75;
				if(message.length > wordsLimit) {
					return message.substr(0, wordsLimit) + '...';
				}else{
					return message;
				}
				
			},

			hasUnread() {
				var hasUnread= false;
				this.notifications.forEach(function(notification) {
					if(notification.read_at == null){
						hasUnread = true;
					}
					return false;
				});

				if(hasUnread) {
					this.sendMarkAsRead();
				}
			},

			sendMarkAsRead() {
				axios.post(this.markAsReadApi)
				.then(function(response) {
					this.notifications.forEach(function(notification) {
						notification.read_at = true;
					});
				}.bind(this))
			}
		}
	}
</script>

<style>
	
</style>