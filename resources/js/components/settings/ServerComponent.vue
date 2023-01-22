<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Einstellungen</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Bearbeite hier die Systemeinstellungen.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <div class="card-title-group">
                                        <h4>Servereinstellungen (FiveM)</h4>
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
                                <div class="card-inner p-3">
                                    <dl class="row">
                                        <dt class="col-sm-3">
                                            Nutzt du <a href="https://codesign.pro/package/4206352" class="alert-link" target="_blank">cd_garage</a> von Codesign? <a data-toggle="modal" data-target="#server"><em class="ni ni-info text-primary"></em></a>
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input @change.prevent="updateData" type="checkbox" class="custom-control-input" :checked="cd_garage" v-model="cd_garage" id="cd_garage">
                                                    <label class="custom-control-label" for="cd_garage"></label>
                                                </div>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="server">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-header">
                        <h5 class="modal-title">Servereinstellungen (FiveM)</h5>
                    </div>
                    <div class="modal-body">
                        <p>Nutzt du die Garage von CoDesign? Falls du diese nicht nutzt, wird automatisch das Standard-Garagen Script genutzt. Wie z.B. <code>esx_advanced_garage</code>. Wenn du ein anderweitiges Garagenscript nutzt, welches nicht dieselben Spalten nutzt wie die "normalen" von ESX, dann muss das System speziell auf diese angepasst werden.
                        </p>
                    </div>
                    <div class="modal-footer bg-light">
                        <span class="sub-text">Wir wünschen viel Spaß mit dem Polizeisystem v2</span>
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
            cd_garage: false,
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/einstellungen/server/abrufen')
                .then((response) => {
                    this.cd_garage = response.data.cd_garage;
                })
        },
        updateData() {
            axios.post('/einstellungen/server/aktualisieren', { cd_garage: this.cd_garage })
                .then((response) => {
                    this.$noty.success("Du hast die Servereinstellungen erfolgreich aktualisiert!", {
                        timeout: 4000,
                        theme: 'relax'
                    })
                    this.getData()
                })
        }
    }
}
</script>

<style scoped>

</style>
