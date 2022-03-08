<template #content>

    <li class="nav-item" v-if="!$page.props.user"><Link  class="nav-link" title="Login" :href="route('login')">Login <span class="fa fa-sign-on" aria-hidden="true"></span></Link></li>
    <li class="nav-item" v-if="!$page.props.user"><Link  class="nav-link" title="Register" :href="route('register')">Register <span class="fa fa-sign-up" aria-hidden="true"></span></Link></li>
    <!-- Account Management -->
    <li class="nav-item" v-if="$page.props.user">
        <div class="dropdown">
            <a href="#"  class="nav-link dropdown-toggle" id="dropdownAuth" data-bs-toggle="dropdown" aria-expanded="false">
                Manage Account ({{ $page.props.user.name }})
            </a>
            <ul class="dropdown-menu text-small shadow w-100" aria-labelledby="dropdownAuth" style="">
                <li class="dropdown-item"><Link class="w-100" :href="`${this.$page.props.url}profile`">My Profile</Link></li>
                <li><hr class="dropdown-divider"></li>
                <li class="dropdown-item" v-if="this.$page.props.user.role == 'admin'"><Link class="w-100" :href="`${this.$page.props.url}admin/dashboard`">Dashboard</Link></li>
                <li><hr class="dropdown-divider"></li>
                <li class="dropdown-item"><Link class="w-100" @click="logout">Logout <span class="fa fa-sign-out-alt" aria-hidden="true"></span></Link></li>
            </ul>
        </div>
    </li>


</template>

<script>
export default {

    data() {
        return {
            hideDropDown: ''
        }
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout')).then(
                () => {
                    this.$inertia.route('home');
                }
            );
            this.hideDropDown = 'collapse';
        },
    },
    mounted() {
        // alert('ddd')
        // console.log('ddsds->dddseswewe');
        // console.log($page.props.user)
    }
}
</script>
