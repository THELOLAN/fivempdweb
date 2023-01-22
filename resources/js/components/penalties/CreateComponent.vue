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
                                            <li><router-link :to="{ name: 'penalties-index' }" href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-arrow-left"></em><span>Back</span></router-link></li>
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
                                    <form @submit.prevent="postForm">
                                        <div class="form-group row">
                                            <label for="" class="col-lg-2 text-right control-label pt-1">Paragraph</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" v-model="form.paragraph" :class="{ 'is-invalid' : form.errors.has('paragraph') }">
                                                <has-error :form="form" field="paragraph"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-lg-2 text-right control-label pt-1">Crime</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" v-model="form.label" :class="{ 'is-invalid' : form.errors.has('label') }">
                                                <has-error :form="form" field="label"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-lg-2 text-right control-label pt-1">Fine</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" v-model="form.fine" :class="{ 'is-invalid' : form.errors.has('fine') }">
                                                <has-error :form="form" field="fine"></has-error>
                                            </div>
                                            <label for="" class="col-lg-1 text-right control-label pt-1">Imprisonment</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" v-model="form.imprisonment" :class="{ 'is-invalid' : form.errors.has('imprisonment') }">
                                                <has-error :form="form" field="imprisonment"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-lg-2 text-right control-label pt-1">Comment</label>
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
                                            <label for="" class="col-lg-2 text-right control-label pt-1">Category
                                                <a data-toggle="modal" data-target="#categoryModal"><em class="ni ni-info text-primary"></em></a></label>
                                            <div class="col-lg-7">
                                                <select v-model="form.parent" class="form-control" :class="{ 'is-invalid' : form.errors.has('parent') }">
                                                    <option value="">-- Please select --</option>
                                                    <option :value="law.id" v-for="law in penalties">{{ law.label }}</option>
                                                </select>
                                                <has-error :form="form" field="parent"></has-error>
                                            </div>
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
        <div class="modal fade" tabindex="-1" id="categoryModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-header">
                        <h5 class="modal-title">Category selection</h5>
                    </div>
                    <div class="modal-body">
                        <p>
                            You have the possibility to create a new law entry or you create a new law category. For example, this can be <span class="text-primary">Criminal Code</span>. If you create a law category, you don't need the <code>law text</code> field anymore. You do not need to fill it in.
                        </p>
                    </div>
                    <div class="modal-footer bg-light">
                        <span class="sub-text">We wish a lot of fun with the police system v2</span>
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
            form: new Form({
                paragraph: '',
                label: '',
                fine: '',
                imprisonment: '',
                text: '',
                parent: '',
            }),
            penalties: {}
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        postForm() {
            this.form.post('/strafkatalog/speichern')
                .then((response) => {
                    if (response.data.success) {
                        this.$noty.success("You've created a penalty.", {
                            theme: 'relax',
                            timeout: 4000,
                        })
                        this.form.reset()
                    }
                })
        },
        getData() {
            axios.get('/strafkatalog/daten')
                .then((response) => {
                    this.penalties = response.data.penalties;
                })
        }
    }
}
</script>

<style scoped>

</style>
