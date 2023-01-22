<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Bolo</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Get an overview of every citizen who is currently on the wanted list.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <table class="table mb-3">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Licenseplate / Name</th>
                                            <th scope="col">Text</th>
                                            <th v-can="'bolo.stop'" scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="bolo in bolos">
                                            <td>
                                                <span v-if="bolo.type == 'civilian'">{{ bolo.civilian.firstname+' '+ bolo.civilian.lastname }}</span>
                                                <span v-else>{{ bolo.plate }}</span>
                                            </td>
                                            <td v-html="bolo.reason"></td>
                                            <td v-can="'bolo.stop'">
                                                <a @click.prevent="stopBolo(bolo.id)" href="" class="btn btn-outline-primary">Stop bolo</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
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
            bolos: {}
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('fahndungen/daten')
                .then((response) => {
                    this.bolos = response.data.bolos;
                })
        },
        stopBolo(id) {
            axios.post('fahndung/'+id+'/stoppen')
                .then((response) => {
                    this.getData()
                    this.$noty.success("You have successfully stopped the manhunt!", {
                        theme: 'relax',
                        timeout: 4000
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>
