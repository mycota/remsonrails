<template >

    <li class="nav-item dropdown" @click="markNotificationAsRead">
        <a id="navbarDropdown" class="navbar-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell"></i> <span class="badge badge-danger" id="count-notification">{{unreadNotifications.length}}</span>
            <span class="caret"></span>
        </a>

        <div style="width: 150%;" class="dropdown-menu notifi"  aria-labelledby="navbarDropdown" v-if="unreadNotifications.length">
            <notification-item v-for="unread in unreadNotifications" v-bind:key="unread.id" :unread="unread"></notification-item>
        </div>
        <div v-else>

        </div>
    </li>

</template>
<script>
    import NotificationItem from "./NotificationItem.vue";
    export default {
        props:['unreads', 'userid'],
        components:{NotificationItem},
        data(){
            return {
                unreadNotifications: this.unreads
            }
        },
        methods:{
            markNotificationAsRead() {
            if (this.unreadNotifications.length) {
                axios.get('/remsonrails/public/markAsRead');
            }
         }

        },
        mounted() {
            //console.log('Component mounted.');
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    //console.log(notification);
                    let newunreadNotifications = {data:{order:notification.order, user:notification.user}};
                    this.unreadNotifications.push(newunreadNotifications);
                });
        }

    }
</script>
