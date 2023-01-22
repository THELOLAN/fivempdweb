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
                                        <h4>Allgemeine Einstellungen</h4>
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
                                    <form @submit.prevent="postData">
                                        <div class="row">
                                            <dt class="col-sm-2 mt-1">Seitenname</dt>
                                            <dd class="col-sm-9">
                                                <input type="text" class="form-control" v-model="site_name">
                                                <small class="text-muted">Bitte gebe hier den Seitennamen an, welcher oben im Tab deines Browsers angezeigt werden soll.</small>
                                            </dd>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12 text-center">
                                                <button id="submitBtn" class="btn btn-primary text-center col-lg-4 btn-block">Einstellungen speichern</button>
                                            </div>
                                        </div>
                                    </form>
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
            site_name: ''
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('einstellungen/abrufen')
                .then((response) => {
                    this.site_name = response.data.site_name;
                })
        },
        postData() {
            axios.post('einstellungen/allgemein/speichern', { site_name: this.site_name })
                .then((response) => {
                    if (response.data.success) {
                        this.$noty.success("Du hast die Allgemeinen Einstellungen erfolgreich gespeichert.", {
                            timeout: 6000,
                            theme: 'relax'
                        })
                        var button = $('#submitBtn');
                        button.attr('disabled', 'disabled');
                        setTimeout(function () {
                            button.removeAttr('disabled')
                        }, 6000)
                    }
                })
        }
    }
}
</script>

<style scoped>

</style>
