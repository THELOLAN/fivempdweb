<template>
    <form action="" @submit.prevent="postData" method="post">

        <h5 class="mb-3 text-center">Hauptdatenbank <a data-toggle="modal" data-target="#mainDatabase"><i class="ni ni-info-fill text-primary"></i></a></h5>
        <div class="form-group row">
            <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="IP/Domain, wo die Datenbank läuft">Host</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" v-model="introForm.main_host" :class="{ 'is-invalid' : introForm.errors.has('main_host') }">
                <has-error :form="introForm" field="main_host"></has-error>
            </div>
            <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Name der Datenbank">Name</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" v-model="introForm.main_name" :class="{ 'is-invalid' : introForm.errors.has('main_name') }">
                <has-error :form="introForm" field="main_name"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Benutzer, der auf die Datenbank zugreifen kann">Benutzer</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" v-model="introForm.main_user" :class="{ 'is-invalid' : introForm.errors.has('main_user') }">
                <has-error :form="introForm" field="main_user"></has-error>
            </div>
            <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Passwort der Datenbank">Passwort</label>
            <div class="col-lg-4">
                <input type="password" class="form-control" v-model="introForm.main_password" :class="{ 'is-invalid' : introForm.errors.has('main_password') }">
                <has-error :form="introForm" field="main_password"></has-error>
            </div>
        </div>
        <hr/>
        <h5 class="mb-3 text-center">Serverdatenbank <a data-toggle="modal" data-target="#mainDatabase"><i class="ni ni-info-fill text-primary"></i></a></h5>
        <div class="form-group row">
            <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="IP/Domain, wo die Datenbank läuft">Host</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" v-model="introForm.ingame_host" :class="{ 'is-invalid' : introForm.errors.has('ingame_host') }">
                <has-error :form="introForm" field="ingame_host"></has-error>
            </div>
            <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Name der Datenbank">Name</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" v-model="introForm.ingame_name" :class="{ 'is-invalid' : introForm.errors.has('ingame_name') }">
                <has-error :form="introForm" field="ingame_name"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Benutzer, der auf die Datenbank zugreifen kann">Benutzer</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" v-model="introForm.ingame_user" :class="{ 'is-invalid' : introForm.errors.has('ingame_user') }">
                <has-error :form="introForm" field="ingame_user"></has-error>
            </div>
            <label for="" class="text-white mt-1 text-right col-lg-2 required" data-toggle="tooltip" data-placement="top" title="Passwort der Datenbank">Passwort</label>
            <div class="col-lg-4">
                <input type="password" class="form-control" v-model="introForm.ingame_password" :class="{ 'is-invalid' : introForm.errors.has('ingame_password') }">
                <has-error :form="introForm" field="ingame_password"></has-error>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary col-lg-4 text-center btn-block">Speichern</button>
            </div>
        </div>
        <!-- Modal Content Code -->
        <div class="modal fade" tabindex="-1" id="mainDatabase">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-header">
                        <h5 class="modal-title">Datenbankdaten</h5>
                    </div>
                    <div class="modal-body">
                        <p>Bitte fülle hier alle Felder aus, um die Datenbankverbindung herzustellen. Jedes Feld, welches du dort siehst, ist ein Pflichtfeld.</p> <br>
                        <br>
                        <dl class="row">
                            <dt class="col-sm-2 text-primary">
                                Host:
                            </dt>
                            <dd class="col-sm-10">
                                Trage hier die Domain oder die IP-Adresse ein, wo die Datenbank läuft. Sollte die Datenbank auf demselben Server liegen, wo auch die Seite läuft, dann gebe bitte <code>localhost</code> an.
                            </dd>
                            <dt class="col-sm-2 text-primary">
                                Name:
                            </dt>
                            <dd class="col-sm-10">
                                Trage hier den Namen deiner Datenbank ein. z.B. <code>ns_polizeisystem</code>
                            </dd>
                            <dt class="col-sm-2 text-primary">
                                Benutzer:
                            </dt>
                            <dd class="col-sm-10">
                                Gebe hier den Datenbankbenutzer an, welcher Zugriff auf die Datenbank hat. Es wird empfohlen, einen extra Datenbankbenutzer zu erstellen, der <b>nur</b> auf diese Datenbank Zugriff hat, um den Schaden durch mögliche Angriffe zu minimieren.
                            </dd>
                            <dt class="col-sm-2 text-primary">
                                Passwort:
                            </dt>
                            <dd class="col-sm-10">
                                Um die größmögliche Sicherheit zu gewährleisten, müssen mindestens 8 Zeichen eingegeben werden. Außerdem wird empfohlen, Sonderzeichen zu nutzen, wie z.B. <code>@, $</code> oder andere Sonderzeichen, um das Passwort sicherer zu machen.
                            </dd>
                        </dl>
                    </div>
                    <div class="modal-footer bg-light">
                        <span class="sub-text">Wir wünschen viel Spaß mit dem Polizeisystem v2</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            introForm: new Form({
                main_host: '',
                main_name: '',
                main_user: '',
                main_password: '',
                ingame_host: '',
                ingame_name: '',
                ingame_user: '',
                ingame_password: ''
            })
        }
    },
    methods: {
        postData() {
            this.introForm.post('/einrichtung/absenden')
                .then((response) => {
                    // this.$router.push({ name: 'index' })
                    // window.location.replace('/');
                })
        }
    }
}
</script>

<style scoped>

</style>
