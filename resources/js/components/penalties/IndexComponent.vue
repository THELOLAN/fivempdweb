<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Penalty catalog</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Check the penalty catalog here and look up penalties if you need them.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li v-can="'penalty.create'"><router-link :to="{ name: 'penalties-create' }" href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-book"></em><span>New penalty</span></router-link></li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div v-for="penalty in penalties" class="mb-4">
                                        <h5 class="text-center">{{ penalty.label }} <router-link :to="{ name: 'penalties-edit',  params:  { id: penalty.id } }"><em class="ni ni-pen"></em></router-link> <a @click.prevent="deleteEntry(penalty.id)" href=""><em class="ni ni-trash"></em></a></h5>
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Paragraph</th>
                                                <th scope="col">Crime</th>
                                                <th scope="col">Fine</th>
                                                <th scope="col">Imprisonment</th>
                                                <th scope="col">Comment</th>
                                                <th scope="col" v-can="'penalty.edit' || 'penalty.delete'">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="children in penalty.children">
                                                <td style="width: 5%">{{ children.paragraph }}</td>
                                                <td style="width: 25%">{{ children.label }}</td>
                                                <td style="width: 10%">${{ children.fine | formatNumber }}</td>
                                                <td style="width: 10%">{{ children.imprisonment }} Months</td>
                                                <td v-html="children.additional"></td>
                                                <td class="text-right" v-can="'penalty.edit' || 'penalty.delete'">
                                                    <div class="btn-group">
                                                        <router-link :to="{ name: 'penalties-edit',  params:  { id: children.id } }" href="" class="btn btn-outline-warning"><em class="ni ni-pen"></em></router-link>
                                                        <a @click.prevent="deleteEntry(children.id)" href="" class="btn btn-outline-danger"><em class="ni ni-trash"></em></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
            penalties: {}
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/strafkatalog/daten')
                .then((response) => {
                    this.penalties = response.data.penalties;
                })
        },
        deleteEntry(children) {
            axios.post('/strafkatalog/'+children+'/löschen')
                .then((response) => {
                    this.penalties = response.data.penalties;
                    this.$noty.success('You have successfully deleted the entry.')
                })
        }
    }
}
</script>

<style scoped>

</style>
