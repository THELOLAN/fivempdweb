<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Instructions</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Find out here about new service instructions that will make your everyday work much easier.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li v-can="'instructions.create'"><router-link :to="{ name: 'instructions-create' }" href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-book"></em><span>New service instruction</span></router-link></li>
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
                                    <div id="accordion-2" class="accordion accordion-s3">
                                        <div class="accordion-item" v-for="instruction in instructions">
                                            <a href="#" class="accordion-head collapsed" data-toggle="collapse" :data-target="'#accordion-item'+instruction.id">
                                                <h6 class="title">{{ instruction.title }} <span class="float-right text-muted">{{ instruction.created_at | formatDate }} hour</span></h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" :id="'accordion-item'+instruction.id" data-parent="#accordion-2">
                                                <div class="accordion-inner">
                                                    <div>
                                                        <div v-html="instruction.text"></div>
                                                        <div class="mt-3">
                                                            <small class="text-muted mt-5">- {{ instruction.user.name }} (on {{ instruction.created_at | formatDate }} hour) <span v-if="instruction.created_at != instruction.updated_at">- last edited: {{ instruction.updated_at | formatDate }} hour</span></small>
                                                        </div>
                                                    </div>
                                                    <div class="btn-group mt-3">
                                                        <router-link v-can="'instructions.edit'" :to="{ name: 'instructions-edit', params: { id: instruction.id } }" v-if="permissions.edit" href="" class="btn btn-outline-primary"><em class="ni ni-pen"></em></router-link>
                                                        <a v-can="'instructions.delete'" @click.prevent="deleteData(instruction.id)" v-if="permissions.delete" href="" class="btn btn-outline-secondary"><em class="ni ni-trash"></em></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="instructions.length == 0">
                                        <div class="alert alert-warning alert-pro text-white">
                                            <em class="ni ni-info"></em> No service instructions have been written yet. Please write a service instruction if you have the necessary rights to do so!
                                        </div>
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
            instructions: {},
            permissions: {
                create: false,
                edit: false,
                delete: false,
            }
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/dienstanweisungen/daten')
                .then((response) => {
                    this.instructions = response.data.instructions;
                    this.permissions.create = response.data.permissions.create;
                    this.permissions.edit = response.data.permissions.edit;
                    this.permissions.delete = response.data.permissions.delete;
                })
        },
        deleteData(id) {
            axios.post('/dienstanweisungen/'+id+'/löschen')
                .then((response) => {
                    if (response.data.success) {
                        this.$noty.success("You have successfully deleted the service instruction.", {
                            theme: 'relax',
                            timeout: 4000
                        })
                        this.getData()
                    } else {
                        this.$noty.error("An error has occurred! Please try again later!", {
                            theme: 'relax',
                            timeout: 4000
                        })
                    }
                })
        }
    }
}
</script>

<style scoped>

</style>
