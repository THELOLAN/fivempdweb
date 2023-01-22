<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">
                                    Control center
                                </h3>
                                <div class="nk-block-des text-soft">
                                    <p>
                                        Use your officers in the different
                                        different areas and manage
                                        them!
                                    </p>
                                </div>
                            </div>
                            <!-- .nk-block-head-content -->
                        </div>
                        <!-- .nk-block-between -->
                    </div>
                    <!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <form
                                        @submit.prevent="storeData"
                                        method="post"
                                    >
                                        <div class="form-group row">
                                            <label
                                                for=""
                                                class="mt-1 col-lg-2 text-right"
                                                >Name</label
                                            >
                                            <input
                                                v-model="createForm.name"
                                                type="text"
                                                class="form-control col-lg-8 "
                                            />
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                for=""
                                                class="mt-1 col-lg-2 text-right"
                                                >How many officers should
                                                be deployed on it at maximum
                                                be deployed?</label
                                            >
                                            <input
                                                v-model="createForm.max"
                                                type="text"
                                                class="form-control col-lg-8 "
                                            />
                                        </div>
                                        <div class="form-group offset-2">
                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- .card-inner -->
                            </div>
                            <!-- .card-inner-group -->
                        </div>
                        <!-- .card -->
                    </div>
                    <!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            createForm: new Form({
                name: "",
                max: 0
            })
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        storeData() {
            this.createForm.post("/leitstelle/erstellen").then(response => {
                this.$noty.success(
                    "You have successfully created the control center area."
                );
                this.$router.push({ name: "controlcenter-index" });
            });
        }
    }
};
</script>

<style>
.vs__dropdown-toggle {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: flex;
    padding: 0 0 4px;
    background: none;
    border: 1px solid rgba(255, 255, 255, 1);
    border-radius: 4px;
    white-space: normal;
}
</style>
