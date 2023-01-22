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
                                        <h4>Datenbankeinstellungen</h4>
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
                                    <div class="example-alert">
                                        <div class="alert alert-warning alert-icon">
                                            <em class="icon ni ni-alert-circle"></em>
                                            Achtung! Änderungen an der Datenbank können Auswirkungen auf das System haben. Bitte sei vorsichtig und ändere nur die Datenbankverbindung, wenn du bereits ein Backup deiner aktuellen erstellt hast!
                                        </div>
                                        <div class="alert alert-danger alert-icon">
                                            <em class="icon ni ni-alert-circle"></em>
                                            Aus Sicherheitsgründen sind keine Felder ausgefüllt! Bitte gebe <b>immer</b> alle Felder an!
                                        </div>
                                        <form action="">
                                            <div class="form-group row">
                                                <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="IP/Domain, wo die Datenbank läuft">Host</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control" v-model="databaseForm.main_host" :class="{ 'is-invalid' : databaseForm.errors.has('main_host') }">
                                                    <has-error :form="databaseForm" field="main_host"></has-error>
                                                </div>
                                                <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Name der Datenbank">Name</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control" v-model="databaseForm.main_name" :class="{ 'is-invalid' : databaseForm.errors.has('main_name') }">
                                                    <has-error :form="databaseForm" field="main_name"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Benutzer, der auf die Datenbank zugreifen kann">Benutzer</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control" v-model="databaseForm.main_user" :class="{ 'is-invalid' : databaseForm.errors.has('main_user') }">
                                                    <has-error :form="databaseForm" field="main_user"></has-error>
                                                </div>
                                                <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Passwort der Datenbank">Passwort</label>
                                                <div class="col-lg-4">
                                                    <input type="password" class="form-control" v-model="databaseForm.main_password" :class="{ 'is-invalid' : databaseForm.errors.has('main_password') }">
                                                    <has-error :form="databaseForm" field="main_password"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn btn-primary col-lg-4 text-center btn-block">Speichern</button>
                                                </div>
                                            </div>
                                        </form>
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
            databaseForm: new Form({
                main_host: '',
                main_name: '',
                main_user: '',
                main_password: ''
            })
        }
    },
    methods: {
        postForm() {
            this.databaseForm.post('')
                .then((response) => {

                })
        }
    }
}
</script>

<style scoped>

</style>
