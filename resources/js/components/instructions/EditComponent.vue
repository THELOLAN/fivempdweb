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
                                            <li><router-link :to="{ name: 'instructions-index' }" href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-arrow-left"></em><span>Back</span></router-link></li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <form @submit.prevent="postData">
                                        <div class="form-group row">
                                            <label for="" class="col-lg-2 text-right control-label pt-1">Headline</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" v-model="form.title" :class="{ 'is-invalid' : form.errors.has('title') }">
                                                <has-error :form="form" field="title"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-lg-2 text-right control-label pt-1">Description</label>
                                            <div class="col-lg-7">
                                                <editor :class="{ 'is-invalid' : form.errors.has('text') }"
                                                        api-key="tn358sfioe89ot9qbxg208aa4ev92i3qb3tpgmbctdti7wkr"
                                                        :init="{
                                                height: 200,
                                                menubar: false,
                                                plugins: [],
                                                toolbar:
                                                  'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help',
                                                  content_style: 'body { color: white }'
                                        }" v-model="form.text"
                                                />
                                            </div>
                                            <has-error :form="form" field="text"></has-error>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12 text-center">
                                                <button class="btn btn-outline-primary btn-block col-lg-3 text-center">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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
            form: new Form({
                title: '',
                text: '',
            })
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/dienstanweisungen/'+this.$route.params.id+'/daten')
                .then((response) => {
                    this.form.title = response.data.instruction.title;
                    this.form.text = response.data.instruction.text;
                })
        },
        postData() {
            this.form.post('/dienstanweisungen/'+this.$route.params.id+'/aktualisieren')
                .then((response) => {
                    this.$router.push({ name: 'instructions-index'})
                    this.$noty.success("You have successfully updated the service instruction.",{
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
