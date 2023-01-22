<template>
  <div class="nk-content">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Officer</h3>
                <div class="nk-block-des text-soft">
                  <p>Übersicht aller registrierten Officer</p>
                </div>
              </div>
              <!-- .nk-block-head-content -->
              <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                  <a
                    href="#"
                    class="btn btn-icon btn-trigger toggle-expand mr-n1"
                    data-target="pageMenu"
                    ><em class="icon ni ni-menu-alt-r"></em
                  ></a>
                </div>
                <!-- .toggle-wrap -->
              </div>
              <!-- .nk-block-head-content -->
            </div>
            <!-- .nk-block-between -->
          </div>
          <!-- .nk-block-head -->
          <div class="nk-block">
            <div class="row g-gs">
              <div class="col-sm-12 col-lg-12 col-xxl-12">
                <div class="card card-bordered">
                  <div class="card-inner">
                      <form @submit.prevent="postForm">
                          <div class="form-group row">
                              <label for="" class="control-label col-lg-3 text-right required mt-1">New password</label>
                              <div class="col-lg-6">
                                  <input type="password" class="form-control" v-model="form.new_password">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="" class="control-label col-lg-3 text-right required mt-1">Confirm new password</label>
                              <div class="col-lg-6">
                                  <input type="password" class="form-control" v-model="form.new_password_confirm">
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-lg-12 text-center">
                                  <button type="submit" class="btn btn-primary btn-block col-lg-4">Submit</button>
                              </div>
                          </div>
                      </form>
                  </div>
                  <!-- .card-inner -->
                </div>
                <!-- .card -->
              </div>
              <!-- .col -->
            </div>
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
      form: new Form({
        new_password: "",
        new_password_confirm: "",
      }),
    };
  },
  mounted() {},
  methods: {
    postForm() {
      this.form.post("/passwort/ändern").then((response) => {
          this.$noty.success("Du hast dein Passwort erfolgreich geändert.")
      });
    },
  },
};
</script>
