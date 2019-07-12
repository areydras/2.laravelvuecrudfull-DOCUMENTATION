<template>
    <div class="container">
        <div class="row justify-content-center mt-5" v-if="$gate.isDeveloper()">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Developer Component</div>

                    <div class="card-body">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!$gate.isDeveloper()"> <!-- jika $gate(berasal dari app.js Vue.prototype) dia bukan developer makatampilkan halaman 404 -->
            <page-404></page-404>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
