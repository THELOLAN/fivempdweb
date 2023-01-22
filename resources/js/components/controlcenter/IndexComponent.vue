<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Control center</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Deploy and manage your officers in the various fields!</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><router-link :to="{ name: 'controlcenter-create' }" href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-book"></em><span>New strip area</span></router-link></li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="alert alert-pro alert-warning" v-if="users.length == 0">
                                        <em class="ni ni-info"></em> Attention! There are no officers on duty at the moment!
                                    </div>
                                    <div class="alert alert-pro alert-info" v-if="control_centers.length == 0">
                                        <em class="ni ni-info"></em> Attention! No strip areas have been created yet! Please create a strip area first!
                                    </div>
                                    <div v-else>
                                        <div class="pb-3 btn-group">
                                            <button class="btn btn-outline-primary" disabled v-if="leitstelle">Current control center: {{ leitstelle.name }}</button>
                                            <button class="btn btn-outline-primary text-white" disabled v-else-if="!leitstelle">Current control center: No control center</button>
                                            <a @click.prevent="resetLeitstelle" href="" class="btn btn-outline-warning" v-can="'leitstelle.reset'">Reset control center</a>
                                            <a @click.prevent="giveLeitstelle" href="" class="btn btn-outline-info" v-if="leitstelle && leitstelle.id == auth.id">Leave control center</a>
                                            <a @click.prevent="takeLeitstelle" href="" class="btn btn-outline-info" v-can="'leitstelle.take'" v-else>Take over control center</a>
                                        </div>
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Strip area</th>
                                                <th scope="col">Assigned officer</th>
                                                <th scope="col">Assign officer</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="control_center in control_centers">
                                                <td style="width: 25%">{{ control_center.label }} ({{ control_center.users.length }} / {{ control_center.max_user }})</td>
                                                <td style="width: 25%">
                                                    <span class="badge badge-success mr-1" v-for="user in control_center.users">{{ user.name }}</span>
                                                </td>
                                                <td style="width: 25%">
                                                    <div class="col-lg-12"  v-can="'leitstelle.area.set'">
                                                        <div class="form-group row">
                                                            <div class="col-lg-8">
                                                                <v-select id="classified_user[]" v-model="classifyUserIntoArea.classified_user" label="name" :options="users" multiple></v-select>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <a @click.prevent="classifyUser(control_center.id)" href="" class="btn btn-outline-primary">Assign Officers</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%">
                                                    <div class="btn-group">
                                                        <a v-can="'leitstelle.area.reset'" @click.prevent="resetArea(control_center.id)" href="" class="btn btn-outline-warning">Reset</a>
                                                        <a v-can="'leitstelle.area.delete'" @click.prevent="deleteArea(control_center.id)" href="" class="btn btn-outline-danger">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
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
            users: {},
            control_centers: {},
            leitstelle: {},
            auth: {},
            classifyUserIntoArea: new Form({
                classified_user: '',
                area_id: ''
            }),
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/leitstelle/daten')
                .then((response) => {
                    this.users = response.data.users;
                    this.control_centers = response.data.control_centers;
                    this.leitstelle = response.data.leitstelle;
                    this.auth = response.data.auth;
                })
        },
        resetLeitstelle() {
            axios.post('/leitstelle/zurücksetzen')
                .then((response) => {
                    this.$noty.success("Officers were successfully cleared from the dispatch center and are no longer active on patrol.", {
                        theme: 'relax',
                        timeout: 4000,
                    })
                    this.getData()
                })
        },
        takeLeitstelle() {
            axios.post('/leitstelle/übernehmen')
                .then((response) => {
                    this.$noty.success("You have successfully taken over the control center.", {
                        theme: 'relax',
                        timeout: 4000,
                    })
                    this.getData()
                })
        },
        giveLeitstelle() {
            axios.post('/leitstelle/abgeben')
                .then((response) => {
                    this.$noty.success("You have successfully delivered the control center.", {
                        theme: 'relax',
                        timeout: 4000,
                    })
                    this.getData()
                })
        },
        classifyUser(value) {
            this.classifyUserIntoArea.area_id = value;
            this.classifyUserIntoArea.post('/leitstelle/officer/einteilen')
                .then((response) => {
                    this.$noty.success("You have successfully assigned the officer(s) to the patrol area!", {
                        theme: 'relax',
                        timeout: 4000,
                    })
                })
            this.getData()
        },
        resetArea(id) {
            axios.post('/leitstelle/'+id+'/zurücksetzen')
                .then((response) => {
                    this.$noty.success("You have successfully reset the strip area.", {
                        theme: 'relax',
                        timeout: 4000,
                    })
                    this.getData()
                })
        },
        deleteArea(id) {
            axios.post('/leitstelle/'+id+'/löschen')
                .then((response) => {
                    this.$noty.success("You have successfully cleared the strip area.", {
                        theme: 'relax',
                        timeout: 4000,
                    })
                    this.getData()
                })
        }
    }
}
</script>

<style>
.vs__dropdown-toggle {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: flex;
    padding: 0 0 4px;
    background: none;
    border: 1px solid rgba(255, 255, 255,1);
    border-radius: 4px;
    white-space: normal;
}
</style>
