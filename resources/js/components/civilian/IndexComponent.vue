<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Citizen database</h3>
                                <div class="nk-block-des text-soft">
                                    <p>In total there are {{ civilians.total }} Citizens.</p>
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
                                            <div class="col-lg-6">
                                                <input @keyup.prevent="searchQuery" v-model="search.name" type="text" class="form-control" placeholder="Search for citizens">
                                            </div>
                                            <div class="col-lg-6">
                                                <select @change.prevent="searchQuery" v-model="search.sex" class="form-control">
                                                    <option selected value="">Select sex</option>
                                                    <option value="m">Male</option>
                                                    <option value="f">Female</option>
                                                </select>
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
                                            <div class="nk-tb-col"><span class="sub-text">Name</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Birthdate</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Sex</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Phone number</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Tags</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-right" v-can="'user.create.bolo'">
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                                </div>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                        <div class="nk-tb-item" v-for="civ in civilians.data">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                    <label class="custom-control-label" for="uid1"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col">
                                                <router-link :to="{ name: 'civilian-show', params: { identifier: civ.identifier } }" href="">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-primary">
                                                            <span><em class="ni ni-user"></em></span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ civ.firstname }} {{ civ.lastname }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                                        </div>
                                                    </div>
                                                </router-link>
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="tb-amount">{{ civ.dateofbirth }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{ civ.sex == 'm' ? 'Male' : 'Female' }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-lg">
                                                <span>{{ civ.phone_number }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-lg">
                                                <span v-for="bolo in bolos" v-if="bolo.civilian_id == civ.identifier" class="badge badge-dot badge-danger">Manhunt in progress...</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools" v-can="'user.create.bolo'">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a @click.prevent="setCivilian(civ.identifier)" data-toggle="modal" data-target="#bolo"><em class="icon ni ni-info"></em><span>Call out a manhunt</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <pagination :data="civilians" @pagination-change-page="getCivilians" :limit="10"></pagination>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="bolo">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-header">
                        <h5 class="modal-title">Call out a manhunt</h5>
                    </div>
                    <div class="modal-body">
                        <label for="">On what grounds do you call out the manhunt for this citizen?</label>
                        <editor
                            api-key="tn358sfioe89ot9qbxg208aa4ev92i3qb3tpgmbctdti7wkr"
                            :init="{
                                                height: 200,
                                                menubar: false,
                                                plugins: [],
                                                toolbar: '',
                                                content_style: 'body { color: white }'
                                        }" v-model="boloForm.reason"
                        />
                    </div>
                    <div class="modal-footer bg-light">
                        <button id="submitBtn" @click.prevent="sendBolo" class="btn btn-outline-danger">Call out a manhunt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    prop: ["name", "sex"],
    data() {
        return {
            civilians: {},
            search: {
                name: '',
                sex: '',
            },
            boloForm: new Form({
                civilian: '',
                reason: ''
            }),
            bolos: {},
            permissions: {
                setBolo: false,
            }
        }
    },
    mounted() {
        this.getCivilians()
    },
    methods: {
        getCivilians(page = 1) {
            axios.get('/einwohnerdatenbank/daten?page='+page)
                .then((response) => {
                    this.civilians = response.data.civilian;
                    this.bolos = response.data.bolos;
                    this.permissions.setBolo = response.data.permissions.setBolo;
                })
        },
        searchQuery() {
            axios.post('/einwohnerdatenbank/suchen', { name: this.search.name, sex: this.search.sex })
                .then((response) => {
                    this.civilians = response.data.query;
                    if (!this.search.sex === null) {
                        if (this.search.name === '') {
                            this.getCivilians()
                        } else if (this.sex === '') {
                            this.getCivilians()
                        }
                    }
                })
        },
        setCivilian(id) {
            this.boloForm.civilian = id;
        },
        sendBolo() {
            this.boloForm.post('/einwohnerdatenbank/fahndung/ausrufen')
                .then((response) => {
                    if (response.data.success) {
                        $('#submitBtn').attr('disabled', 'disabled')
                        this.$noty.success("The manhunt was successfully called!", {
                            timeout: 4000,
                            theme: 'relax'
                        })
                        this.getCivilians()
                    } else if(response.data.exists_already) {
                        this.$noty.error("There is already an active APB out on this citizen! Stop this one first, before you create a new one!", {
                            timeout: 10000,
                            theme: 'relax'
                        })
                    } else {
                        this.$noty.error("Error. Unfortunately, the manhunt could not be called.", {
                            timeout: 10000,
                            theme: 'relax'
                        })
                    }
                })
        }
    }
}
</script>
