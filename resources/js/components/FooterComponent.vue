<template>
    <div class="nk-footer">
        <div class="container-fluid">
            <div class="nk-footer-wrap">
                <div class="nk-footer-copyright"> {{ footer }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            footer: ''
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/getData')
                .then((response) => {
                    this.footer = response.data.footer;
                })
        }
    }
}
</script>
