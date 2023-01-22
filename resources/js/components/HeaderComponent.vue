<template>
    <div class="nk-header nk-header-fixed is-light">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ml-n1">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-header-brand d-xl-none">
                    <a href="html/index.html" class="logo-link">
                        <img class="logo-light logo-img" src="https://cdn.discordapp.com/attachments/745411001108791367/859840198299615262/CADPD1.png" alt="logo">
                        <img class="logo-dark logo-img" src="" alt="logo-dark">
                    </a>
                </div><!-- .nk-header-brand -->
                <div class="nk-header-news d-none d-xl-block">
                    <div class="nk-news-list">
                        <a class="nk-news-item" href="#">
                            <div class="nk-news-icon">
                                <em class="icon ni ni-star-fill"></em>
                            </div>
                            <div class="nk-news-text">
                                <a href="" @click.prevent="toggleStatus" class="btn btn-outline-primary" v-if="duty">Go off duty</a>
                                <a href="" @click.prevent="toggleStatus" class="btn btn-outline-primary" v-else>Go on duty</a>
                            </div>
                        </a>
                    </div>
                </div><!-- .nk-header-news -->
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav">
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info d-none d-md-block">
                                        <div class="user-status">Administrator</div>
                                        <div class="user-name dropdown-indicator">{{ user.name }}</div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <em class="icon ni ni-user-alt"></em>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{ user.name }}</span>
                                            <span class="sub-text">Administrator</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><router-link :to="{ name: 'password' }" href=""><em class="icon ni ni-user-alt"></em><span>Change password</span></router-link></li>
                                        <!--                                        <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>-->
                                        <!--                                        <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>-->
                                        <!--                                        <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>-->
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="#" @click.prevent="logout"><em class="icon ni ni-signout"></em><span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li><!-- .dropdown -->
                    </ul><!-- .nk-quick-nav -->
                </div><!-- .nk-header-tools -->
            </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
            duty: false,
        }
    },
    mounted() {
        this.getUser()
    },
    methods: {
        getUser() {
            axios.get('/getUser')
                .then((response) => {
                    this.user = response.data.user;
                    this.duty = response.data.user.status == 'on_duty';
                })
        },
        logout() {
            axios.get('/logout')
                .then((response) => {
                    window.location.replace('/login');
                })
        },
        toggleStatus() {
            axios.post('/status/ändern')
                .then((response) => {
                    this.getUser()
                    if (this.duty) {
                        this.$noty.success("We wish you a nice evening", {
                            theme: 'relax',
                            timeout: 10000,
                        })
                    } else {
                        this.$noty.success("Welcome to the service!", {
                            theme: 'relax',
                            timeout: 10000,
                        })
                    }
                })
        }
    }
}
</script>

<style scoped>

</style>
