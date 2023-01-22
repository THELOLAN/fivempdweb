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
                                        <h4>Seiteneinstellungen <a data-toggle="modal" data-target="#explanation"><em class="ni ni-info text-primary"></em></a></h4>
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
                                        <dt class="col-sm-3">
                                            Personendatenbank
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(civilian_database, 'civilian_database')" :checked="civilian_database" v-model="civilian_database" id="civilian_database">
                                                    <label class="custom-control-label" for="civilian_database"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <hr class="hr-1">
                                        <dt class="col-sm-3">
                                            Fahrzeugdatenbank
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(vehicle_database, 'vehicle_database')" :checked="vehicle_database" v-model="vehicle_database" id="vehicle_database">
                                                    <label class="custom-control-label" for="vehicle_database"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <hr class="hr-1">
                                        <dt class="col-sm-3">
                                            Gesetzesbücher
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(law_books, 'law_books')" :checked="law_books" v-model="law_books" id="law_books">
                                                    <label class="custom-control-label" for="law_books"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <hr class="hr-1">
                                        <dt class="col-sm-3">
                                            Leitstelle
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(managment_center, 'managment_center')" :checked="managment_center" v-model="managment_center" id="managment_center">
                                                    <label class="custom-control-label" for="managment_center"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <hr class="hr-1">
                                        <dt class="col-sm-3">
                                            Dienstanweisungen
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(instructions, 'instructions')" :checked="instructions" v-model="instructions" id="instructions">
                                                    <label class="custom-control-label" for="instructions"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <hr class="hr-1">
                                        <dt class="col-sm-3">
                                            Fahndungen
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(bolo, 'bolo')" :checked="bolo" v-model="bolo" id="bolo">
                                                    <label class="custom-control-label" for="bolo"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <hr class="hr-1">
                                        <dt class="col-sm-3">
                                            Ermittlungen
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(investigations, 'investigations')" :checked="investigations" v-model="investigations" id="investigations">
                                                    <label class="custom-control-label" for="investigations"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <hr class="hr-1">
                                        <dt class="col-sm-3">
                                            Ausbildungen
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(trainings, 'trainings')" :checked="trainings" v-model="trainings" id="trainings">
                                                    <label class="custom-control-label" for="trainings"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <hr class="hr-1">
                                        <dt class="col-sm-3">
                                            Officer
                                        </dt>
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" @change.prevent="updateData(officer, 'officer')" :checked="officer" v-model="officer" id="officer">
                                                    <label class="custom-control-label" for="officer"></label>
                                                </div>
                                            </div>
                                        </dd>
                                        <dt class="col-sm-3">
                                            Logs
                                        </dt>
                                        <hr class="hr-1">
                                        <dd class="col-sm-9">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input @change.prevent="updateData(logs, 'logs')" type="checkbox" class="custom-control-input" :checked="logs" v-model="logs" id="logs">
                                                    <label class="custom-control-label" for="logs"></label>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                </div>
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="explanation">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-header">
                        <h5 class="modal-title">Seiteneinstellungen</h5>
                    </div>
                    <div class="modal-body">
                        <p>Hier hast du die Möglichkeit, die Funktionen auszuschalten, welche du nicht benötigst oder nicht verwenden möchtest. Klicke dazu einfach nur auf die Checkbox und schalte diese ein oder aus!
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
            civilian_database: true,
            vehicle_database: true,
            law_books: true,
            managment_center: true,
            instructions: true,
            bolo: true,
            investigations: true,
            trainings: true,
            officer: true,
            logs: true,
        }
    },
    mounted() {
      this.getData()
    },
    methods: {
        getData() {
          axios.get('/sidebar/daten')
            .then((response) => {
                console.log(response.data.civilian_database);
                this.civilian_database = response.data.civilian_database;
                this.vehicle_database = response.data.vehicle_database;
                this.law_books = response.data.law_books;
                this.managment_center = response.data.managment_center;
                this.instructions = response.data.instructions;
                this.bolo = response.data.bolo;
                this.investigations = response.data.investigations;
                this.trainings = response.data.trainings;
                this.officer = response.data.officer;
                this.logs = response.data.logs;
            })
        },
        updateData(val, name) {
            axios.post('einstellungen/seiten/aktualisieren', { check: val, name: name })
                .then((response) => {
                    if (response.data.success) {
                        this.$noty.success("Du hast die Seite erfolgreich aktiviert / deaktiviert!", {
                            theme: 'relax',
                            timeout: 4000
                        })
                        window.location.replace('/einstellungen/seiten')
                    }
                })
        }
    }
}
</script>

<style scoped>

</style>
