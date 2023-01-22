<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Vehicle database</h3>
                                <div class="nk-block-des text-soft">
                                    <p>In total there are {{ total }} vehicles.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <div class="card-title-group">
                                        <div class="col-lg-12 row">
                                            <div class="col-lg-12">
                                                <input @keyup.prevent="searchData" v-model="search.search" type="text" class="form-control" placeholder="Search by licenseplate">
                                            </div>
                                        </div>
                                    </div><!-- .card-title-group -->
                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="card-body">
                                            <div class="search-content">
                                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                            </div>
                                        </div>
                                    </div><!-- .card-search -->
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                    <label class="custom-control-label" for="uid"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col"><span class="sub-text">Licenseplate</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Owner</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Color</span></div>
                                        </div><!-- .nk-tb-item -->
                                        <div class="nk-tb-item" v-for="vehicle in vehicles.data">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                    <label class="custom-control-label" for="uid1"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col">
                                                <router-link :to="{ name: 'civilian-show', params: { identifier: vehicle.owner.identifier } }" href="" v-if="vehicle.owner">
                                                    <div class="user-card">
                                                            <span>{{ vehicle.plate }}</span>
                                                    </div>
                                                </router-link>
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="tb-amount" v-if="vehicle.owner"> {{ vehicle.owner.firstname }} {{ vehicle.owner.lastname }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span v-for="color in colors" v-if="JSON.parse(vehicle.vehicle).color1 == color.color_id">{{ color.color_name }}</span>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="alert alert-pro alert-danger" v-if="!results">
                                        <em class="ni ni-info"></em> No vehicles were found with the license plate "{{ search.search }}". Please search for another license plate.
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <pagination :data="vehicles" @pagination-change-page="getData" :limit="10"></pagination>
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
            vehicles: {},
            colors: {},
            search: {
                search: ''
            },
            total: 0,
            results: true,
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData(page = 1) {
            axios.get('/fahrzeugdatenbank/daten?page='+page)
                .then((response) => {
                    this.vehicles = response.data.vehicles;
                    this.colors = response.data.colors;
                    this.total = response.data.vehicles.total;
                })
        },
        searchData(page = 1) {
            axios.post('/fahrzeugdatenbank/suchen?page='+page, { search: this.search.search })
                .then((response) => {
                    this.vehicles = response.data.query;

                    if (this.vehicles.length > 0) {
                        this.results = true;
                    } else {
                        this.results = false;
                    }
                })
        }
    }
}
</script>

<style scoped>

</style>
