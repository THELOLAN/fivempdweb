<template>
    <div class="nk-content " ref="loadingContainer">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Citizen database</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You see the file of <b>{{ civilian.firstname+' '+civilian.lastname }}</b></p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt" v-can="'user.create.entry'"><router-link :to="{ name: 'civilian-create-entry', params: { identifier: civilian.identifier } }" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Create file entry</span></router-link></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <h5 class="text-center mb-3">General information</h5>
                                    <div class="form-group row">
                                        <label for="" class="col-lg-3 text-right pt-1">Firstname</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" disabled v-model="civilian.firstname">
                                        </div>
                                        <label for="" class="col-lg-1 text-right pt-1">Lastname</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" disabled v-model="civilian.lastname">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-lg-3 text-right pt-1">Birthdate</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" disabled v-model="civilian.dateofbirth">
                                        </div>
                                        <label for="" class="col-lg-1 text-right pt-1">Phone</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" disabled v-model="civilian.phone_number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-lg-3 text-right pt-1">Height</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" disabled v-model="civilian.height+'cm'">
                                        </div>
                                        <label for="" class="col-lg-1 text-right pt-1">Current job</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" disabled :value="$t('jobs.'+civilian.job)">
                                        </div>
                                    </div>
                                    <div id="accordion" class="accordion">
                                        <div class="accordion-item">
                                            <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-1">
                                                <h6 class="title">File entries ({{ civilian.entries.length }})</h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" id="accordion-item-1" data-parent="#accordion">
                                                <div class="accordion-inner">
                                                    <table class="table table-tranx">
                                                        <thead>
                                                        <tr class="tb-tnx-head">
                                                            <th class="tb-tnx-id"><span class="">#</span></th>
                                                            <th class="tb-tnx-info">
                                                                <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-md-none">Date</span>
                                                                <span class="d-none d-md-block">
                                                                    <span>Crimes committed</span>
                                                                </span>
                                                            </span>
                                                            </th>
                                                            <th class="tb-tnx-amount is-alt">
                                                                <span class="tb-tnx-status d-none d-md-inline-block">Status</span>
                                                            </th>
                                                            <th class="tb-tnx-action">
                                                                <span>&nbsp;</span>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr class="tb-tnx-item" v-bind:key="entry.id" v-for="entry in civilian.entries">
                                                            <td class="tb-tnx-id">
                                                                <a href="#"><span>{{ entry.reference }}</span></a>
                                                            </td>
                                                            <td class="tb-tnx-info">
                                                                <div class="tb-tnx-date">
                                                                    <span class="date"><a href="" @click.prevent="setPenalties(entry.penalties, entry.fine, entry.imprisonment)" data-toggle="modal" data-target="#allPenalties">Show all crimes</a></span>
                                                                </div>
                                                            </td>
                                                            <td class="tb-tnx-amount is-alt">
                                                                <div class="tb-tnx-status">
                                                                    <span class="badge badge-dot badge-warning" v-if="entry.status == 0">Closed</span>
                                                                    <span class="badge badge-dot badge-success" v-else-if="entry.status == 1">Open</span>
                                                                    <span class="badge badge-dot badge-danger" v-else-if="entry.status == 2">Manhunt in progress...</span>
                                                                </div>
                                                            </td>
                                                            <td class="tb-tnx-action">
                                                                <div class="dropdown">
                                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                        <ul class="link-list-plain">
                                                                            <li><a @click.prevent="editEntry" href="#">Edit</a></li>
                                                                            <li><a @click.prevent="deleteEntry(entry.id)" href="#">Remove</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr v-if="civilian.entries.length == 0">
                                                            <td colspan="4" class="text-danger">No file entries have been created yet!</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-2">
                                                <h6 class="title">Vehicles ({{ vehicles.length }})</h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" id="accordion-item-2" data-parent="#accordion">
                                                <div class="accordion-inner">
                                                    <table class="table table-tranx">
                                                        <thead>
                                                        <tr class="tb-tnx-head">
                                                            <th class="tb-tnx-id"><span class="">Licenseplate</span></th>
                                                            <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Model</span>
                                                            </span>
                                                                <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-md-none">Date</span>
                                                                <span class="d-none d-md-block">
                                                                    <span>Color</span>
                                                                </span>
                                                            </span>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr class="tb-tnx-item" v-for="(vehicle, index) in vehicles">
                                                            <td class="tb-tnx-id">
                                                                <span class="text-primary">{{ vehicle.plate }}</span>
                                                            </td>
                                                            <td class="tb-tnx-info">
                                                                <div class="tb-tnx-desc">
                                                                    <span class="title" v-for="hash in hashes" v-if="hash.hash == JSON.parse(vehicle.vehicle).model">{{ hash.name }}</span>
                                                                </div>
                                                                <div class="tb-tnx-date">
                                                                    <span class="date" v-for="color in colors" v-if="JSON.parse(vehicle.vehicle).color1 == color.color_id">{{ color.color_name }}</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="accordion-item">
                                            <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-3">
                                                <h6 class="title">Sonstige Einträge (0)</h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" id="accordion-item-3" data-parent="#accordion">
                                                <div class="accordion-inner">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-4">
                                                <h6 class="title">Lizenzen ({{ civilian.licenses.length }})</h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" id="accordion-item-4" data-parent="#accordion">
                                                <div class="accordion-inner">
                                                    <table class="table">
                                                        <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">Lizenztyp</th>
                                                            <th scope="col" v-can="'user.remove.license'">Aktionen</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="license in civilian.licenses">
                                                            <td>{{ $t('licenses.'+license.type) }}</td>
                                                            <td v-can="'user.remove.license'">
                                                                <a @click.prevent="removeLicense(civilian.identifier, license.type)" href="" class="btn btn-outline-danger"><em class="ni ni-trash"></em></a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="allPenalties">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crimes committed</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <table class="table table-tranx">
                            <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-desc d-none d-sm-inline-block">
                                        <span>Straftat</span>
                                    </span>
                                    <span class="tb-tnx-date d-md-inline-block d-none">
                                        <span class="d-md-none">Date</span>
                                        <span class="d-none d-md-block">
                                            <span>Imprisonment</span>
                                            <span>Fine</span>
                                        </span>
                                    </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="tb-tnx-item" v-if="penalties.length > 0" v-for="penalty in penalties">
                                <td class="tb-tnx-info">
                                    <div class="tb-tnx-desc">
                                        <span class="title">{{ penalty.label }}</span>
                                    </div>
                                    <div class="tb-tnx-date">
                                        <span class="date">{{ penalty.imprisonment }} MINUTES</span>
                                        <span class="date">{{ penalty.fine }} USD</span>
                                    </div>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="1" class="text-danger">No penalties entered</td>
                            </tr>
                            <tr>
                                <td class="tb-tnx-info">
                                    <div class="tb-tnx-desc">
                                        <span class="title"><b>TOTAL</b></span>
                                    </div>
                                    <div class="tb-tnx-date">
                                        <span class="date"><b>{{ imprisonment }} MINUTES</b></span>
                                        <span class="date"><b>{{ fine }} USD</b></span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            civilian: {},
            licenses: {
                car: false,
                motorcylce: false,
                weapon: false,
                boat: false,
                truck: false,
                air: false,
            },
            penalties: {},
            fine: 0,
            imprisonment: 0,
            vehicles: {},
            hashes: {},
            colors: {},
        }
    },
    mounted() {
        this.getUser()
    },
    methods: {
        getUser() {
            axios.get('/einwohnerdatenbank/'+this.$route.params.identifier+'/abrufen')
                .then((response) => {
                    this.civilian = response.data.civilian;
                    this.vehicles = response.data.vehicles;
                    this.hashes = response.data.hashes;
                    this.colors = response.data.colors;
                })
        },
        editEntry() {
            this.$noty.warning("This function is still under development. ", {
                timeout: 6000,
                theme: 'relax'
            })
        },
        setPenalties(value, val, val2) {
            this.penalties = value;
            this.fine = val;
            this.imprisonment = val2;

        },
        removeLicense(civilian, license) {
            axios.post('/einwohnerdatenbank/lizenz/entfernen', { civ: civilian, lic: license })
                .then((response) => {
                    this.$noty.success("You have successfully revoked the resident's license.", {
                        theme: 'relax',
                        timeout: 4000
                    })
                    this.getUser()
                })
        },
        deleteEntry(val) {
            axios.post('/einwohnerdatenbank/eintrag/'+ val +'/löschen').then((response) => {
                this.$noty.success("You have successfully deleted the entry!")
                this.getUser()
            })
        }
    },
}
</script>

<style scoped>

</style>
