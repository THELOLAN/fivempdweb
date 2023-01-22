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
                                        <h4>Welche Einstellungen möchtest du bearbeiten?</h4>
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
                                    <div class="row">
                                        <dt class="col-sm-3">Allgemeine Einstellungen</dt>
                                        <dd class="col-sm-9">
                                            <router-link :to="{ name: 'settings-general' }" class="btn btn-primary" href="">Einstellungen öffnen</router-link>
                                        </dd>
                                    </div>
                                    <div class="row mt-3">
                                        <dt class="col-sm-3">
                                            Seiteneinstellungen
                                        </dt>
                                        <dd class="col-sm-6">
                                            <router-link :to="{ name: 'settings-sites' }" href="" class="btn btn-primary">Einstellungen öffnen</router-link>
                                        </dd>
                                    </div>
                                    <div class="row mt-3">
                                        <dt class="col-sm-3">
                                            Datenbankeinstellungen
                                        </dt>
                                        <dd class="col-sm-9">
                                            <router-link :to="{ name: 'settings-database' }" href="" class="btn btn-danger">Einstellungen öffnen</router-link>
                                        </dd>
                                    </div>
                                    <div class="row mt-3">
                                        <dt class="col-sm-3">
                                            Servereinstellungen (FiveM)
                                        </dt>
                                        <dd class="col-sm-9">
                                            <router-link :to="{ name: 'settings-server' }" href="" class="btn btn-warning">Einstellungen öffnen</router-link>
                                        </dd>
                                    </div>
                                </div>
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

        }
    },
    mounted() {

    },
    methods: {

    }
}
</script>
