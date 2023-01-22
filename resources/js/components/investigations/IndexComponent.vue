<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Investigations</h3>
                                <div class="nk-block-des text-soft">
                                    <p>In total, there are {{ count }} investigations.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span>Sort</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a @click.prevent="getData" href="#"><span>All</span></a></li>
                                                            <li><a @click.prevent="activeData" href="#"><span>Active</span></a></li>
                                                            <li><a @click.prevent="inactiveData" href="#"><span>Inactive</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nk-block-tools-opt" v-can="'investigations.create'"><router-link :to="{ name: 'investigations-create' }" href="#" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add investigation</span></router-link></li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-sm-6 col-lg-4 col-xxl-3" v-for="investigation in investigations">
                                <div class="card card-bordered h-100">
                                    <div class="card-inner">
                                        <div class="project">
                                            <div class="project-head">
                                                <router-link :to="{ name: 'investigations-show', params: { id: investigation.id } }" href="" class="project-title">
                                                    <div class="user-avatar sq bg-purple"><span>{{ investigation.label.charAt(0)+investigation.label.charAt(1)  }}</span></div>
                                                    <div class="project-info">
                                                        <h6 class="title">{{ investigation.label }}</h6>
                                                        <span class="sub-text">
                                                            <span class="badge badge-dot badge-success" v-if="investigation.status == 'active'">Active</span>
                                                            <span class="badge badge-dot badge-danger" v-else>Closed</span>
                                                        </span>
                                                    </div>
                                                </router-link>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><router-link :to="{ name: 'investigations-show', params: { id: investigation.id } }" href=""><em class="icon ni ni-eye"></em><span>Show investigation</span></router-link></li>
                                                            <li v-can="'investigations.edit'"><a href="#"><em class="icon ni ni-edit"></em><span>Ermittlung bearbeiten</span></a></li>
                                                            <li v-can="'investigations.close'" v-if="investigation.status != 'inactive'"><a @click.prevent="closeData(investigation.id)" href="#"><em class="icon ni ni-check-round-cut"></em><span>Close investigation</span></a></li>
                                                            <li><a @click.prevent="deleteInvestigation(investigation.id)" href="" v-can="'investigations.delete'"><em class="icon ni ni-trash"></em><span>Delete investigation</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="project-details">
                                                <p>Open this investigation to get more information. </p>
                                            </div>
                                            <div class="project-meta">
                                                <ul class="project-users g-1">
                                                    <li v-for="user in investigation.users.slice(0, 2)">
                                                        <div class="user-avatar sm bg-primary"><span>{{ user.name.charAt(0) }}</span></div>
                                                    </li>
                                                    <li v-if="investigation.users.length - 2 != 0">
                                                        <div class="user-avatar bg-light sm"><span>+{{ investigation.users.length - 2 }}</span></div>
                                                    </li>
                                                </ul>
<!--                                                <span class="badge badge-dim badge-warning"><em class="icon ni ni-clock"></em><span>5 Days Left</span></span>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            investigations: {},
            count: 0,
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/ermittlungen/daten')
                .then((response) => {
                    this.investigations = response.data.investigations;
                    this.count = response.data.investigations.length;
                })
        },
        activeData() {
            axios.get('/ermittlungen/aktiv')
                .then((response) => {
                    this.investigations = response.data.investigations;
                })
        },
        inactiveData() {
            axios.get('/ermittlungen/inaktiv')
                .then((response) => {
                    this.investigations = response.data.investigations;
                })
        },
        closeData(id) {
            axios.post('/ermittlungen/'+id+'/schließen')
                .then((response) => {
                    this.getData()
                    this.$noty.success("You have successfully closed the investigation.")
                })
        },
        deleteInvestigation(id) {
            axios.post('/ermittlungen/'+id+'/löschen')
                .then((response) => {
                    this.getData()
                    this.$noty.success("You have successfully deleted the investigation.")
                })
        }
    }
}
</script>

<style scoped>

</style>
