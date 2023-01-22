<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Laws</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Get an overview of all applicable laws in the state of Los Santos.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li v-can="'law.create'"><router-link :to="{ name: 'law-create' }" href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-book"></em><span>New law</span></router-link></li>
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
                                    <div v-for="law in laws">
                                        <h5 class="text-center">{{ law.label }} <router-link v-can="'law.edit'" :to="{ name: 'law-edit', params: { identifier: law.id } }"><em class="ni ni-pen"></em></router-link> <a v-can="'law.delete'" @click.prevent="deleteEntry(law.id)" href=""><em class="ni ni-trash"></em></a></h5>
                                        <table class="table mb-3">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Text</th>
                                                <th scope="col" v-can="'law.edit' || 'law.delete'">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="children in law.children">
                                                <th scope="row">{{ children.paragraph }}</th>
                                                <td>{{ children.label }}</td>
                                                <td v-html="children.text"></td>
                                                <td v-can="'law.edit' || 'law.delete'">
                                                    <div class="btn-group">
                                                        <router-link v-can="'law.edit'" :to="{ name: 'law-edit', params: { identifier: children.id } }" class="btn btn-primary"><em class="ni ni-pen"></em></router-link>
                                                        <a v-can="'law.delete'" @click.prevent="deleteEntry(children.id)" class="btn btn-danger"><em class="ni ni-trash"></em></a>
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
            laws: {}
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/gesetze/daten')
                .then((response) => {
                    this.laws = response.data.laws;
                })
        },
        deleteEntry(value) {
            axios.get('/gesetze/'+ value +'/löschen')
                .then((response) => {
                    this.getData()
                    this.$noty.success("The law entry was successfully deleted.", {
                        theme: 'relax',
                        timeout: 4000,
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>
